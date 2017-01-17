<?php $page = 'editproject'; ?>
<?php include('header-projects.php'); ?>
<?php
$id = $_GET['id'];
$project = $wpdb->get_results("select * from projects where project_id = $id")[0];
$project_users = $wpdb->get_results("select * from project_users where project_id = $id");

$args = array(
    'role__not_in' => 'subscriber',
    'orderby' => 'user_nicename',
    'order' => 'ASC'
);
$users = get_users($args);

foreach ($project_users as $assigned) {
    $pre_select[] = $assigned->user_id;
}

$pre_select = json_encode($pre_select);
?>
    <div id="projects">
        <div class="simple-form">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">EDIT PROJECT</text>
            <div class="info-content">
                <a href="<?php echo home_url().'/'; ?>/projects"><button type="button">Return to projects</button></a>
                <form method="POST" action="<?php echo home_url().'/'; ?>controller">
                    <div class="inside-content">
                        <div class="row no-margin">
                            <div class="col-sm-6">
                                <b><label for="projec-name">Project name:</label></b><input type="text" name="project-name" id="projec-name" value="<?php echo $project->project_name; ?>">
                            </div>
                            <div class="col-sm-6">
                                <b><label for="project-address">Address:</label></b><input type="text" name="project-address" id="project-address" value="<?php echo $project->project_address; ?>"><br>
                            </div>
                        </div>
                        <div class="row no-margin">
                            <div class="col-sm-4">
                                <b><label for="project-amount">Contract amount:</label></b> <input type="text" name="project-amount" id="project-amount" value="<?php echo $project->project_contract_amount; ?>"> <br>
                            </div>
                            <div class="col-sm-4">
                                <b><label for="project-year">Project year:</label></b> <input type="text" name="project-year" id="project-year" value="<?php echo $project->project_year; ?>"> <br>
                            </div>
                            <div class="col-sm-4">
                                <b><label for="project-area">Project area:</label></b> <input type="text" name="project-area" id="project-area" value="<?php echo $project->project_area; ?>"> <br>
                            </div>
                        </div>
                        <div class="row no-margin">
                            <div class="col-sm-4">
                                <b><label for="newproject-assigned">Assigned to:</label></b>
                                <?php $selected = ''; ?>
                                <select name="project-assigned[]" id="newproject-assigned" multiple="multiple">
                                    <?php foreach ($users as $user) { ?>
                                        <option value="<?php echo $user->ID ?>" <?php echo $selected; ?>>
                                            <?php
                                            if(get_user_meta($user->ID, 'first_name',true) != null) {
                                                echo get_user_meta($user->ID, 'first_name',true).' '.get_user_meta($user->ID, 'last_name',true);
                                            } else {
                                                echo $user->user_login;
                                            }
                                            ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="project-id" value="<?php echo $project->project_id; ?>">
                    </div>
                    <input type="submit" value="Submit Changes" name="edit-project" id="button-newproject">
                </form>
            </div>
        </div>
    </div>
    <script>
        $pre_select = <?php print_r($pre_select); ?>;
        console.log($pre_select);
        $('select').select2().val($pre_select).trigger('change');
    </script>
<?php include('footer-projects.php'); ?>