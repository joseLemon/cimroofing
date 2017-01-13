<?php $page = 'projects'; ?>
<?php include('header-projects.php'); ?>
<?php
$count = $wpdb->get_var("SELECT COUNT(*) FROM projects");
$project = $wpdb->get_results("select * from projects");
$x = 0;
?>
    <div id="projects" style="min-height: 100vh;">
        <div class="container">
            <a href="#login-modal" data-toggle="modal" data-target="#login-modal">LOGIN</a>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">ACTIVE PROJECTS</text>
            <div class="info-content" style="background-color:transparent">
                <div class="inside-content">
                    <a href="<?php echo home_url().'/'; ?>newproject"><button type="button">New project</button></a><br>
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
                                    echo '<tr class="no-border scrolltr">';
                                    echo '<td class="no-border scrolltr">', $project[$x]->created_at, '</td>';
                                    echo '<td class="no-border scrolltr">', $project[$x]->project_year, '</td>';
                                    echo '<td class="no-border scrolltr ">
                                     <a href="projecthistory/?id=', $project[$x]->project_id ,'">', $project[$x]->project_name, '</a></td>';
                                    echo '<td class="no-border scrolltr">', $project[$x]->project_address, '</td>';
                                    echo '<td class="no-border scrolltr">', $project[$x]->project_area, '</td>';
                                    echo '<td class="no-border scrolltr">', $project[$x]->project_contract_amount, '</td>';
                                    echo '<td class="no-border scrolltr"><a href="editproject/?id=', $project[$x]->project_id ,'">Edit</a>|<button type="submit" name="delete-project" value="', $project[$x]->project_id ,'" class="btn-link">Delete</button></td>';
                                    echo '</tr>';
                                }
                                $x++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div style="margin-top:20px; margin-left: 15px;">
                    <a href="inspectionhistory"><button type="button">Inspection List</button></a>
                </div>
            </div>
        </div>
    </div>
<?php include('footer-projects.php'); ?>