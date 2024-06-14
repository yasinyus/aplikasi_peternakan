<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mortgage Calculator">
    <meta name="keywords" content="Mortgage Calculator">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Finns App</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <!-- <link href="<?php echo base_url() ?>assets/finns_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?php echo base_url() ?>assets/finns_assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/finns_assets/plugins/pace/pace.css" rel="stylesheet">
    <link rel="stylesheet" href="https://finnapp.3sixty.id/assets/admin_page/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://finnapp.3sixty.id/assets/admin_page/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Theme Styles -->
    <link href="<?php echo base_url() ?>assets/finns_assets/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/finns_assets/css/custom.css" rel="stylesheet">

</head>

<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">

            <div class="logo">
                <a href="index.html">Finns App</a>
            </div>
            <p class="auth-description">Reset Password</p>
            <p class="auth-description">Silahkan isikan password baru anda.</p>
            <?= $this->session->flashdata('message'); ?>
            <?php echo form_open('lupa_password/reset_password/token/' . $token); ?>
            <label for="signInPassword" class="form-label">Password</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                    <input name="password" value="<?php echo set_value('password'); ?>" type="password" value="" class="input form-control" id="password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                        </span>
                    </div>
                    
                    </div>
                    <p style="font-size: 11px;">Minimal 8 karakter kombinasi huruf dan angka</p> 
                    
                    <label for="signInPassword" class="form-label mt-2">Konfirmasi Password</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                    <input name="konfirmasi_password"  value="<?php echo set_value('konfirmasi_password'); ?>" type="password" value="" class="input form-control" id="konfirmasi_password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide2();">
                        <i class="fas fa-eye" id="show_eye2"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                        </span>
                    </div> 
                    </div>
                    <p> <?php echo validation_errors('<p class="alert alert-warning">','</p>'); ?> </p>
                    <div class="auth-submit mt-3">
                    <input type="submit" name="btnSubmit" value="Reset" class="btn btn-danger btn-block"/>
                </div>
            <?php echo form_close(); ?>

        </div>
    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <!-- Javascripts -->
    <script src="<?php echo base_url() ?>assets/nortale_assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/nortale_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/nortale_assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/nortale_assets/plugins/pace/pace.min.js"></script>
    <script src="<?php echo base_url() ?>assets/nortale_assets/js/main.min.js"></script>
    <script src="<?php echo base_url() ?>assets/nortale_assets/js/custom.js"></script>
    <script>
                            function password_show_hide() {
                            var x = document.getElementById("password");
                            var show_eye = document.getElementById("show_eye");
                            var hide_eye = document.getElementById("hide_eye");
                            hide_eye.classList.remove("d-none");
                            if (x.type === "password") {
                                x.type = "text";
                                show_eye.style.display = "none";
                                hide_eye.style.display = "block";
                            } else {
                                x.type = "password";
                                show_eye.style.display = "block";
                                hide_eye.style.display = "none";
                            }
                            }
                        </script>

                        <script>
                            function password_show_hide2() {
                            var x = document.getElementById("konfirmasi_password");
                            var show_eye = document.getElementById("show_eye2");
                            var hide_eye = document.getElementById("hide_eye2");
                            hide_eye.classList.remove("d-none");
                            if (x.type === "password") {
                                x.type = "text";
                                show_eye.style.display = "none";
                                hide_eye.style.display = "block";
                            } else {
                                x.type = "password";
                                show_eye.style.display = "block";
                                hide_eye.style.display = "none";
                            }
                            }
                        </script>
</body>

</html>
