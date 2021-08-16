<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('dist/css/app.css') ?>">
    <?= $this->renderSection('style') ?>
</head>
<body data-theme="default" data-layout="fluid" data-sidebar="left">
    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('dist/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('dist/js/app.js')?>"></script>
    <?= $this->renderSection('script') ?>
</body>
</html>