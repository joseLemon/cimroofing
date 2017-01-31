<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CIM Roofing</title>
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo bloginfo('template_url').'/';?>js/jquery.fullPage.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid vertical-align">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span>Menu</span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php if($page== 'index') { ?>
                        <li class="active"><a href="index.php">HOME <span class="sr-only">(current)</span></a></li>
                        <?php } else { ?>
                        <li><a href="index">HOME <span class="sr-only">(current)</span></a></li>
                        <?php } ?>
                        <?php if($page == 'nosotros')  { ?>
                        <li class="active open" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">ABOUT US <span></span></a>
                            <ul class="dropdown-menu">
                                <div class="vertical-align links-container dropdown-font">
                                    <li><a href="#section-nosotros" class="active">COMPANY</a></li>
                                    <li><a href="#section-fabricantes">MANUFACTURERS</a></li>
                                    <li><a href="#section-responsabilidad">SOCIAL RESPONSABILITY</a></li>
                                    <li><a href="#section-certificaciones">CERTIFICATIONS</a></li>
                                    <li><a href="#section-empleos">EMPLOYMENT</a></li>
                                </div>
                            </ul>
                        </li>
                        <?php } else {  ?>
                        <li><a href="nosotros">ABOUT US</a></li>
                        <?php } ?>
                        <?php if($page == 'servicios')  { ?>
                        <li class="active open" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SERVICES <span></span></a>
                            <ul class="dropdown-menu">
                                <div class="vertical-align links-container dropdown-font">
                                    <li><a href="#section-impermeabilizacion" class="active">NEW CONSTRUCTION</a></li>
                                    <li><a href="#section-renovacion">ROOF RENOVATION</a></li>
                                    <li><a href="#section-reemplazo">ROOF REPLACEMENT</a></li>
                                    <li><a href="#section-reparacion">LEAK REPAIR</a></li>
                                    <li><a href="#section-preventivo">PREVENTIVE MAINT.</a></li>
                                    <li><a href="#section-inspeccion">INSP. AND DIAGNOSIS</a></li>
                                    <li><a href="#section-contrato">SERVICE CONTRACTS</a></li>
                                </div>
                            </ul>
                        </li>
                        <?php } else {  ?>
                        <li><a href="servicios">SERVICES</a></li>
                        <?php } ?>
                        <?php if($page== 'cimsafety') { ?>
                        <li class="active"><a href="cimsafety">CIM SAFETY</a></li>
                        <?php } else {  ?>
                        <li><a href="cimsafety">CIM SAFETY</a></li>
                        <?php } ?>
                        <?php if($page== 'galeria') { ?>
                        <li class="active"><a href="galeria">GALLERY</a></li>
                        <?php } else {  ?>
                        <li><a href="galeria">GALLERY</a></li>
                        <?php } ?>
                        <?php if($page== 'blog') { ?>
                        <li class="active"><a href="blog">BLOG</a></li>
                        <?php } else {  ?>
                        <li><a href="blog">BLOG</a></li>
                        <?php } ?>
                        <?php if($page== 'contacto') { ?>
                        <li class="active"><a href="contacto">CONTACT US</a></li>
                        <?php } else {  ?>
                        <li><a href="contacto">CONTACT US</a></li>
                        <?php } ?>
                        <!--
                        <li><a href="cimsafety">CIM SAFETY</a></li>
                        <li><a href="galeria">GALERÍA</a></li>
                        <li><a href="blog">BLOG</a></li>
                        <li><a href="contacto">CONTACTO</a></li>-->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
