<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CIM Roofing</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.fullPage.js"></script>
    </head>
    <body>


        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid vertical-align">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php if($page== 'index') { ?>
                        <li class="active"><a href="index.php">INICIO <span class="sr-only">(current)</span></a></li>
                        <?php } else { ?>
                        <li><a href="index.php">INICIO <span class="sr-only">(current)</span></a></li>
                        <?php } ?>
                        <?php if($page == 'nosotros')  { ?>
                        <li class="active" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NOSOTROS <span></span></a>
                            <ul class="dropdown-menu">
                                <div class="vertical-align links-container dropdown-font">
                                    <li><a href="#">COMPAÑÍA</a></li>
                                    <li><a href="#">FABRICANTES</a></li>
                                    <li><a href="#">RESPONSABILIDAD</a></li>
                                    <li><a href="#">CERTIFICACIONES</a></li>
                                    <li><a href="#">EMPLEOS</a></li>
                                </div>
                            </ul>
                        </li>
                        <?php } else {  ?>
                        <li><a href="page-nosotros.php">NOSOTROS</a></li>
                        <?php } ?>
                        <?php if($page == 'servicios')  { ?>
                        <li class="active" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SERVICIOS <span></span></a>
                            <ul class="dropdown-menu">
                                <div class="vertical-align links-container dropdown-font">
                                    <li><a href="#">IMPERMEABILIZACIÓN</a></li>
                                    <li><a href="#">RENOVACIÓN</a></li>
                                    <li><a href="#">REEMPLAZO</a></li>
                                    <li><a href="#">REPARACIÓN</a></li>
                                    <li><a href="#">MANT. PREVENTIVO</a></li>
                                    <li><a href="#">INSPECCIÓN</a></li>
                                    <li><a href="#">CONTRATO</a></li>
                                </div>
                            </ul>
                        </li>
                        <?php } else {  ?>
                        <li><a href="page-servicios.php">SERVICIOS</a></li>
                        <?php } ?>
                        <li><a href="#">CIM SAFETY</a></li>
                        <li><a href="#">GALERÍA</a></li>
                        <li><a href="#">BLOG</a></li>
                        <li><a href="#">CONTACTO</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
