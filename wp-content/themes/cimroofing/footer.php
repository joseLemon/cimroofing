<div class="free-inspection">
    <a href="free-inspecion"><img class="img-responsive" src="<?php echo bloginfo('template_url').'/'; ?>img/content/free-inspection.png" alt="Free Inspection"></a>
</div>

<script src="<?php echo bloginfo('template_url').'/';?>js/bootstrap.min.js"></script>
<script src="<?php echo bloginfo('template_url').'/';?>js/app.js"></script>
<script src="<?php echo bloginfo('template_url').'/';?>js/jquery.scrollbar.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        if($('#fullpage').length > 0) {
            $('#fullpage').fullpage({
                verticalCentered: false
            });
        }
        if($('#fullpage-nosotros').length > 0) {
            $('#fullpage-nosotros').fullpage({
                verticalCentered: false,
                anchors: ['section-nosotros', 'section-filosofia', 'section-valores', 'section-fabricantes',
                    'section-responsabilidad', 'section-certificaciones', 'section-empleos'],
                afterLoad: function () {
                    activateDropdownLinks();
                }
            });
        }
        if($('#fullpage-servicios').length > 0) {
            $('#fullpage-servicios').fullpage({
                verticalCentered: false,
                anchors: ['section-impermeabilizacion', 'section-renovacion', 'section-reemplazo', 'section-reparacion',
                    'section-preventivo', 'section-inspeccion', 'section-contrato'],
                afterLoad: function () {
                    activateDropdownLinks();
                }
            });
        }

        $('.scrollbar-inner').scrollbar();
    });
</script>

</body>
</html>