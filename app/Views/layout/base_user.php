<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link rel="shortcut icon" href="<?= base_url('image/logo_toko_online.png'); ?>" type="image/x-icon">

    <!-- Icons Fontawesome -->
    <script src="https://kit.fontawesome.com/56f52f061b.js" crossorigin="anonymous"></script>

    <!-- GFont DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

    <!-- Style Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- Render Style Custom -->
    <?= $this->renderSection('style') ?>

    <style>
    body {
        margin: 0;
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }
    </style>
</head>

<body>
    <?= $this->include('template/navbar_user') ?>

    <?= $this->renderSection('content') ?>

    <?= $this->include('template/footer_user') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>