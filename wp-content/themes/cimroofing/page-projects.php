<?php $page = 'projects'; ?>
<?php include('header-projects.php'); ?>
<?php
$user_id = get_current_user_id();
if ( current_user_can('manage_options') ) {
	$projects = $wpdb->get_results("SELECT *, projects.project_id as id FROM projects LEFT JOIN project_users ON projects.project_id = project_users.project_id WHERE deleted_at IS NULL GROUP BY projects.project_id");
} else {
	$projects = $wpdb->get_results("SELECT * FROM projects LEFT JOIN project_users ON projects.project_id = project_users.project_id WHERE deleted_at IS NULL AND user_id = '$user_id' GROUP BY projects.project_id");
}
?>
<?php if(is_user_logged_in()) { ?>
    <div id="projects">
        <div class="general-content">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">ACTIVE PROJECTS</text>
            <div class="info-content">
                <div class="inside-content">
					<?php if ( current_user_can('manage_options') ) { ?>
                        <a href="<?php echo home_url().'/'; ?>newproject"><button type="button">New project</button></a><br>
					<?php } ?>
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
								<?php if ( current_user_can('manage_options') ) { ?>
                                    <th class="no-border scrollth"></th>
								<?php } ?>
                            </tr>
                            </thead>
                            <tbody>
							<?php
							foreach($projects as $project) {
								echo '<tr class="no-border scrolltr">';
								echo '<td class="no-border scrolltr">', $project->created_at, '</td>';
								echo '<td class="no-border scrolltr">', $project->project_year, '</td>';
								echo '<td class="no-border scrolltr "><a href="projecthistory/?id=',$project->id,'">', $project->project_name, '</a></td>';
								echo '<td class="no-border scrolltr">', $project->project_address, '</td>';
								echo '<td class="no-border scrolltr">', $project->project_area, '</td>';
								echo '<td class="no-border scrolltr">', $project->project_contract_amount, '</td>';
								if ( current_user_can('manage_options') ) {
									echo '<td class="no-border scrolltr"><a href="editproject/?id=', $project->project_id, '">Edit</a>|<button type="submit" name="delete-project" value="', $project->project_id, '" class="btn-link">Delete</button></td>';
								}
								echo '</tr>';
							}
							?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div style="margin-top:20px; margin-left: 15px;">
					<?php if ( current_user_can('manage_options') ) { ?>
                        <a href="inspectionhistory"><button type="button">Inspection List</button></a>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include('footer-projects.php'); ?>