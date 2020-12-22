$(function() {

    /**
     * pega o token na tag head
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * ao trocar de form
     */
    $(".form-change").click(function(e) {
        e.preventDefault();
        var button = $(this);
        var id = "#" + button.attr('name');

        var id_views = ['#view-login', '#view-recover', '#view-register'];

        $('form .alert-back').hide();

        id_views.forEach(function(value, index) {
            if ($(id_views[index]).css('display') != 'none') {
                $(id_views[index]).addClass('animate__animated animate__fadeOutUp');

                setTimeout(function() {
                    $(id_views[index]).hide().removeClass('animate__animated animate__fadeOutUp animate__fadeInUp');


                    $(id).addClass('animate__animated animate__fadeInUp').css('display', 'flex');

                }, 500);
            }

        });




    });


    /**
     * submit dos forms da tela inicial
     */
    $('form').submit(function(e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: "JSON",
                beforeSend: function() {

                    $('form .alert-back').removeClass('animate__animated animate__fadeInUp');
                    $('form .alert-back').addClass('animate__animated animate__fadeOutDown');
                    $('form .alert-back').html('').removeClass('danger success info warning');

                    $('.row.content .left').addClass('contentLoader');
                    $('.row.content .left').prepend(screenLoader(''));
                    // $('body').prepend(screenLoader(''));
                }
            })
            .done(function(response) {

                console.log(response)

                if (response.message) {
                    $('.alert-back').html(response.message).addClass(response.status);
                }

                if (response.redirect) {
                    $.post(response.route_session, response.json);

                    setTimeout(function() {
                        window.location.href = response.redirect;
                    }, 1000);

                } else {
                    removeScreenLoader();
                }


                $('form .alert-back').show();
                $('form .alert-back').removeClass('animate__fadeOutDown').addClass('animate__animated animate__fadeInUp');

            })
            .fail(function(jqXHR, textStatus, msg) {
                $('.alert-back').html(msg).addClass('danger');
                $('form .alert-back').show();
                $('form .alert-back').removeClass('animate__fadeOutDown').addClass('animate__animated animate__fadeInUp');
                removeScreenLoader();
            });

    });


    /**
     * no formulario de registro, verifica se o usuario ja existe/esta vinculado no sistema (idtel)
     */
    $('#view-register form .verify-user, #view-login form .verify-user').focusout(function(e) {
        e.preventDefault();


        var form = $(this).parent().parent();
        console.log(form)
        var id_system = form.find('[name="id_system"]').val();
        var idtel = form.find('[name="idtel"]').val();
        var response_verify = form.find('.response-verify').html();
        form.find('.response-verify').removeClass('danger warning info success');

        if (id_system != '' && idtel != '') {

            $.ajax({
                    url: form.attr('action-verify-user'),
                    type: form.attr('method'),
                    data: { id_system: id_system, idtel: idtel },
                    dataType: "JSON",
                    beforeSend: function() {
                        form.find('.response-verify').html('<i style=" animation:spin 1s linear infinite;" class="fas fa-sync-alt"></i> Pesquisando')
                    }

                })
                .done(function(response) {

                    if (response.errors) {
                        form.find('.response-verify').html(response.errors);
                    }

                    if (response.message) {
                        form.find('.response-verify').addClass(response.status);
                        form.find('.response-verify').html(response.message);

                    }

                })
                .fail(function(jqXHR, textStatus, msg) {
                    alert(msg);

                });
        }

    });


    /**
     * chama o modal
     */
    $(document).on('click', 'a[data-idmodal]', function(e) {
        e.preventDefault();

        var modal = $(this).attr('data-idmodal');
        var route = $(this).attr('data-href');

        $.post(route, function(data) {
            $('body').prepend(data)
            $('#modal').modal('show');
        });


    });

});