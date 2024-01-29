<!DOCTYPE html>
<html lang="pt>
<head>
    <meta charset=" UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CigBurger Backoffice <?= !empty($title) ? $title : '' ?></title>
<!-- favicon -->
<link rel="shortcut icon" href="<?php echo base_url("assets/images/logo.png") ?>" type="image/x-icon">
<!-- google font -->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="<?php echo base_url('assets/libs/bootstrap/bootstrap.min.css'); ?>">
<!-- fontawesome -->
<link rel="stylesheet" href="<?php echo base_url('assets/libs/fontawesome/all.min.css'); ?>">
<!-- sweet alert -->
<link rel="stylesheet" href="<?= base_url('assets/libs/sweetalert2-11/sweetalert.min.css') ?>">
<!-- css -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
<!-- page specific css -->
<?php echo $this->renderSection('styles'); ?>

</head>

<body>
    <!-- topbar -->
    <?= $this->include('layouts/partials/_top_bar') ?>

    <!-- main -->
    <main class="d-flex">
        <!-- main-menu -->
        <?= $this->include('layouts/partials/_main_menu') ?>
        <!-- content -->
        <!-- render section -->
        <div class="content p-4 flex-fill inner-scroll">
            <?php echo $this->renderSection('content'); ?>
        </div>
    </main>

    <!-- footer -->
    <?= $this->include('layouts/partials/_footer') ?>


    <!-- bootstrap js -->
    <script src="<?php echo base_url('assets/libs/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jquery371.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <script>
        document.querySelector('.btn-main-menu').addEventListener('click', () => {
            document.querySelector(".main-menu").classList.toggle('show')
            document.querySelector(".content").classList.toggle('show')
        })
    </script>
    <!-- sweet alert -->
    <script src="<?= base_url('assets/libs/sweetalert2-11/sweetalert.js') ?>"></script>
    <!-- page specific js -->
    <?php echo $this->renderSection('scripts'); ?>

</body>

</html>