<?php if( !is_user_logged_in()) { ?>
    <div class="modal fade fade-scale" role="dialog" id="login-modal">
        <div class="modal-dialog">
            <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <div class="modal-content">
                <div class="modal-login-form">
                    <div class="modal-header">
                        <a class="logo" href="<?php echo home_url();?>"></a>
                        <!--<h3 class="header text-center">LOGIN</h3>-->
                    </div>
                    <div class="modal-body">
						<?php login_form(); ?>
                    </div>
                </div>
				<?php if(isset($_GET['login']) && $_GET['login'] == 'failed'){ ?>
                    <div class="errors">
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ERROR: Nombre de usuario o correo electrónico no válido o contraseña incorrecta.
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#login-modal').modal('show');
        });
    </script>
<?php } ?>
<script src="<?php echo bloginfo('template_url').'/';?>js/bootstrap.min.js"></script>
</body>
</html>