<?php $page = 'cimsafety'; ?>
<?php include('header.php'); ?>

<div id="fullpage">
    <section class="section" id="cimsafety">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 contenedor">
                <div class="contenido">
                    <h3 class="titulo"><?php echo CFS()->get('titulo_cimsafety'); ?></h3><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-cimsafety.png" class="divider"><br>     
                    <div class="tamano-texto">
                        <text class="texto-contenido">
                            <p><?php echo CFS()->get('texto_cimsafety'); ?></p>
                        <img src="<?php echo CFS()->get('img_cimsafety'); ?>" alt="cim safety" class="img-decoration">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>