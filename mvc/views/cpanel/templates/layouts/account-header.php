<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/root.css' ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?= _TEMPLATE . 'css/views/' . $dataUsego['css'] . '.css' ?>" type="text/css" media="all">
    <link rel="shortcut icon" href="<?= _TEMPLATE . 'images/icons/usego-logo.png' ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= _TEMPLATE . 'libary/cute-alert/style.css' ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?= _TEMPLATE . 'libary/EggyJS/build/css/progressbar.css' ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?= _TEMPLATE . 'libary/EggyJS/build/css/theme.css' ?>" type="text/css" media="all">
    <title><?= $dataUsego['title'] ?? _on_error ?></title>
    <script src="<?= _TEMPLATE ?>libary/dompurify-js/dompurify/dist/purify.js"></script>
    <script src="https://apis.google.com/js/api:client.js"></script>
</head>
<body>
