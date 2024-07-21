$(document).ready(function () {
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("toggled");
        });

    $('#Loginform').on('submit', function (e) {
        e.preventDefault();
        let isValid = true;
        let user = $('#username').val().trim();
        let pass = $('#password').val().trim();

        if (user === '') {
            $('#username').addClass('is-invalid');
            isValid = false;
        } else {
            $('#username').removeClass('is-invalid');
        }

        if (pass === '') {
            $('#password').addClass('is-invalid');
            isValid = false;
        } else {
            $('#password').removeClass('is-invalid');
        }

        if (isValid) {
            let action = 'login';
            $('div.error').hide();
            $.ajax({
                type: "POST",
                url: "../admin/authentication/login.php",
                data: {
                    username: user,
                    password: pass,
                    action: action
                },
                success: function (res) {
                    res = JSON.parse(res);
                    // alert(res.success)
                    // console.log(res)
                    if (res.success) {
                        $('div.error').hide();
                        window.location.href = "../admin/home.php";
                    } else {
                        $('#username').addClass('is-invalid');
                        $('#password').addClass('is-invalid');
                        $('#password').val('');
                        $('div.error').text(res.message).show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('div.error').text("An error occurred during login. Please try again.").show();
                }
            });
        }
    });
});
