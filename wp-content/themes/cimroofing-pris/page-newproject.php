<?php $page = 'newproject'; ?>
<?php include('header-projects.php'); ?>
    <div id="projects" class="new-project">
        <div class="container simple-form">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">CREATE NEW PROJECT</text>
            <div class="info-content">
                <form method="POST" action="<?php echo home_url().'/'; ?>controller">
                    <div class="inside-content">
                        <div class="row no-margin">
                            <div class="col-sm-6">
                                <input type="text" name="newproject-name" placeholder="Project name" id="long-text"><br>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="newproject-address" placeholder="Address" id="long-text"><br>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="newproject-amount" placeholder="Contract amount" id="short-text">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="newproject-year" placeholder="Project year" id="short-text">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="newproject-area" placeholder="Project area" id="short-text"><br>
                            </div>
                            <div class="col-sm-4">
                                <?php
                                $args = array(
                                    'role__not_in' => 'subscriber',
                                    'orderby' => 'user_nicename',
                                    'order' => 'ASC'
                                );
                                $users = get_users($args);
                                ?>
                                <select name="newproject-assigned[]" id="newproject-assigned" multiple="multiple">
                                    <?php foreach($users as $user) { ?>
                                        <option value="<?php echo $user->ID ?>">
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
                    </div>
                    <input type="submit" value="Submit Project" name="submit-newproject" id="button-newproject">
                </form>
            </div>
        </div>
    </div>
    <script>
        $('select').select2();
    </script>
<?php include('footer-projects.php'); ?>