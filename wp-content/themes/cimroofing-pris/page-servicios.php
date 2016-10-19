<?php $page = 'servicios'; ?>
<?php include('header.php'); ?>
<div id="fullpage">
    <section class="section servicios" id="impermeabilizacion">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo-servicios"><?php echo CFS()->get('titulo_impermeabilizacion'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-servicios.png" class="divider-servicios"><br>     
                    <div class="tamano-texto-servicios">
                        <text class="texto-contenido-servicios">
                            <p><?php echo CFS()->get('texto_impermeabilizacion'); ?></p>
                        </text>
                    </div>
                    <img src="<?php echo CFS()->get('img_impermeabilizacion'); ?>" alt="rodillo" class="img-decoration-servicios">
                </div>
            </div>
        </div>
    </section>
    <section class="section servicios" id="renovacion">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo-servicios"><?php echo CFS()->get('titulo_renovacion'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-servicios.png" class="divider-servicios"><br>     
                    <div class="tamano-texto-servicios">
                        <text class="texto-contenido-servicios">
                           <?php echo CFS()->get('texto_renovacion'); ?>
                        </text>
                    </div>
                    <img src="<?php echo CFS()->get('img_renovacion'); ?>" alt="casa" class="img-decoration-servicios">
                </div>
            </div>
        </div>
    </section>
    <section class="section servicios" id="reemplazo">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo-servicios"><?php echo CFS()->get('titulo_reemplazo'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-servicios.png" class="divider-servicios"><br>     
                    <div class="tamano-texto-servicios">
                        <text class="texto-contenido-servicios">
                            <?php echo CFS()->get('texto_reemplazo'); ?>
                        </text>
                    </div>
                    <img src="<?php echo CFS()->get('img_reemplazo'); ?>" alt="casa" class="img-decoration-servicios">
                </div>
            </div>
        </div>
    </section>
    <section class="section servicios" id="reparacion">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo-servicios"><?php echo CFS()->get('titulo_reparacion'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-servicios.png" class="divider-servicios"><br>     
                    <div class="tamano-texto-servicios">
                        <text class="texto-contenido-servicios">
                            <?php echo CFS()->get('texto_reparacion'); ?>
                        </text>
                    </div>
                    <img src="<?php echo CFS()->get('img_reparacion'); ?>" alt="tuberia" class="img-decoration-servicios">
                </div>
            </div>
        </div>
    </section>
    <section class="section servicios" id="mantpreventivo">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo-servicios"><?php echo CFS()->get('titulo_mantpreventivo'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-servicios.png" class="divider-servicios"><br>     
                    <div class="tamano-texto-servicios">
                        <text class="texto-contenido-servicios">
                            <?php echo CFS()->get('texto_mantpreventivo'); ?>
                        </text>
                    </div>
                    <img src="<?php echo CFS()->get('img_mantpreventivo'); ?>" alt="herramientas" class="img-decoration-servicios">
                </div>
            </div>
        </div>
    </section>
    <section class="section servicios" id="inspeccion">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo-servicios"><?php echo CFS()->get('titulo_inspeccion'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-servicios.png" class="divider-servicios"><br>     
                    <div class="tamano-texto-servicios">
                        <text class="texto-contenido-servicios">
                            <?php echo CFS()->get('texto_inspeccion'); ?>
                        </text>
                    </div>
                    <img src="<?php echo CFS()->get('img_inspeccion'); ?>" alt="bajo mantenimiento" class="img-decoration-servicios">
                </div>
            </div>
        </div>
    </section>
    <section class="section servicios" id="contrato">
        <div class="row no-margin">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo-servicios"><?php echo CFS()->get('titulo_contrato'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-servicios.png" class="divider-servicios"><br>     
                    <div class="tamano-texto-servicios">
                        <text class="texto-contenido-servicios">
                            <?php echo CFS()->get('texto_contrato'); ?>
                        </text>
                    </div>
                    <img src="<?php echo CFS()->get('img_contrato'); ?>" alt="contrato" class="img-decoration-servicios">
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php'); ?>