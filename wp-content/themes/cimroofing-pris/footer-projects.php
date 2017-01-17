<div class="modal fade" role="dialog" tabindex="-1" id="login-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php login_form(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo bloginfo('template_url').'/';?>js/bootstrap.min.js"></script>
</body>
</html>