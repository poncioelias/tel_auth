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

                if (response.message) {
                    $('.alert-back').html(response.message).addClass(response.status);
                }

                if (response.redirect) {
                    window.location.href = response.redirect;
                }

                removeScreenLoader();
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


});