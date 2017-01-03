<?php $page = 'editproject'; ?>

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
        <?php 

        $id = $_GET['id'];
        $project = $wpdb->get_results("select * from projects where project_id = $id");
        $project = $project[0];

        ?>

        <div id="projects">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">EDIT PROJECT</text>
            <div class="info-content">

                <form method="POST" action="<?php echo home_url().'/'; ?>controller">
                    <div class="inside-content">
                        <b>Project name:</b><input type="text" name="project-name" value="<?php echo $project->project_name; ?>"> <br>
                        <b>Address:</b><input type="text" name="project-address" value="<?php echo $project->project_address; ?>"><br>
                        <b>Contract amount:</b> <input type="text" name="project-amount" value="<?php echo $project->project_contract_amount; ?>"> <br>
                        <b>Project year:</b> <input type="text" name="project-year" value="<?php echo $project->project_year; ?>"> <br>
                        <b>Project area:</b> <input type="text" name="project-area" value="<?php echo $project->project_area; ?>"> <br>
                        <b>Assigned to:</b> PENDIENTE <br>
                        <input type="hidden" name="project-id" value="<?php echo $project->project_id; ?>">
                    </div>
                    <input type="submit" value="Submit Changes" name="edit-project" id="button-newproject">
                </form>
            </div>
        </div>
    </body>
</html>