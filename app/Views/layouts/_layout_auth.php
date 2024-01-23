<!DOCTYPE html>
<html lang="pt>
<head>
    <meta charset=" UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CigBurger Backoffice</title>
<!-- favicon -->
<link rel="shortcut icon" href="<?php echo base_url("assets/images/logo.png") ?>" type="image/x-icon">
<!-- google font -->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="<?php echo base_url('assets/libs/bootstrap/bootstrap.min.css'); ?>">
<!-- fontawesome -->
<link rel="stylesheet" href="<?php echo base_url('assets/libs/fontawesome/all.min.css'); ?>">
<!-- css -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
</head>

<body class="login-page-background">
    <!-- render section -->
    <?php echo $this->renderSection('content'); ?>

    <!-- bootstrap js -->
    <script src="<?php echo base_url('assets/libs/bootstrap/bootstrap.bundle.min.js'); ?>"></script>

    <?php echo $this->renderSection('scripts'); ?>
</body>

</html>