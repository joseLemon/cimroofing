<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
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