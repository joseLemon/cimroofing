<?php $page = 'newproject'; ?>
<?php include('header-projects.php'); ?>
    <div id="projects" class="new-project">
        <div class="simple-form general-content">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">CREATE NEW PROJECT</text>
            <div class="info-content">
                <form method="POST" action="<?php echo home_url().'/'; ?>controller">
                    <div class="">
                        <div class="row no-margin">
                            <div class="imageupload col-sm-12">
                                <label for="selectimgs">Project photo</label>
                                <div class="upload-section">
                                    <button data-toggle="modal" data-target="#upload-modal" id="selectimgs">Select image...</button>
                                </div>
                                <div class="uploaded-images"></div>
                                <input type="hidden" id="tmp-folder-delete" name="tmp-folder-delete">
                            </div>
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

    <div class="modal fade" role="dialog" tabindex="-1" id="upload-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Image Selection</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo home_url().'/?id='; ?>controller" method="POST" id="upload-form" enctype="multipart/form-data">
                        <input class="hidden" type="file" id="pictures" name="pictures" value="Select file">
                        <a href="#" class="btn btn-default" onclick="document.getElementById('pictures').click(); return false;" />Select image</a>
                        <button class="btn btn-success" type="submit">Upload images</button>
                        <input type="file" id="fileID" style="visibility: hidden;" />
                        <input type="hidden" id="tmp-folder" name="tmp-folder">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo bloginfo('template_url').'/'; ?>/js/cropper.js"></script>
    <script>
        $('select').select2();

        var home = '<?php echo bloginfo('template_url');?>',
            tmpFolder = makeid(),
            imgDir = home+'/file_uploads/projects/'+tmpFolder,
            fileExt1 = '.png',
            fileExt2 = '.jpg',
            fileExt3 = '.jpeg',
            request = '';

        $('#tmp-folder').val(tmpFolder);
        $('#tmp-folder-delete').val(tmpFolder);

        function makeid() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < 5; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        var homeUrl = 'http://localhost/testpictures/';
        // REPLACE FOR <?php //echo home_url(); ?>

        $('#upload-form').submit(function(e) {
            e.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }

            var $form = $(this),
                $inputs = $form.find('input'),
                $serialiazedData = $form.serialize(),
                //$files = $('#pictures').prop('files'),
                $data = new FormData($(this)[0]);

            /*$.each($files, function(key, value) {
             data.append(key, value);
             });*/

            //$form_data.append('file', $file_data);

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
                        $('#upload-modal').modal('hide');
                        $('.uploaded-images').empty();
                        //List all .png file names in the page
                        //var $img_counter = 0;
                        $(data).find('a[href$="'+fileExt1+'"], a[href$="'+fileExt2+'"], a[href$="'+fileExt3+'"]').each(function () {
                            var $imgSrc = imgDir+'/'+$(this).attr('href');
                            $imgSrc = $imgSrc.replace('./', homeUrl);
                            $('.uploaded-images').append("<div class='col-sm-4'><img src='" + $imgSrc + "' class='img-responsive'><input type='hidden' name='img[]'></div>");
                            //$img_counter++;
                        });
                        $('.uploaded-images .col-sm-4 > img').cropper({
                            aspectRatio: 4 / 3,
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
            /*var data = $this.data();
             var $target;
             var result;
             var $image = $('.uploaded-images img').eq(0);

             result = $image.cropper();*/
            $('.uploaded-images .col-sm-4 > img').each(function() {
                $(this).nextAll('input').eq(0).val($(this).cropper('getCroppedCanvas').toDataURL('image/jpeg'));
            });
            $(this)[0].submit();
        });
    </script>
<?php include('footer-projects.php'); ?>