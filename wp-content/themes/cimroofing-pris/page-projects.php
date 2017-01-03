<?php $page = 'projects'; ?>

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
        $count = $wpdb->get_var("SELECT COUNT(*) FROM projects");
        $project = $wpdb->get_results("select * from projects");
        $x = 0;
        ?>

        <div id="projects">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">ACTIVE PROJECTS</text>
            <div class="info-content" style="background-color:transparent">
                <div class="inside-content">
                    <input type="submit" value="New" name="new-project"><br>
                    <form method="POST" action="<?php echo home_url().'/'; ?>controller">
                        <table style="margin-left:0;width:100%" class="no-border persist-area scrolltable">
                            <thead>
                                <tr class="no-border row-color persist-header">
                                    <th class="no-border scrollth">Created</th> 
                                    <th class="no-border scrollth">Year</th>
                                    <th class="no-border scrollth">Project</th>
                                    <th class="no-border scrollth">Address</th>
                                    <th class="no-border scrollth">Area</th>
                                    <th class="no-border scrollth">Contract $</th> <!-- checar permisos -->
                                    <th class="no-border scrollth"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($x<$count) {
                                    if($project[$x]->deleted_at == NULL){
                                        echo '<tr class="no-border sctolltr">';
                                        echo '<td class="no-border sctolltr center-element">', $project[$x]->created_at, '</td>';
                                        echo '<td class="no-border sctolltr center-element">', $project[$x]->project_year, '</td>';
                                        echo '<td class="no-border sctolltr center-element ">
                                     <a href="projecthistory/?id=', $project[$x]->project_id ,'">', $project[$x]->project_name, '</a></td>';
                                        echo '<td class="no-border sctolltr center-element">', $project[$x]->project_address, '</td>';
                                        echo '<td class="no-border sctolltr center-element">', $project[$x]->project_area, '</td>';
                                        echo '<td class="no-border sctolltr center-element">', $project[$x]->project_contract_amount, '</td>';
                                        echo '<td class="no-border sctolltr center-element"><a href="editproject/?id=', $project[$x]->project_id ,'">Edit</a>|<button type="submit" name="delete-project" value="', $project[$x]->project_id ,'" class="btn-link">Delete</button></td>';
                                        echo '</tr>';
                                    }
                                    $x++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div style="margin-top:20px">
                    <a href="inspectionform">New inspection list</a>
                </div>
            </div>
        </div>

        <?php include('footer.php'); ?>