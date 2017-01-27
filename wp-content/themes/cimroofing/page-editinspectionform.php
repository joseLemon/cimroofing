<?php $page = 'editinspectionform'; ?>
<?php include('header-projects.php'); ?>
<?php
$id = $_GET['id'];
$client = $wpdb->get_results("select * from clients where client_id = $id");
$inspection = $wpdb->get_results("select * from roof_inspections where client_id = $id");
$client = $client[0];
$inspection = $inspection[0];

if(get_user_meta($client->user_id, 'first_name',true) != null) {
    $user_name = get_user_meta($client->user_id, 'first_name',true).' '.get_user_meta($client->user_id, 'last_name',true);
} else {
    $user_name = get_user_by('id', $client->user_id)->user_login;
}
?>

    <div id="reportform">

        <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
        <text class="title">ROOF INSPECTION LIST</text><br>
        <div class="alert alert-danger hidden" id="error"></div>
        <div class="general-content">
            <div class="inside-content">
                <div class="info-section">
                    <div class="title-section" style="margin-top:5px">BACKGROUND</div>
                    <p class="content">Roof systems can deteriorate from: normal wear; severe weather conditions (e.g. wind and snow loads); building movement (e.g., settlement, material contraction/expansion); and improper design, construction, and maintenance.</p>
                    <p class="content">Any roof repairs not dealt with after the first signs of failure can result in increased damage to the building envelope and interior finishes, and a loss of occupant productivity if damage causes interruption in client services and program delivery. Failure of structural integrity can endanger occupant safety.</p>
                </div>
                <div class="info-section">
                    <div class="title-section">PURPOSE</div>
                    <p class="content">Regular inspection of building roof systems will lead to early detection of roof problems, protection of capital assets, and maintenance of safe working environments for building occupants.</p>
                </div>
                <div class="info-section">
                    <div class="title-section">OBJECTIVES</div>
                    <ul style="list-style-type:disc">
                        <li class="content">To determine if the roof system is performing according to its intended function.</li>
                        <li class="content">To identify signs of weakness, deterioration, or hazard.</li>
                        <li class="content">To identify needed repairs.</li>
                    </ul>
                </div>
                <div class="info-section">
                    <div class="title-section">GENERAL APPROACH</div>
                    <ul style="list-style-type:disc">
                        <li class="content">Inspect exterior for: continuity of roof covering; deterioration of fascia, gutters and soffits; and performance of flashings.</li>
                        <li class="content">Inspect interior finishes (ceilings and walls) for signs of water penetration, frost buildup and structural distress.</li>
                        <li class="content">CIM's roof inspectors prepare, record, and report inspection findings.</li>
                        <li class="content">Our reports include photographs and test data so that changes in roof condition can be verified and a historic record of roof condition is available to future inspectors.</li>
                        <li class="content">CIM's keeps and maintains records of all: inspections (including this checklist); test investigations (thermographic readings); and roofing repairs and replacements.</li>
                        <li class="content">Initiate maintenance and repair projects.</li>
                    </ul>
                </div>
                <text class="content" style="color: #004989;text-align:center;display: inherit">To set up roof inspections or existing conditions inspections contact    IOCHOA@CIMROOFING.COM</text><br>

                <form method="POST" action="<?php echo home_url().'/'; ?>controller" id="editinspection-form">
                    <input type="hidden" name="client-id" value="<?php echo $id; ?>">
                    <input type="hidden" name="inspection-id" value="<?php echo $inspection->roof_inspection_id; ?>">
                    <div class="row no-margin">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="project-owner" id="project-owner" placeholder="Project Owner" value="<?php echo $client->client_project_owner; ?>"><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="project-address" id="project-address" placeholder="Project Address" value="<?php echo $client->client_project_address; ?>"><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-4 col-sm-6">
                            <input type="text" name="height-at-eave" id="height-at-eave" placeholder="Height at eave" value="<?php echo $client->client_height_at_eave; ?>">
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <input type="text" name="height-at-ridge" id="height-at-ridge" placeholder="Height at ridge" value="<?php echo $client->client_height_at_ridge; ?>"><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-12">
                            <text class="content">Clear access  </text>
							<?php
							if($client->clear_access_id == NULL){
								echo '<input type="radio" name="clear-access" value="no" checked><text class="content">No </text>
                                 <input type="radio" name="clear-access" value="yes"><text class="content">Yes </text>
                                 <select name="clearaccessposition" id="clearaccessposition" disabled>
                                <option value="" disabled selected>Select</option>';
								$clearSelect = $wpdb->get_results("select clear_access_id, clear_access_name from clear_access");
								foreach($clearSelect as $clear){
									echo '<option value="'.$clear->clear_access_id.'">'.$clear->clear_access_name.'</option>';
								}
							}else{
								echo '<input type="radio" name="clear-access" value="no"><text class="content">No </text>
                                <input type="radio" name="clear-access" value="yes" checked><text class="content">Yes </text>
                                 <select name="clearaccessposition" id="clearaccessposition" disabled>
                                <option value="" disabled>Select</option>';
								$clearSelect = $wpdb->get_results("select clear_access_id, clear_access_name from clear_access");
								foreach($clearSelect as $clear){
									if($client->clear_access_id != $clear->clear_access_id)
										echo '<option value="'.$clear->clear_access_id.'">'.$clear->clear_access_name.'</option>';
									else
										echo '<option value="'.$clear->clear_access_id.'" selected>'.$clear->clear_access_name.'</option>';
								}
							}
							?>
                            </select>
                            <script>
                                $('input[   name=clear-access]').change(function() {
                                    if($('input[name=clear-access]:checked').val() == 'no') {
                                        $('#clearaccessposition').attr('disabled','disabled');
                                    } else {
                                        $('#clearaccessposition').removeAttr('disabled');
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-12 one-line">
                            <text class="content">Type of roof  </text><?php
							if($client->type_roof_sloped_id == NULL){
								echo '<input type="radio" name="type-of-roof" value="flatmembrane" checked><text class="content">Flat/Membrane </text>
                            <select name="flatmembrane-select" id="flatmembraneselect" disabled>
                            <option value="" disabled>Select</option>';
								$flatMembrane = $wpdb->get_results("select type_roof_flat_id, type_roof_flat_name from type_roof_flat");
								foreach($flatMembrane as $flat){
									if($client->type_roof_flat_id != $flat->type_roof_flat_id)
										echo '<option value="'.$flat->type_roof_flat_id.'">'.$flat->type_roof_flat_name.'</option>';
									else
										echo '<option value="'.$flat->type_roof_flat_id.'" selected>'.$flat->type_roof_flat_name.'</option>';
								}
								echo '</select>
                            <input type="radio" name="type-of-roof" value="sloped"><text class="content">Sloped </text>
                            <select name="sloped-select" id="slopedselect" disabled>
                            <option value="" disabled selected>Select</option>';
								$slopedSelect = $wpdb->get_results("select type_roof_sloped_id, type_roof_sloped_name from type_roof_sloped");
								foreach($slopedSelect as $sloped){
									echo '<option value="'.$sloped->type_roof_sloped_id.'">'.$sloped->type_roof_sloped_name.'</option>';
								}
								echo '</select>';
							}else{
								echo '<input type="radio" name="type-of-roof" value="flatmembrane"><text class="content">Flat/Membrane </text>
                            <select name="flatmembrane-select" id="flatmembraneselect" disabled>
                            <option value="" disabled selected>Select</option>';
								$flatMembrane = $wpdb->get_results("select type_roof_flat_id, type_roof_flat_name from type_roof_flat");
								foreach($flatMembrane as $flat){
									echo '<option value="'.$flat->type_roof_flat_id.'">'.$flat->type_roof_flat_name.'</option>';
								}
								echo '</select>
                            <input type="radio" name="type-of-roof" value="sloped" checked><text class="content">Sloped </text>
                        <select name="sloped-select" id="slopedselect" disabled>
                            <option value="" disabled>Select</option>';
								$slopedSelect = $wpdb->get_results("select type_roof_sloped_id, type_roof_sloped_name from type_roof_sloped");
								foreach($slopedSelect as $sloped){
									if($client->type_roof_sloped_id != $sloped->type_roof_sloped_id)
										echo '<option value="'.$sloped->type_roof_sloped_id.'">'.$sloped->type_roof_sloped_name.'</option>';
									else
										echo '<option value="'.$sloped->type_roof_sloped_id.'" selected>'.$sloped->type_roof_sloped_name.'</option>';
								}
								echo '</select>';
							}
							?>

                            <script>
                                $('input[name=type-of-roof]').change(function() {
                                    console.log($('input[name=type-of-roof]:checked').val());
                                    if($('input[name=type-of-roof]:checked').val() == 'flatmembrane') {
                                        $('#slopedselect').attr('disabled','disabled');
                                        $('#slope').attr('disabled','disabled');
                                        $('#flatmembraneselect').removeAttr('disabled');
                                    } else {
                                        $('#flatmembraneselect').attr('disabled','disabled');
                                        $('#slopedselect').removeAttr('disabled');
                                        $('#slope').removeAttr('disabled');
                                    }

                                });

                                function checked() {
                                    if($('input[name=type-of-roof]:checked').val() == 'flatmembrane') {
                                        $('#slopedselect').attr('disabled','disabled');
                                        $('#flatmembraneselect').removeAttr('disabled');
                                        $('#slope').attr('disabled','disabled');
                                    } else {
                                        $('#flatmembraneselect').attr('disabled','disabled');
                                        $('#slopedselect').removeAttr('disabled');
                                        $('#slope').removeAttr('disabled');
                                    }
                                    if($('input[name=clear-access]:checked').val() == 'no') {
                                        $('#clearaccessposition').attr('disabled','disabled');
                                    } else {
                                        $('#clearaccessposition').removeAttr('disabled');
                                    }
                                }
                                $( document ).ready(function() {
                                    checked();
                                });
                            </script><input type="text" name="slope" id="slope" placeholder="Slope" value="<?php echo $client->client_sloped; ?>"> &nbsp;in 12
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-12">
                            <input type="text" name="size-of-roof" id="size-of-roof" placeholder="Size of roof" value="<?php echo $client->client_size_of_roof; ?>"> ft&sup2;
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <input type="text" name="manufacturer" id="manufacturer" placeholder="Manufacturer and brand" value="<?php echo $client->client_manufacturer_and_brand; ?>">
                        </div>
                        <div class="col-sm-6">
                            Year installed:&nbsp;<input type="text" name="year-installed" style="width:50px" id="year-installed" value="<?php echo $client->client_year_installed; ?>">
                            &nbsp;Year manufactured&nbsp;<input type="text" name="year-manufactured" id="year-manufactured" style="width:50px" value="<?php echo $client->client_year_manufactured; ?>"><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $client->client_title; ?>">
                        </div>
                        <div class="col-sm-6">
                            Date of inspection:&nbsp; <input type="text" value="<?php echo date('H:i:s Y-m-d', strtotime($client->client_date)); ?>" name="date" class="hidden datetimepicker"/><br>
                        </div>
                    </div>
                    <div class="signature-canvas" style="margin-left:10px">
                        Inspected by: <?php echo $user_name ?><br>
                        Signature: <br>
                        <img src="<?php echo $client->client_signature; ?>" /><br>
                        <div class="canvas-area">
                            Add new signature: <br>
                            <canvas id="signature"style="border: 1px solid black; display: block" width="400" height="250"></canvas>
                        </div>
                        <div class="canvas-actions">
                            <button id="clear-canvas">Redo</button>
                            <!-- <button id="test">Accept</button> -->
                        </div>
                    </div>
                    <input type="hidden" id="signature-input" name="signature-input">

                    <!-- checar el titulo -->
                    <div id="inspection-checklist">
                        <div class="title-section">Semiannual Roof Maintenance Inspection Checklist</div>
                        <div class="row no-margin">
                            <div class="col-sm-6">
                                <input type="text" name="facility" id="facility" placeholder="Facility" value="<?php echo $inspection->roof_inspection_facility; ?>">
                            </div>
                            <div class="col-sm-6">
                                &nbsp;Programmed date:&nbsp; <input type="text" value="<?php echo date('H:i:s Y-m-d', strtotime($inspection->roof_inspection_datetime)); ?>"  name="date-maintenance"  class="hidden datetimepicker"/><br>
                            </div>
                        </div>
                        <div class="row no-margin">
                            <div class="col-sm-6">
                                <input type="text" name="location" id="location" placeholder="Location" value="<?php echo $inspection->roof_inspection_location; ?>">
                            </div>
                        </div>
                    </div>

                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/roofinspectionbar.png" alt="barra division" class="division-bar">

                    <div id="materials-checklist">
                        <div class="title-section">INSPECTION MATERIALS CHECKLIST</div>
                        <ul class="checkbox-grid">
							<?php
							$rid = $inspection->roof_inspection_id;
							$count = $wpdb->get_var("SELECT COUNT(*) FROM roof_materials WHERE roof_inspection_id= '$rid'");
							$material = $wpdb->get_results("select inspection_material_id from roof_materials where roof_inspection_id = '$rid'");
							$material_name = $wpdb->get_results("select inspection_material_name from inspection_materials");
							for($i=1;$i<=19;$i++){
								$found = false;


								for($n=0;$n<$count;$n++){
									if($material[$n]->inspection_material_id == $i)
										$found = true;
								}

								if($found==true)
									echo '<li><input type="checkbox" name="materials[]" value="',$i,'" checked /><text class="content">',$material_name[($i-1)]->inspection_material_name,' </text></li>';
								else
									echo '<li><input type="checkbox" name="materials[]" value="',$i,'" /><text class="content">',$material_name[($i-1)]->inspection_material_name,' </text></li>';


							}

							?>
                        </ul>
                    </div>
                    <br>

                    <div id="inspection-checklist-section">
                        <div class="title-section">INSPECTION CHECKLIST</div><br>
                        <table style="width:100%" id="checklist-table">
                            <colgroup>
                                <col style="width: 30%">
                                <col style="width: 4%">
                                <col style="width: 4%">
                                <col style="width: 4%">
                                <col style="width: 30%">
                                <col style="width: 30%">
                            </colgroup>
							<?php
							$checklist = $wpdb->get_results("SELECT * FROM roof_checklists WHERE roof_inspection_id='$rid'");
							$count = $wpdb->get_var("SELECT COUNT(*) FROM roof_checklists WHERE roof_inspection_id= '$rid'");

							$result = array_fill(1, 90, false);

							for($i=0;$i<$count;$i++){
								for($n=1;$n<=90;$n++){
									if($checklist[$i]->inspection_checklist_id == $n)
										$result[$n] = true;
								}
							}

							?>

							<?php
							$counter = 1;

							for($cat=1;$cat<=15;$cat++){
								$count_per_cat = $wpdb->get_var("SELECT COUNT(*) FROM inspection_checklists WHERE inspection_checklist_category_id= '$cat'");

								$category_name = $wpdb->get_results("SELECT inspection_checklist_category_name FROM inspection_checklist_categories");

								$type_name = $wpdb->get_results("SELECT inspection_checklist_name FROM inspection_checklists WHERE inspection_checklist_category_id='$cat'");
								if($cat == 1){
									echo '<tr>
                                    <th>',$category_name[($cat-1)]->inspection_checklist_category_name,'</th>
                                    <th>OK</th>
                                    <th>Minor problem</th>
                                    <th>Major problem</th>
                                    <th>Observation</th>
                                    <th>Date of repair</th>
                                    </tr>';
								}else{
									echo '<tr><th>',$category_name[($cat-1)]->inspection_checklist_category_name,'</th></tr>';
								}

								for($type=0;$type<$count_per_cat;$type++){
									echo'<tr>
                                <td>',$type_name[$type]->inspection_checklist_name,'</td>';

									if($result[$counter] == false){
										echo '<td><input type="radio" name="status-',$counter,'" value="0" checked></td>
                                <td><input type="radio" name="status-',$counter,'" value="1"></td>
                                <td><input type="radio" name="status-',$counter,'" value="2"></td>
                                <td><input type="text" name="observation-',$counter,'" id="observation',$counter,'" style="width: 100%;" disabled></td>
                                <td><input type="date" name="daterepair-',$counter,'" id="daterepair',$counter,'" style="width: 100%;" disabled></td></tr>';
									}else{
										$r = $wpdb->get_results("SELECT * FROM roof_checklists WHERE inspection_checklist_id= '$counter' AND roof_inspection_id = '$rid'");
										echo '<td><input type="radio" name="status-',$counter,'" value="0"></td>';
										if($r[0]->roof_checklist_problem == $counter){
											echo '<td><input type="radio" name="status-',$counter,'" value="1" checked></td>
                                        <td><input type="radio" name="status-',$counter,'" value="2"></td>';
										} else{
											echo '<td><input type="radio" name="status-',$counter,'" value="1"></td>
                                        <td><input type="radio" name="status-',$counter,'" value="2" checked></td>';
										}
										echo'<td><input type="text" name="observation-',$counter,'" id="observation',$counter,'" value="',$r[0]->roof_checklist_observation,'"></td>
                                <td><input type="date" name="daterepair-',$counter,'" id="daterepair',$counter,'" value="',$r[0]->roof_checklist_date_of_repair,'"></td></tr>';
									}
									$counter++;

								}
							}

							?>
                        </table>
                        <script>
                            $('#checklist-table input[type=radio]').change(function() {
                                if( $(this).val() == 0 ) {
                                    $(this).parent().parent().find('input[type=text]').prop('disabled', true);
                                    $(this).parent().parent().find('input[type=date]').prop('disabled', true);
                                } else {
                                    $(this).parent().parent().find('input[type=text]').prop('disabled', false);
                                    $(this).parent().parent().find('input[type=date]').prop('disabled', false);
                                }
                            });
                        </script>
                    </div>
                    <div class="blueparagraph">
                        Comment on changes from previous inspections, and overall roof condition. Indicate recommended action of roof repair and/or further assessment, and estimated remaining life  expectancy of roof system. Include any photographs and thermography records in this report
                    </div>
                    <textarea class="textarea-comment" name="comment"><?php echo $inspection->roof_inspection_comment ?></textarea>
                    <div class="blueparagraph">
                        Core sample
                    </div>
                    <textarea class="textarea-coresample" name="core-sample"><?php echo $inspection->roof_inspection_core_sample ?></textarea>
                    <div class="blueparagraph smallfont">
                        <p class ="title-centered">ROOF PLAN AND DETAILS</p>
                        <p><text class="title-centered">- USE THIS AREA ONLY IF DEFICIENCIES ARE OBSERVED -</text><br>Sketch roof plan. Include north arrow, the location of the items listed below, approximate dimensions of building, roofing materials, and other relevant items located on the roof. Show changes in roof elevations in a separate sketch.</p>
                    </div>
                    <div class="drawingarea">
						<?php
						if($inspection->roof_inspection_plan != NULL)
							echo '<img src=',$inspection->roof_inspection_plan,' style="display:block;margin: 0 auto;" /><br>';
						else
							echo '<p style="text-align:center;font-style:italic">NO SKETCH YET</text></p>'
						?>

                        Add new plan: <br>
                        <canvas id="sketch" width="900" height="400" style="border: 1px solid black;display:block;margin: 0 auto;"></canvas>
                        <div class="canvas-actions">
                            <button id="clear-sketch" style="margin-top:15px;margin-bottom:15px">Redo</button><br>
                            <input type="checkbox" name="null-sketch" id="null-sketch" value="1"/> No sketch plan <br>
                            <!-- <button id="test">Accept</button> -->
                        </div>
                        <input type="hidden" id="sketch-input" name="sketch-input">
                    </div>
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth"><br>
                    <table style="width:100%" class="glossary">
                        <tr class="glossary">
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">A -</text> Access Hatch</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">D -</text> Roof Drain</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">G -</text> Gutter System</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">K -</text> Chimney</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">R -</text> Roof Vent</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">U -</text> HVAC Unit</td>
                        </tr>
                        <tr class="glossary">
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">B -</text> Base Flashing</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">E -</text> Expansion Joint Cover</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">H -</text> Vent / Fan Hood</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">L -</text> Ladder</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">S -</text> Skylight</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">V -</text> Vent Pipe</td>
                        </tr>
                        <tr class="glossary">
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">C -</text> Cap Flashing</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">F -</text> Fascia and Gravel Stop</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">J -</text> Flag Pole</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">P -</text> Parapet or Fire Wall</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">T -</text> Walkway</td>
                            <td class="glossary" style="font-size:13px"><text style="font-weight:600">W -</text> Ponded Water</td>
                        </tr>
                    </table>
                    <div class="title-section" style="width:500px; margin-top:25px">GLOSSARY OF ROOFING TERMS USED IN THIS CHECKLIST</div>
                    <table style="width:100%" class="glossary">
                        <tr class="glossary">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Alligatoring</text><br>
                                    <text style="margin-left:10px;font-size:17px">Shrinkage cracking of the bituminous surface of built-up or smooth surface roofing, producing a pattern of deep cracks resembling an alligator hide.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Fishmouth</text><br>
                                    <text style="margin-left:10px;font-size:17px">An opening of the lapped edge of applied felt in build-up roofing due to adhesion failure.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Asphalt</text><br>
                                    <text style="margin-left:10px;font-size:17px">A highly viscoushydrocarbon produced from the residium left after the distillation of petroleum; used as a waterproofing agent if a build-up roof.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Flashing</text><br>
                                    <text style="margin-left:10px;font-size:17px">Connecting deviced that seal membrane joints, drains, gravel stops, and other places where membrane is interrupted. Base flashing forms the upturned edges of the wateright membrane. Cap or counter flashing shields the exposed edges and joints of the base flashing.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Ballast</text><br>
                                    <text style="margin-left:10px;font-size:17px">An anchoring material (such as rock, gravel, pavers) used to resist wind and uplift forces of roof membrane.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Gravel Stop</text><br>
                                    <text style="margin-left:10px;font-size:17px">Flanged device, normally metallic, designed to prevent loose aggregate from washing off roof. It also provides a finished edge detail for built-up roofing assembly.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Bitumen</text><br>
                                    <text style="margin-left:10px;font-size:17px">A generic term for asphalt or coal tar pitch roofing.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">High Risk Roof</text><br>
                                    <text style="margin-left:10px;font-size:17px">A roof which scores 15 or greater out of 20 using the Snow Overload Risk Assessment checklist.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Blister</text><br>
                                    <text style="margin-left:10px;font-size:17px">A spongyraised portion of roofing membrane as a result of pressure of entrapped air or water vapor.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Modified Bitumen</text><br>
                                    <text style="margin-left:10px;font-size:17px">Asphalt with the addition of polymer modifiers to increase cold temperature flexibility and warm temperature flow resistance and stability.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Built-up Roofing (BUR)</text><br>
                                    <text style="margin-left:10px;font-size:17px">A continuous, semi-flexible roof covering consisting of laminations or plies of saturated or coated felts alternated with layers of bitumen.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">PVC</text><br>
                                    <text style="margin-left:10px;font-size:17px">A generic term for single ply plastic sheet membrane (poly vinyl chloride); seams are fused by solvent or hot-aire welding techniques.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Cant Strip</text><br>
                                    <text style="margin-left:10px;font-size:17px">A continuous strip of triangular cross-section, fitted into the angle formed by a structural deck and a wall or other vertical surface, and used to provide gradual transition for base flashing and horizontal roof membrane.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Parapet Ponding Slope</text><br>
                                    <text style="margin-left:10px;font-size:17px">The part of the wall entirely above the roof.<br>
                                        The collection of water in shallow pools on the roof surface.<br>
                                        The ratio between the measures of the rise and the horizontal span.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Crack</text><br>
                                    <text style="margin-left:10px;font-size:17px">A break in a roofing membrane as a result of flexing, often occurring at a ridge or wrinkle.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Soffit</text><br>
                                    <text style="margin-left:10px;font-size:17px">The finish on the underside of a roof overhang.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">EPDM Expansion</text><br>
                                    <text style="margin-left:10px;font-size:17px">A synthethic rubber sheet used in single ply roof membrane (ethylene propylene diene monomer).</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">TPO</text><br>
                                    <text style="margin-left:10px;font-size:17px">Thermoplastic polyolefins are in the thermoplastic elastometer family and are commonly referred to as TPO in the single-ply roofing industry.</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Joint</text><br>
                                    <text style="margin-left:10px;font-size:17px">A deliberate separation of two roof areas to allows expansion and contraction movements of the parts.</text>
                                </div>
                            </td>
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Fascia</text><br>
                                    <text style="margin-left:10px;font-size:17px">The finish membrane covering the edge or eaves of a flat or sloping roof or roof overhang .</text>
                                </div>
                            </td>
                        </tr>
                        <tr class="glossary table-definitions">
                            <td class="glossary">
                                <div class="definition">
                                    <text style="font-weight:700;font-size:19px">Eaves</text><br>
                                    <text style="margin-left:10px;font-size:17px">The protective overhang at the lower edge of a sloped roof.</text>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="title-section" style="width:500px; margin-top:25px">INSTRUCTIONS FOR ROOF PLAN SKETCH</div>
                    <ol>
                        <li>Draw rough sketch of facility roof plan on preceding page. (Sketch does not need to be drawn to scale.)</li>
                        <li>Note with arrow and letter code (as shown on the sample below) major defects that require repairs beyond the scope of this inspection. See HBK MS-I, Operation and Maintenance  of Real Property (Appendix 13-B, Guide Number P-20), for inspection procedures.</li>
                        <li>Use the key below to identify problem areas by letter code.</li>
                        <li>Forward a copy of this completed form to your Field Maintenance Office.</li>
                    </ol>

                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/reportformviews.png" alt="views" class="views-img"><br>

                    <div class="title-section" style="width:500px; margin-top:25px">BACKGROUND</div>
                    <text style="font-weight:700;font-size:19px;margin-top:15px">ALL SUBSTRATES</text><br>
                    <ul style="list-style-type:disc">
                        <li>Check in with the customer</li>
                        <li>Inspect the leak(s) entry location inside of the building</li>
                        <li>Measure the distance the leak(s) is from exterior walls (if necessary)</li>
                        <li>Locate the leak(s) area on the roof</li>
                    </ul>
                    <text style="font-weight:700;font-size:19px;margin-top:15px">BUR with Gravel (LEAK AREA)</text><br>
                    <ul style="list-style-type:disc">
                        <li>Take before and after pictures</li>
                        <li>Sweep the gravel from the leak area(s)</li>
                        <li>Inspect the roof for defects: blisters, ridging, cracks, punctures, open laps, fish mouths</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect the penetrations, drains, and scuppers in the area for deficiencies: cracks, voids, failes material</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect ducts, vents, and pipe caps for possible entry points</li>
                        <li>Repair suspect areas with high quality urethane caulk or 100% silicon - when appropiate</li>
                    </ul>
                    <text style="font-weight:700;font-size:19px;margin-top:15px">CAP SHEET (LEAK AREA)</text><br>
                    <ul style="list-style-type:disc">
                        <li>Take before and after pictures</li>
                        <li>Inspect the roof for defects: bllisters, riging, cracks, punctures, open laps, fish mouths</li>
                        <li>Probe the seams for cold welds</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect the penetrations in the area for deficiencies: cracks, voids, failed material</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect ducts, vents, and pipe caps for possible entry points</li>
                        <li>Repair suspect areas with high quality urethane caulk or 100% silicon - when appropriate</li>
                    </ul>
                    <text style="font-weight:700;font-size:19px;margin-top:15px">EPDM (LEAK AREA)</text><br>
                    <ul style="list-style-type:disc">
                        <li>Take before and after pictures</li>
                        <li>Inspect the roof for defects: tears, punctures, open laps</li>
                        <li>Carefully probe the seams for cold welds</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect the penetrations in the area for deficiencies: cracks, voids, failed materials</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect ducts, vents, and pipe caps for possible entry points</li>
                        <li>Repair suspect areas with high quality urethane caulk or 100% silicon - when appropriate</li>
                    </ul>
                    <text style="font-weight:700;font-size:19px;margin-top:15px">TPO (LEAK AREA)</text><br>
                    <ul style="list-style-type:disc">
                        <li>Take before and after pictures</li>
                        <li>Inspect the roof for defects: cracks, fractures, punctures, cold welds, fish mouths</li>
                        <li>Probe the seams for cold welds</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect the penetrations in the area for deficiencies: cracks, voids, cold welds, failed material</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect ducts, vents, and pipe caps for possible entry points</li>
                        <li>Repair suspect areas with high quality urethane caulk or 100% silicon - when appropriate</li>
                    </ul>
                    <text style="font-weight:700;font-size:19px;margin-top:15px">METAL (LEAK AREA)</text><br>
                    <ul style="list-style-type:disc">
                        <li>Take before and after pictures</li>
                        <li>Inspect the roof for defects: punctures, deep rust, fastener back out, fastener failed gaskets</li>
                        <li>Inspect the seams for proper sealant or soft butyl tape</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect the penetrations in the area for deficiencies: cracks, voids, cold welds, failed material, missing boots</li>
                        <li>Repair per NRCA</li>
                        <li>Inspect ducts, vents, and pipe caps for possible entry points</li>
                        <li>Repair suspect areas with high quality urethane caulk or 100% silicon - when appropriate</li>
                    </ul>
                    <input type="hidden" name="edit-inspectionlist" id="inspectionlist-button">
                    <input type="submit" value="Submit Checklist" style="display:block;margin:0 auto">

                </form>
            </div>
        </div>
    </div>
    </body>
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>/css/jquery.periodpicker.min.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>/css/jquery.timepicker.min.css">
    <script src="<?php echo bloginfo('template_url').'/'; ?>/js/jquery.periodpicker.full.min.js"></script>
    <script>
        $('.datetimepicker').periodpicker({
            lang: 'en', // use english language
            norange: true, // use only one value
            cells: [1, 1], // show only one month

            resizeButton: false, // deny resize picker
            fullsizeButton: false,
            fullsizeOnDblClick: false,
            yearsLine: false,

            timepicker: true, // use timepicker
            timepickerOptions: {
                hours: true,
                minutes: true,
                seconds: false,
                ampm: true
            }
        });

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        //  INITIALIZE SIGNATURE PAD
        var signaturePad = '';

        $(document).ready(function() {
            var canvas1 = document.querySelector("#signature");
            var canvas2 = document.querySelector("#sketch");

            signaturePad = new SignaturePad(canvas1);
            sketchPad = new SignaturePad(canvas2);


            //  ACTIONS FOR CANVAS

            // Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible paramters)
            //signaturePad.toDataURL(); // save image as PNG
            //signaturePad.toDataURL("image/jpeg"); // save image as JPEG

            /*// Returns true if canvas is empty, otherwise returns false
             signaturePad.isEmpty();

             // Unbinds all event handlers
             signaturePad.off();

             // Rebinds all event handlers
             signaturePad.on();*/
        });

        //  CLEAR SIGNATURE CANVAS
        $('#clear-canvas').click(function(d) {
            // Clears the canvas
            d.preventDefault();
            $('#signature').val('');
            signaturePad.clear();
        });

        $('#clear-sketch').click(function(f) {
            // Clears the canvas
            f.preventDefault();
            $('#sketch').val('');
            sketchPad.clear();
        });

        //  SET SIGNATURE VALUE TO INPUT
        $('#editinspection-form').submit(function(e) {
            e.preventDefault();
            if(signaturePad.isEmpty()){
            }else{
                var $saveSignature = signaturePad.toDataURL(); // save image as PNG
                $('#signature-input').val($saveSignature);
            }
            if(sketchPad.isEmpty()){
            }else{
                var $saveSketch = sketchPad.toDataURL(); // save image as PNG
                $('#sketch-input').val($saveSketch);
            }
            var errors ="";
            var projectOwner = $("#project-owner").val();
            var projectAddress = $("#project-address").val();
            var heightAtEave = $("#height-at-eave").val();
            var heightAtRidge = $("#height-at-ridge").val();
            var SizeOfRoof = $("#size-of-roof").val();
            var manufacturer = $("#manufacturer").val();
            var yearInstalled = $("#year-installed").val();
            var yearManufactured = $("#year-manufactured").val();
            var facility = $("#facility").val();
            var location = $("#location").val();
            var title = $("#title").val();

            if( projectOwner == null || projectOwner.length == 0) {
                errors += "The Project Owner is required<br>";
            } else if(projectOwner.length > 50){
                errors += "The maximum number of letters for the Project Owner is 50<br>";
            }
            if( projectAddress == null || projectAddress.length == 0) {
                errors += "The Project Address is required<br>";
            } else if(projectOwner.length > 80){
                errors += "The maximum number of letters for the Project Address is 80<br>";
            }
            if( heightAtRidge == null || heightAtRidge.length == 0) {
                errors += "The Height at ridge is required<br>";
            } else if(!/^(0|[1-9]\d*)?(\.\d+)?(?<=\d)$/.test(heightAtRidge)){
                errors += "Enter a valid number for Height at ridge installed to date (e.g. 5.10)<br>";
            }
            if( heightAtEave == null || heightAtEave.length == 0) {
                errors += "The Height at eave is required<br>";
            } else if(!/^(0|[1-9]\d*)?(\.\d+)?(?<=\d)$/.test(heightAtEave)){
                errors += "Enter a valid number for Height at eave installed to date (e.g. 5.10)<br>";
            }
            if($("#clearAccessYes").is(":checked") && $("#clearaccessposition").val() == null){
                errors += "You must select a Clear access position<br>";
            }
            if($("#flatmembrane").is(":checked") && $("#clearaccessposition").val() == null){
                errors += "You must select a Flat/Membrane type<br>";
            }
            if($("#sloped").is(":checked") && $("#slopedselect").val() == null){
                errors += "You must select a Type of roof<br>";
            }
            if($("#sloped").is(":checked") && ($("#slope").val() == null || $("#slope").val() == 0)){
                errors += "You must set a Slope<br>";
            }
            if( SizeOfRoof == null || SizeOfRoof.length == 0) {
                errors += "The Size of roof is required<br>";
            } else if(!/^(0|[1-9]\d*)?(\.\d+)?(?<=\d)$/.test(SizeOfRoof)){
                errors += "Enter a valid number for Size of roof installed to date (e.g. 5.10)<br>";
            }
            if( manufacturer == null || manufacturer.length == 0) {
                errors += "The Manufacturer and brand are required<br>";
            } else if(manufacturer.length > 80){
                errors += "The maximum number of letters for the Manufacturer and brand is 80<br>";
            }
            if( yearInstalled == null || yearInstalled.length == 0) {
                errors += "The year installed is required<br>";
            } else if(!/^\d{4}$/.test(yearInstalled)){
                errors += "You must enter a valid year (e.g. 2017)<br>";
            }
            if( yearManufactured == null || yearManufactured.length == 0) {
                errors += "The Year of manufacture is required<br>";
            } else if(!/^\d{4}$/.test(yearInstalled)){
                errors += "You must enter a valid year (e.g. 2017)<br>";
            }
            if( title == null || title.length == 0) {
                errors += "The title is required<br>";
            } else if(title.length > 80){
                errors += "The maximum number of letters for the title is 80<br>";
            }
            if( facility == null || facility.length == 0) {
                errors += "The facility is required<br>";
            } else if(facility.length > 80){
                errors += "The maximum number of letters for the facility is 80<br>";
            }
            if( location == null || location.length == 0) {
                errors += "The location is required<br>";
            } else if(location.length > 80){
                errors += "The maximum number of letters for the location is 80<br>";
            }
            //redireccion
            if(errors=="") {
                $('#editinspection-form')[0].submit();
            } else {
                //colorear los campos mal ingresados
                $("#error").removeClass('hidden').addClass('active').html("Whoops <br>"+errors);
                $('html,body').animate({ scrollTop: 0 }, 'slow');
                return false;
            }

        });
    </script>
<?php include('footer-projects.php'); ?>