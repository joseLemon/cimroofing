<?php $page = 'nosotros'; ?>
<?php include('header.php'); ?>
<div id="fullpage">
    <section class="section" id="compania1">
       <img src="<?php echo bloginfo('template_url').'/'; ?>img/backgrounds/elementscompania.png" alt="elementos fondo compania 1" class="bg-asset">
        <div class="row no-margin">
            <div class="col-sm-7"></div>
            <div class="col-sm-5 contenedor-nosotros">
                <h3 class="titulo-nosotros"><?php echo CFS()->get('titulo_compania1'); ?></h3><br>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-compania.png" class="divider"><br>
                <img src="<?php echo CFS()->get('img_compania1'); ?>" alt="persona compania 1" class="img-decoration">          
                <text class="titulo-contenido"><?php echo CFS()->get('subtitulo_compania1'); ?> </text><br>
                <div class="tamanotexto">
                    <text class="texto-contenido">
                        <?php echo CFS()->get('texto_compania1'); ?>
                    </text>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="compania2">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor-nosotros">
                <h3 class="titulo-nosotros"><?php echo CFS()->get('titulo_compania2'); ?></h3><br>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-compania.png" class="divider"><br> 
                <div id="mision">      
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/element/mision.png" alt="icono mision" class="icons">
                    <div class="tamanotexto">
                        <text class="titulo-contenido"><?php echo CFS()->get('subtitulo1_compania2'); ?></text><br>
                        <text class="texto-contenido">
                            <?php echo CFS()->get('texto1_compania2'); ?>
                        </text>
                    </div>
                </div>
                <div id="vision">
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/element/vision.png" alt="icono vision" class="icons">
                    <div class="tamanotexto">
                    <text class="titulo-contenido"><?php echo CFS()->get('subtitulo2_compania2'); ?></text><br>
                    <text class="texto-contenido">
                        <?php echo CFS()->get('texto2_compania2'); ?>
                    </text>
                </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="compania3">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-3 contenedor-nosotros div1">
                <div class="valores"> 
                    <h3 class="titulo-nosotros"><?php echo CFS()->get('titulo_compania3'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-compania.png" class="divider"><br> 

                    <text class="texto-contenido">
                        <?php echo CFS()->get('texto_compania3'); ?>
                    </text>
                </div>
            </div>
                <div class="col-sm-3 contenedor-nosotros div2">
                    <div id="slider-valores" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#slider-valores" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-valores" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="<?php echo CFS()->get('img1_compania3'); ?>" alt="imagen carrusel 1" class="img-decoration">
                            </div>
                            <div class="item">
                                <img src="<?php echo CFS()->get('img2_compania3'); ?>" alt="imagen carrusel 2" class="img-decoration">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="section" id="fabricantes">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor-nosotros">
                <div class="align-div">
                    <h3 class="titulo-nosotros"><?php echo CFS()->get('titulo_fabricantes'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-fabricantes.png" class="divider"><br> 
                    <div id="contenedor-fabricantes">    
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/siplast.png" alt="marca siplast" class="marca">  
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/fiberlite.png" alt="marca fiberlite" class="marca">  
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/jm.png" alt="marca jm" class="marca">  
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/firestone.png" alt="marca firestone" class="marca">  
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/carlisle.png" alt="marca carlisle" class="marca">  
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/sika.png" alt="marca sika" class="marca">  
                        <div class="tamano-texto">
                            <text class="titulo-contenido">
                                <p><?php echo CFS()->get('subtitulo_fabricantes'); ?></p>
                            </text>
                            <text class="texto-contenido">
                                <?php echo CFS()->get('texto_fabricantes'); ?>
                            </text>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="responsabilidad">
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/rci.png" alt="north texas chapter" class="img-decoration">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor-nosotros">
                <div class="tamano-texto">
                    <h3 class="titulo-nosotros"><?php echo CFS()->get('titulo_responsabilidad'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-responsabilidad.png" class="divider"><br>      

                    <text class="texto-contenido">
                        <?php echo CFS()->get('texto_responsabilidad'); ?>
                    </text>
                </div>

            </div>
        </div>        
    </section>
    <section class="section" id="certificaciones">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor-nosotros">
                <div class="contenido-cert">
                    <h3 class="titulo-nosotros"><?php echo CFS()->get('titulo_certificaciones'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-certificaciones.png" alt="division" class="divider" style="width:400px;">
                    <br>
                    <img src="<?php echo CFS()->get('img_certificaciones'); ?>" alt="certificaciones" class="img-decoration">
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="empleos">
       <img src="<?php echo bloginfo('template_url').'/'; ?>img/backgrounds/asset-empleos.png" alt="triangulos fondo empleos" class="bg-decoration">
       <div class="contenido-empleos">
                    <h3 class="titulo-nosotros"><?php echo CFS()->get('titulo_empleos'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" class="divider"><br> 
                    <text class="texto-contenido">
                        <?php echo CFS()->get('texto_empleos'); ?>
                    </text>
                </div>
    </section>
</div>
<?php include('footer.php'); ?>