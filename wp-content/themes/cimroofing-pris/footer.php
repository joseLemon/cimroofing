<script src="<?php echo bloginfo('template_url').'/';?>js/bootstrap.min.js"></script>
<script src="<?php echo bloginfo('template_url').'/';?>js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#fullpage').fullpage({
            verticalCentered: false, 
            afterLoad: function() {
                activateDropdownLinks();
            }
        });
    });
</script>

</body>
</html>