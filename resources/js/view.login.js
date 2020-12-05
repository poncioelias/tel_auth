$(function() {
   
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


    $('form').submit(function(e) {
        e.preventDefault();
        var form = $(this);

        $('.alert-back').html('').removeClass('danger success info warning');

        $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.alert-back').html('carregando...');
                }
            })
            .done(function(response) {

                if (response.message) {
                    $('.alert-back').html(response.message).addClass(response.status);
                }

                $('form .alert-back').show();
            })
            .fail(function(jqXHR, textStatus, msg) {
                $('.alert-back').html(msg).addClass('danger');
                $('form .alert-back').show();
            });

    });


});