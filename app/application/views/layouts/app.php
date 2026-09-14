<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ? $title : 'App' ?> - Shop</title>
    <link href="/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/libs/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="/assets/app.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('layouts/_nav') ?>
    <!-- Navbar -->

    <!-- Content -->
    <?php $this->load->view($page) ?>
    <!-- Content -->

    <script src="/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/app.js"></script>
</body>

</html>