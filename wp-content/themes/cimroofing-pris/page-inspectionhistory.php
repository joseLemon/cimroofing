<?php $page = 'inspectionhistory'; ?>

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
        $count = $wpdb->get_var("SELECT COUNT(*) FROM clients");
        $client = $wpdb->get_results("select * from clients");
        $inspection = $wpdb->get_results("select * from roof_inspections");
        $flat = $wpdb->get_results("select * from type_roof_flat");
        $sloped = $wpdb->get_results("select * from type_roof_sloped");
        $x = 0;
        ?>


        <div id="projectform">
            <div class="general-content">

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
                <text class="title" style="font-size=18px;line-height:0px">Inspection Lists History</text><br>
                <div class="inside-content">

<!--                    <form method="POST" action="controller.php">-->

                        <div class="log-reporting-period">
                           <a href="inspectionform"><button name="new-inspection" style="margin-bottom:15px">New inspection list</button></a>
                            <table style="margin-left:0;width:100%" class="no-border persist-area scrolltable">
                                <thead>
                                    <tr class="no-border row-color persist-header">
                                        <th class="no-border scrollth">Submitted</th> 
                                        <th class="no-border scrollth">Facility</th>
                                        <th class="no-border scrollth">Dimension</th>
                                        <th class="no-border scrollth">Type of roof</th>
                                        <th class="no-border scrollth">Inspection date</th>
                                        <th class="no-border scrollth"></th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    <?php
                                    while($x<$count) {
                                        if($client[$x]->type_roof_sloped_id == NULL){
                                            $rid = $client[$x]->type_roof_flat_id;
                                            $result = $wpdb->get_var("select type_roof_flat_name from type_roof_flat where type_roof_flat_id= '$rid' ");
                                        } else{
                                            $rid = $client[$x]->type_roof_sloped_id;
                                            $result = $wpdb->get_var("select type_roof_sloped_name from type_roof_sloped where type_roof_sloped_id= '$rid' ");
                                        }

                                        echo '<tr class="no-border sctolltr">';
                                        echo '<td class="no-border sctolltr center-element">', $client[$x]->created_at, '</td>';
                                        echo '<td class="no-border sctolltr center-element">', $inspection[$x]->roof_inspection_facility ,'</td>';
                                        echo '<td class="no-border sctolltr center-element ">', $client[$x]->client_size_of_roof, 'ft&sup2;</td>';
                                        echo '<td class="no-border sctolltr center-element">', $result ,'</td>';
                                        echo '<td class="no-border sctolltr center-element">', $inspection[$x]->roof_inspection_datetime ,'</td>';
                                        echo '<td class="no-border sctolltr center-element"><a href="editinspectionform/?id=', $client[$x]->client_id ,'">Edit</a>|<a href="">View</a></td>';
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