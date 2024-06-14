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
    <link href="<?php echo base_url() ?>assets/finns_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/finns_assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/finns_assets/plugins/pace/pace.css" rel="stylesheet">


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
            <p class="auth-description">Lupa Password</p>
            <p class="auth-description">Untuk melakukan reset password, silakan masukkan alamat email anda.</p>
            <?php echo form_open('lupa_password'); ?>
                <div class="auth-credentials m-b-xxl">
                    <label for="signInEmail" class="form-label">Alamat Email</label>
                    <input type="text" name="email" class="form-control m-b-md" value="<?php echo set_value('email'); ?>">
                </div>
                <?php echo form_error('email'); ?>

                <div class="auth-submit">
                    <input type="submit" class="btn btn-danger btn-block btn-lg" name="btnSubmit" value="Submit" />
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
    <script src="<?php echo base_url() ?>assets/finns_assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/finns_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/finns_assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/finns_assets/plugins/pace/pace.min.js"></script>
    <script src="<?php echo base_url() ?>assets/finns_assets/js/main.min.js"></script>
    <script src="<?php echo base_url() ?>assets/finns_assets/js/custom.js"></script>
</body>

</html>
