<?php $page = 'contacto'; ?>
<?php include('header.php'); ?>

<div id="fullpage">
    <section class="section" id="contacto">
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-7 contenedor">
                <div class="contenido">
                    <h3 class="titulo"><?php echo CFS()->get('titulo_contacto'); ?></h3><br>
                    <form>
                        <input type="text" name="nombre" placeholder="Nombre" class="textbox nombre"><br>
                        <input type="text" name="direccion" placeholder="Dirección" class="textbox direccion"><br>
                        <input type="text" name="telefono" placeholder="Teléfono" class="textbox telefono"><br>
                        <textarea placeholder="Mensaje" class="textarea-contacto"></textarea><br>
                        <input type="submit" value="Enviar" class="boton-contacto">
                    </form>    
                    <div class="tamano-texto">
                        <text class="texto-contacto">
                            <?php echo CFS()->get('texto_contacto'); ?><br>
                            <img src="<?php echo bloginfo('template_url').'/'; ?>img/element/phone.png" alt="icono telefono contacto" class="img-decoration">
                            <?php echo CFS()->get('numtelefono_contacto'); ?>
                        </text>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>