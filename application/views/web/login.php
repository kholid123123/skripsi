<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-SURAT | SMKN 1 Arosbaya</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>foto/logo.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/_login/css/main.css">
    <script src="<?php echo base_url(); ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <style>
        body {
            background: url('<?php echo base_url('assets/img/bgg.jpg'); ?>') no-repeat center center fixed;
            background-size: cover;
        }

        .container-login100 {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .container-login100 {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <?php echo $script_captcha; ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo base_url('foto/kresek.png') ?>" class="login-image">
                </div>
                <div class="col-md-6">
                    <div class="wrap-login100">
                        <form method="post" action="" class="login100-form validate-form">
                            <span class="login100-form-title p-b-26">
                                E-SURAT LOGIN Test
                            </span>
                            <small>
                                <?php echo $this->session->flashdata('msg'); ?>
                            </small>
                            <div class="wrap-input100 validate-input">
                                <span class="btn-show-pass">
                                    <i class="zmdi zmdi-assignment-account"></i>
                                </span>
                                <input class="input100" type="text" name="username">
                                <span class="focus-input100" data-placeholder="Username"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate="password">
                                <span class="btn-show-pass">
                                    <i class="zmdi zmdi-eye"></i>
                                </span>
                                <input class="input100" type="password" name="password">
                                <span class="focus-input100" data-placeholder="Password"></span>
                            </div>
                            <p class="mt-2"><?php echo $captcha; ?></p>
                            <div class="container-login100-form-btn">
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <button type="submit" class="login100-form-btn" name="btnlogin">Masuk</button>
                                </div>
                                <p class="mt-2">Lupa Password? Hubungi admin!</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="features-section" class="features-section">
    <div class="feature-box">
            <h3>Pengelolaan Surat</h3>
            <p>Aplikasi perusuratan online memungkinkan pengguna untuk mengelola surat masuk dan keluar secara efisien.</p>
        </div>
        <div class="feature-box">
            <h3> Notifikasi dan Pengingat</h3>
            <p>Notifikasi dan pengingat otomatis adalah fitur penting yang memastikan pengguna tidak melewatkan surat penting atau tenggat waktu. </p>
        </div>
        <div class="feature-box">
            <h3>Pelacakan dan Arsip Digital</h3>
            <p>Fitur pelacakan dan arsip digital memungkinkan pengguna untuk melacak status surat yang dikirim dan diterima, serta menyimpan semua surat dalam bentuk digital.</p>
        </div>
		
    </div>

    <script src="<?php echo base_url(); ?>assets/_login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/vendor/animsition/js/animsition.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/vendor/select2/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/vendor/countdowntime/countdowntime.js"></script>
    <script src="<?php echo base_url(); ?>assets/_login/js/main.js"></script>
</body>

<style>
    .container-login100 {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .row {
        display: flex;
        width: 100%;
    }

    .col-md-6 {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrap-login100 {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background: rgba(240, 240, 240, 0.5);
        border-radius: 8px;
    }

    .login-image {
        height: 100%;
        max-height: 400px;
        width: auto;
        object-fit: cover;
    }

    .features-section {
        display: flex;
        justify-content: space-around;
        margin-top: 0px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 0px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .feature-box {
        text-align: center;
        padding: 20px;
        background-color: #363636;
        color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 30%;
    }

    .feature-box h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .login100-form-bgbtn {
        background-color: red;
        background-image: linear-gradient(to right, red, black);
    }
</style>

</html>
