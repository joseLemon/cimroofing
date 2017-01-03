<?php $page = 'newproject'; ?>

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


        <div id="projects" style="position:fixed">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">CREATE NEW PROJECT</text>
            <div class="info-content">

                <form method="POST" action="<?php echo home_url().'/'; ?>controller">
                    <div class="inside-content">

                        <input type="text" name="newproject-name" placeholder="Project name" id="long-text"><br>
                        <input type="text" name="newproject-address" placeholder="Address" id="long-text"><br>
                        <input type="text" name="newproject-amount" placeholder="Contract amount" id="short-text">
                        <input type="text" name="newproject-year" placeholder="Project year" id="short-text">
                        <input type="text" name="newproject-area" placeholder="Project area" id="short-text"><br>
                        <input type="text" name="newproject-assigned" placeholder="Assigned to" id="long-text">
                    </div>
                    <input type="submit" value="Submit Project" name="submit-newproject" id="button-newproject">
                </form>
            </div>
        </div>
    </body>
</html>