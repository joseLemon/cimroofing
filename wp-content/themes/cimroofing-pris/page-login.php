<?php $page = 'login'; ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CIM Roofing</title>
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/formstyles.css">
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </head>
    <body style="margin:0">


        <div id="login">
            <div class="general-content">

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
                <form method="get" action="controller.php">    <!-- checar -->
                    <table class="no-border login">
                        <tr class="no-border">
                            <td class="no-border">Username: </td> 
                            <td class="no-border"><input type="text" name="username"></td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">Password: </td>
                            <td class="no-border"><input type="password" name="password"></td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border"><input type="submit" value="Login" name="login-button"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>