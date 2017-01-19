<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIM Roofing</title>
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/formstyles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/cropper.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/jquery.periodpicker.min.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/jquery.timepicker.min.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo bloginfo('template_url').'/'; ?>js/jquery.periodpicker.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="<?php echo bloginfo('template_url').'/'; ?>js/numeral.min.js"></script>
    <script src="<?php echo bloginfo('template_url').'/'; ?>js/signature_pad.js"></script>
</head>
<body>
<nav class="app-nav">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span>Menu</span>
    </button>
    <ul>
        <li><a href="<?php echo home_url();?>"><img src="<?php echo bloginfo('template_url').'/'; ?>img/svg/home.svg" alt="Home"> Home</a></li>
        <li><a href="<?php echo home_url();?>/projects"><img src="<?php echo bloginfo('template_url').'/'; ?>img/svg/project.svg" alt="Home"> Projects</a></li>
        <li><a href="<?php echo home_url();?>/inspectionhistory"><img src="<?php echo bloginfo('template_url').'/'; ?>img/svg/list.svg" alt="Home"> Inspection Lists</a></li>
        <li><a href="<?php echo wp_logout_url();?>"><img src="<?php echo bloginfo('template_url').'/'; ?>img/svg/logout.svg" alt="Logout"> Logout</a></li>
    </ul>
</nav>
<script>
    $('.app-nav .navbar-toggle').click(function () {
        var $navbar = $('.app-nav');
        if(!$navbar.hasClass('open')){
            $navbar.addClass('open');
        } else {
            $navbar.removeClass('open');
        }
    });
    $(document).click(function (e) {
        var $navbar = $('.app-nav');

        if (!$navbar.is(e.target) && $navbar.has(e.target).length === 0) {
            $navbar.removeClass('open');
        }
    });
</script>