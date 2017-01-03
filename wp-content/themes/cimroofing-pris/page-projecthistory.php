<?php $page = 'projecthistory'; ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project History</title>
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/formstyles.css">
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </head>
    <body style="margin:0">
        <?php 
        $id = $_GET['id'];
        
        
        $count = $wpdb->get_var("SELECT COUNT(*) FROM reports WHERE project_id= '$id'");
        $report = $wpdb->get_results("select * from reports WHERE project_id= '$id'");
        $project = $wpdb->get_results("select * from projects WHERE project_id= '$id'");
        $x = 0;
        ?>

        <div id="projectform">
            <div class="general-content">

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
                <text class="title"><?php echo $project[0]->project_name ?></text><br>
                <text class="title" style="font-size=18px;line-height:0px">Project History</text><br>
                <div class="inside-content">
                   <!-- <form method="POST" action="controller.php">-->
                        <div class="project-info">
                            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/project-img-example.png" alt="imagen proyecto" class="project-img">
                            <div class="information">
                                Project Name:&nbsp;<text class="project-name"><?php echo $project[0]->project_name ?></text><br>
                                Address:&nbsp;<text class="project-name"><?php  echo $project[0]->project_address ?></text><br>
                                Contract Amount:&nbsp;<text class="project-name">$<?php echo $project[0]->project_contract_amount ?></text><br> <!-- SOLO VISTO POR ADMIN -->
                                Project Year:&nbsp;<text class="project-name"><?php echo $project[0]->project_year ?></text><br>
                                Project Area:&nbsp;<text class="project-name"><?php echo $project[0]->project_area ?></text><br>
                            </div>
                        </div>
                        <br>
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                        <div class="log-reporting-period">
                               <?php echo'<a href="reportform/?id=', $id ,'"><button name="new-report" style="margin-bottom:15px">New report</button></a>'; ?><br>
                            <table style="margin-left:0;width:100%" class="no-border persist-area scrolltable">
                                <thead>
                                    <tr class="no-border row-color persist-header">
                                        <th class="no-border scrollth">Submitted</th> 
                                        <th class="no-border scrollth">Submitted By</th>
                                        <th class="no-border scrollth">Start</th>
                                        <th class="no-border scrollth">End</th>
                                        <th class="no-border scrollth">Square Feet Installed</th>
                                        <th class="no-border scrollth"></th>
                                    </tr>
                                </thead>
                                <?php
                            while($x<$count) {
                                echo '<tr class="no-border sctolltr">';
                                    echo '<td class="no-border sctolltr center-element">', $report[$x]->created_at, '</td>';
                                    echo '<td class="no-border sctolltr center-element">', $report[$x]->user_id, '</td>'; //checar
                                    echo '<td class="no-border sctolltr center-element ">', $report[$x]->report_start_date, '</td>';
                                    echo '<td class="no-border sctolltr center-element">', $report[$x]->report_end_date, '</td>';
                                    echo '<td class="no-border sctolltr center-element">', $report[$x]->report_square_feet_to_date, '</td>';
                                    echo '<td class="no-border sctolltr center-element"><a href="editreport?id=', $report[$x]->project_id ,'&rid=',  $report[$x]->report_id,'">Edit</a>|<a href="">View</a></td>';
                                echo '</tr>';
                                $x++;
                            }
                            ?>
                                </tbody>
                            </table>
                        </div>  
                        </div>
                </div>
            </div>
            <?php include('footer.php'); ?>