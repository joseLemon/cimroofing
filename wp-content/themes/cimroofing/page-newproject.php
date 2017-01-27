<?php $page = 'newproject'; ?>
<?php include('header-projects.php'); ?>
    <div id="projects" class="new-project">
        <div class="simple-form general-content">
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
            <text class="title">CREATE NEW PROJECT</text>
            <div class="info-content">
                <form method="POST" action="<?php echo home_url().'/'; ?>controller" id="save">
                    <div class="">
                        <div class="alert alert-danger hidden" id="error"></div>
                        <div class="row no-margin">
                            <div class="imageupload col-sm-12">
                                <label for="selectimgs">Project photo</label>
                                <div class="upload-section">
                                    <button data-toggle="modal" data-target="#upload-modal" id="selectimgs">Select image...</button>
                                </div>
                                <div class="uploaded-images" id="images"></div>
                                <input type="hidden" id="tmp-folder-delete" name="tmp-folder-delete">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="newproject-name" placeholder="Project name" id="name"><br>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="newproject-address" placeholder="Address" id="address"><br>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="newproject-amount" placeholder="Contract amount" id="amount">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="newproject-year" placeholder="Project year" id="year">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="newproject-area" placeholder="Project area" id="area"><br>
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
                    <input type="hidden" name="submit-newproject">
                    <input type="submit" value="Submit Project" id="button-newproject">
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
                    <form action="<?php echo home_url().'/'; ?>controller" method="POST" id="upload-form" enctype="multipart/form-data">
                        <input class="hidden" type="file" id="pictures" name="pictures" value="Select file">
                        <a href="#" class="btn btn-default" onclick="document.getElementById('pictures').click(); return false;" />Select image</a>
                        <button class="btn btn-success" type="submit">Upload images</button>
                        <!-- HERE DETECT THE UPLOAD FOR PROJECT -->
                        <input type="file" id="fileID" style="visibility: hidden;" />
                        <input type="hidden" id="tmp-folder" name="tmp-folder">
                        <input type="hidden" name="projects">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden">
        <form action="<?php echo home_url().'/'; ?>controller" method="POST" id="unload">
            <input type="hidden" name="tmp-folder-unload" id="tmp-folder-unload">
            <input type="hidden" name="projects">
        </form>
    </div>
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

        $('#upload-form').submit(function(e) {
            e.preventDefault();

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

            request.done(function (response, textStatus, jqXHR) {
                console.log('Images saved successfully');
                $.ajax({
                    url: imgDir,
                    success: function(data) {
                        $('#upload-modal').modal('hide');
                        $('.uploaded-images').empty();
                        //List all .png file names in the page
                        $(data).find('a[href$="'+fileExt1+'"], a[href$="'+fileExt2+'"], a[href$="'+fileExt3+'"]').each(function () {
                            var $imgSrc = imgDir+'/'+$(this).attr('href');
                            $imgSrc = $imgSrc.replace('./', homeUrl);
                            $('.uploaded-images').append("<div class='col-sm-3'></div><div class='text-center col-sm-6'><div class='cropper-height'><img src='" + $imgSrc + "' class='img-responsive'><input type='hidden' name='img'></div></div>");
                        });
                        $('.uploaded-images .col-sm-6 img').cropper({
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

        $('#selectimgs').click(function(e){
            e.preventDefault();
        });

        $('#save').submit(function(e) {
            e.preventDefault();

            $('.uploaded-images .col-sm-6 > .cropper-height > img').each(function() {
                var $canvas = $(this).cropper('getCroppedCanvas'),
                    $img_base64 = $canvas.toDataURL('image/jpeg');
                $(this).nextAll('input').eq(0).val($img_base64);
            });

            var errors ="";
            var name = document.getElementById("name").value;
            var address = document.getElementById("address").value;
            var amount = document.getElementById("amount").value;
            var year = document.getElementById("year").value;
            var area = document.getElementById("area").value;
            var select = $("#newproject-assigned").val();

            if($("#images").html()==''){
                errors += "You must upload an image for the project<br>";
            }
            if( name == null || name.length == 0) {
                errors += "The name is required<br>";
            } else if(name.length > 80){
                    errors += "The maximum number of letters for the name is 80<br>";
            }
            if( address == null || address.length == 0) {
                errors += "The address is required<br>";
            } else if(address.length > 80){
                errors += "The maximum number of letters for the address is 80<br>";
            }
            if( amount == null || amount.length == 0) {
                errors += "The amount is required<br>";
            } else if(!/^\d+$/.test(amount)){
                errors += "Enter an amount in valid format<br>";
            }
            if( year == null || year.length == 0) {
                errors += "The year is required<br>";
            } else if(!/^\d{4}$/.test(year)){
                errors += "You must enter a valid year (e.g. 2017)<br>";
            }
            if( area == null || area.length == 0) {
                errors += "The area is required<br>";
            } else if(!/^\d{1,11}$/.test(area)){
                errors += "You must enter a valid area (e.g. 50000, max 11 digits)<br>";
            }
            if( select.length == 0){
                errors += "You must choose at least one user in charge of the project<br>";
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