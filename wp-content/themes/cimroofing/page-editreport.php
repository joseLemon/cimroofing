<?php $page = 'editreport'; ?>
<?php include('header-projects.php'); ?>
<?php

$id = $_GET['id'];
$rid = $_GET['rid'];
$project_images = $wpdb->get_results("select * from project_pictures where report_id = $id");
$project = $wpdb->get_results("select * from projects where project_id = $id");
$report = $wpdb->get_results("select * from reports where report_id = $rid");
$report = $report[0];

?>

    <div id="projectform">
        <div class="general-content">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">
                <?php echo $project[0]->project_name ?>
            </text><br>
            <div class="alert alert-danger hidden" id="error"></div>
            <div class="inside-content">
                <p class="content">Contractor work log: Please submit the following log at the specified frequency identified by Roof Management during the preconstruction meeting. The log should provide an accurate account of the work items completed, progress to completion, issues encountered and photo representation of various stages of work during the reporting period.</p>

                <form method="POST" action="<?php echo home_url().'/'; ?>controller" id="save">
                    <div class="project-info">
                        <img src="<?php echo bloginfo('template_url').'/'; ?>file_uploads/projects/<?php echo $_GET['id']; ?>/project_image.jpg" alt="imagen proyecto" class="project-img">
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
                        <text style="font-weight:700;font-size:19px">LOG REPORTING PERIOD</text><br>
                        Step 1: Identify the reporting period for this work log submission. <br>
                        <table style="margin-left:0" class="no-border">
                            <tr class="no-border">
                                <td class="no-border">Start Date:</td>
                                <td class="no-border"><input type="date" name="start-date" id="dateproject" value="<?php echo $report->report_start_date; ?>"></td>
                            </tr>
                            <tr class="no-border">
                                <td class="no-border">End Date: </td>
                                <td class="no-border"><input type="date" name="end-date" id="dateproject" value="<?php echo $report->report_end_date; ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <?php echo '<input type="hidden" name="project-id" value="', $id ,'">'; ?>
                    <br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                    <div class="work-items-completed">
                        <text style="font-weight:700;font-size:19px">WORK ITEMS COMPLETED</text><br>
                        Step 2: Select the work items completed during the reporting period of this log.  <br>
                        <table style="margin-left:auto;margin-right:auto;margin-top:10px">
                            <tr class="no-border">
                                <?php
                                $count = $wpdb->get_var("SELECT COUNT(*) FROM report_work_items WHERE report_id= '$rid'");
                                $work = $wpdb->get_results("select work_item_id from report_work_items where report_id = $rid");
                                $work_name = $wpdb->get_results("select work_item_name from work_items");

                                for($i=1;$i<=20;$i++){
                                    $found = false;

                                    /* if(($column % 3) == 0){
                                echo '<tr class="no-border">';
                            }*/

                                    for($n=0;$n<$count;$n++){
                                        if($work[$n]->work_item_id == $i)
                                            $found = true;
                                    }

                                    if($found==true)
                                        echo '<td class="no-border"><input type="checkbox" name="workitems[]" value="', $i ,'" id="workitems" checked />', $work_name[($i-1)]->work_item_name ,'</td>';
                                    else
                                        echo '<td class="no-border"><input type="checkbox" name="workitems[]" value="', $i ,'" id="workitems" />', $work_name[($i-1)]->work_item_name ,'</td>';


                                    if((($i % 3) == 0) && $i!=1){
                                        echo '</tr><tr class="no-border">';
                                    }

                                }

                                ?>
                            <tr class="no-border">
                        </table><br>
                    </div>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                    <div class="progress-completion">
                        <text style="font-weight:700;font-size:19px">PROGRESS TO COMPLETION</text><br>
                        Step 3: Update the progress to completion by inputting the total percent complete and the total square feet of the roofing <text style="color:red;font-weight:600">installed to date.</text>  <br>
                        <table style="margin-left:0" class="no-border">
                            <tr class="no-border">
                                <td class="no-border">Square feet installed to date:</td>
                                <td class="no-border"><input type="text" name="square-feet-todate" id="square-feet-todate" value="<?php echo $report->report_square_feet_to_date; ?>"></td>
                            </tr>
                            <tr class="no-border">
                                <td class="no-border">Percentage completed: </td>
                                <td class="no-border"><input type="text" name="percentage-completed" id="percentagecompleted" value="<?php echo $report->report_percentage_completed; ?>"></td>
                            </tr>
                            <tr class="no-border">
                                <td class="no-border">Target completion date: </td>
                                <td class="no-border"><input type="date" name="target-date" id="targetdate" value="<?php echo $report->report_target_completion_date; ?>"></td>
                            </tr>
                        </table>
                        <?php
                        if($report->report_completed==1){
                            echo '<input type="checkbox" name="completion-metal" value="1" checked/>';
                        }else{
                            echo '<input type="checkbox" name="completion-metal" value="1" />';
                        }?>
                        Upon completion of detail and metal work, please check this box. <br>
                    </div><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                    <div class="fieldnotes">
                        <text style="font-weight:700;font-size:19px">FIELD NOTES</text><br>
                        Step 4: Provide details on any situations, weather issues or concerns encountered during the reporting period.<br>
                        <textarea id="details-field-notes" name="details-field-notes"><?php echo $report->report_field_notes; ?></textarea><br>
                    </div><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                    <div class="fieldnotes">
                        <text style="font-weight:700;font-size:19px">PHOTO DOCUMENTATION</text><br>
                        Step 5: Provide photographs detailing various stages of the installation process for the reporting period.<br>
                        <div class="upload-section">
                            <a href="#select-warning" class="btn btn-default"  data-toggle="modal" data-target="#select-warning">Select image</a>
                        </div>
                        <!--<input type="file" value="Add/Edit Pictures" name="add-pictures" id="pictures-button"><br>-->
                        <div class="image-tumbnails">Image thumbnails</div><br>
                        <div class="image-thumbs">
                            <?php
                            $directory = dirname(__FILE__) . '\\file_uploads\\reports\\' . $_GET['rid'] . '\\';
                            $images = glob($directory.'*.jpg');
                            $counter = 0;
                            foreach($project_images as $image) {
                                ?>
                                <div class="col-sm-4">
                                    <?php
                                    echo '<img src="'.get_bloginfo('template_url').'/file_uploads/reports/'.$_GET['rid'].'/'.$image->project_picture_name.'.jpg" class="center-block">';
                                    echo '<p>'.$image->project_picture_description.'</p>';
                                    ?>
                                </div>
                                <?php
                                $counter++;
                                if($counter%3 == 0){
                                    echo '<div class="clearfix"></div>';
                                }
                            }
                            ?>
                            <div class="uploaded-images"></div>
                        </div>
                    </div><br>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                    <div class="fieldnotes">
                        <text style="font-weight:700;font-size:19px">SUBMIT LOG</text><br>
                        Step 6: Provide the name of the submitter and click the button to submit the log.
                        <div class="signature">
                            <text class="submitted-by">
                                Submitted By:
                                <?php
                                if(get_user_meta($report->user_id, 'first_name',true) != null) {
                                    echo get_user_meta($report->user_id, 'first_name',true).' '.get_user_meta($report->user_id, 'last_name',true);
                                } else {
                                    echo get_user_by('id',$report->user_id)->user_login;
                                }
                                ?>
                            </text><br>
                            <input type="hidden" name="report-id" value="<?php echo $report->report_id; ?>">
                            <input type="hidden" name="project-id" value="<?php echo $report->project_id; ?>">
                            <input type="hidden" name="edit-report">
                            <input type="submit" value="Submit" id="editreport-button">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden">
        <form action="<?php echo home_url().'/?id='; ?>controller" method="POST" id="upload-form" enctype="multipart/form-data">
            <input class="hidden" type="file" id="pictures" name="pictures[]" multiple value="Select files">
            <a href="#" class="btn btn-default" onclick="document.getElementById('pictures').click(); return false;" />Select images</a>
            <button class="btn btn-success" type="submit">Upload images</button>
            <input type="file" id="fileID" style="visibility: hidden;" />
            <input type="hidden" id="tmp-folder" name="tmp-folder">
        </form>
    </div>

    <div class="hidden">
        <form action="<?php echo home_url().'/'; ?>controller" method="POST" id="unload">
            <input type="hidden" name="tmp-folder-unload" id="tmp-folder-unload">
            <input type="hidden" name="reports">
        </form>
    </div>

    <div class="modal fade fade-scale" role="dialog" id="select-warning">
        <div class="modal-dialog">
            <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <div class="modal-content">
                <div class="modal-login-form">
                    <div class="modal-header">
                        <h3>IMPORTANT</h3>
                    </div>
                    <div class="modal-body">
                        <p class="text">
                            Selecting new images will replace the current ones attached to this report, those which
                            will be lost should you choose to continue.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" href="#" onclick="document.getElementById('pictures').click(); return false;">OK</a>
                        <a href="#" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo bloginfo('template_url').'/'; ?>/js/cropper.js"></script>
    <script>
        $(document).ready(function () {
            $('head').append('<meta http-equiv="cache-control" content="max-age=0" />' +
                '<meta http-equiv="cache-control" content="no-cache" />' +
                '<meta http-equiv="expires" content="0" />' +
                '<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />' +
                '<meta http-equiv="pragma" content="no-cache" />');
        });

        var home = '<?php echo bloginfo('template_url');?>',
            tmpFolder = makeid(),
            imgDir = home+'/file_uploads/reports/'+tmpFolder,
            fileExt1 = '.png',
            fileExt2 = '.jpg',
            fileExt3 = '.jpeg',
            request = '';

        $('#tmp-folder').val(tmpFolder);
        $('#tmp-folder-delete').val(tmpFolder);
        $('#tmp-folder-unload').val(tmpFolder);

        function makeid() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < 5; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        var homeUrl = 'http://localhost/testpictures/';
        // REPLACE FOR <?php //echo home_url(); ?>

        $('#pictures').change(function () {
            $('#upload-form').submit();
            $('#select-warning').modal('hide');
        });

        $('#upload-form').submit(function(e) {
            e.preventDefault();

            console.log('enter');

            // Abort any pending request
            if (request) {
                request.abort();
            }

            var $form = $(this),
                $inputs = $form.find('input'),
                $data = new FormData($(this)[0]);

            $inputs.prop('disabled', true);
            $('.loader-container').addClass('active');

            request = $.ajax({
                url: '<?php echo home_url();?>/controller',
                type: 'post',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                success: function (data) {
                    //alert("Data Uploaded: "+data);
                },
                data: $data,
                cache: false,
                contentType: false,
                processData: false
            });

            //console.log($serialiazedData);

            request.done(function (response, textStatus, jqXHR) {
                console.log('Images saved successfully');
                $.ajax({
                    url: imgDir,
                    success: function(data) {
                        $('.uploaded-images').empty();
                        var cont = 0;
                        $('.uploaded-images').append('New images <div class="clearfix"></div>');
                        $(data).find('a[href$="'+fileExt1+'"], a[href$="'+fileExt2+'"], a[href$="'+fileExt3+'"]').each(function () {
                            var $imgSrc = imgDir+'/'+$(this).attr('href');
                            $imgSrc = $imgSrc.replace('./', homeUrl);
                            $('.uploaded-images').append("<div class='col-sm-4'><div class='cropper-height'><img src='" + $imgSrc + "' class='img-responsive'><input type='hidden' name='img[]'></div><input type='text' placeholder='Description of the image' class='img-desc' name='"+cont+"'></div>");
                            cont++;
                        });
                        $('.uploaded-images .col-sm-4 img').cropper({
                            aspectRatio: 4 / 3,
                            autoCrop: true,
                        });
                        $data = new FormData($('#unload')[0]);
                        $.ajax({
                            url: '<?php echo home_url();?>/controller',
                            type: 'post',
                            xhr: function() {
                                var myXhr = $.ajaxSettings.xhr();
                                return myXhr;
                            },
                            success: function (data) {
                                console.log("Data unloaded");
                            },
                            data: $data,
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error(
                    'The following error has occurred: ' +
                    textStatus, errorThrown
                );
            });

            setTimeout(function() {
                request.always(function () {
                    // Reenable the inputs
                    $inputs.prop("disabled", false);
                    $('.loader-container').removeClass('active');
                });
            },500);
        });

        $('#selectimgs').click(function(f){
            f.preventDefault();
        });

        $('#save').submit(function(e) {
            e.preventDefault();

            $('.uploaded-images .col-sm-4 > .cropper-height > img').each(function() {
                var $canvas = $(this).cropper('getCroppedCanvas'),
                    $img_base64 = $canvas.toDataURL('image/jpeg');
                $(this).nextAll('input').eq(0).val($img_base64);
            });

            var errors ="";
            var start = $("input[name=start-date]").val();
            var end = $("input[name=end-date]").val();
            //var workItems = $('#workitems:checked').length;
            var squareFeetToDate = $("#square-feet-todate").val();
            var percentageCompleted = $("#percentagecompleted").val();
            var targetdate = $("#targetdate").val();
            var detailsFieldNotes = $("#details-field-notes").val();

            if( start == null || start.length == 0) {
                errors += "The Start Date is required<br>";
            }
            if( start == null || start.length == 0) {
                errors += "The End Date is required<br>";
            }
            /*if( workItems == 0) {
             errors += "You must complete at least one work item<br>";
             }*/
            if( squareFeetToDate == null || squareFeetToDate.length == 0) {
                errors += "The Square feet installed to date is required<br>";
            } else if(!/^\d+$/.test(squareFeetToDate)){
                errors += "Enter a valid number for Square feet installed to date (only whole numbers)<br>";
            }
            if( percentageCompleted == null || percentageCompleted.length == 0) {
                errors += "The Percentage completed is required<br>";
            } else if(!/^\d{1,4}$/.test(percentageCompleted)){
                errors += "Enter a valid percentage of completion (only whole numbers)<br>";
            } else if (percentageCompleted > 100) {
                errors += "You can not select a percentage of completion greater than 100<br>";
            }
            if( targetdate == null || targetdate.length == 0) {
                errors += "The Target completion date is required<br>";
            }
            if( detailsFieldNotes == null || detailsFieldNotes.length == 0) {
                errors += "The field notes are required<br>";
            } else if(detailsFieldNotes.length > 512){
                errors += "The maximum number of letters for the field notes is 521<br>";
            }
            if($("#images").html()==''){
                errors += "You must upload an image for the project<br>";
            }
            //redireccion
            if(errors=="") {
                $(this)[0].submit();
            } else {
                //colorear los campos mal ingresados
                $("#error").removeClass('hidden').addClass('active').html("Whoops <br>"+errors);
                $('html,body').animate({ scrollTop: 0 }, 'slow');
                return false;
            }
        });
    </script>
<?php include('footer-projects.php'); ?>