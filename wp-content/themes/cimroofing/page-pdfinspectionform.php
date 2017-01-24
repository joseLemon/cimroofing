<?php $page = 'editinspectionform'; ?>
<?php include('header-projects.php'); ?>
    <style type="text/css" media="print">
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
    </style>
    <style>
        .body {
            -webkit-print-color-adjust:exact;
        }
        .app-nav {
            display: none;
        }
        .pdf-page,
        .long-pdf-page {
            width: 21cm;
            height: 29.7cm;
            padding: 5px;
        }
        .long-pdf-page {
            height: auto;
        }
        .table-info,
        .table-info td {
            border: 0;
        }
    </style>
    <script type="text/javascript">

        window.onload = function() {
            setTimeout("window.print();", 500);
        };

        (function() {
            var beforePrint = function() {
                console.log('Functionality to run before printing.');
            };
            var afterPrint = function() {
                window.history.back();
            };

            if (window.matchMedia) {
                var mediaQueryList = window.matchMedia('print');
                mediaQueryList.addListener(function(mql) {
                    if (mql.matches) {
                        beforePrint();
                    } else {
                        afterPrint();
                    }
                });
            }

            window.onbeforeprint = beforePrint;
            window.onafterprint = afterPrint;
        }());
    </script>
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

        <div class="general-content">

            <div class="pdf-page">
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
                <text class="title">ROOF INSPECTION LIST</text><br>
                <div class="info-section">
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/BACKGROUND.png" alt="divider" style="width: 621px" class=""><br>
                    <p class="content">Roof systems can deteriorate from: normal wear; severe weather conditions (e.g. wind and snow loads); building movement (e.g., settlement, material contraction/expansion); and improper design, construction, and maintenance.</p>
                    <p class="content">Any roof repairs not dealt with after the first signs of failure can result in increased damage to the building envelope and interior finishes, and a loss of occupant productivity if damage causes interruption in client services and program delivery. Failure of structural integrity can endanger occupant safety.</p>
                </div>
                <div class="info-section">
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/PURPOSE.png" alt="divider" style="width: 621px" class=""><br>
                    <p class="content">Regular inspection of building roof systems will lead to early detection of roof problems, protection of capital assets, and maintenance of safe working environments for building occupants.</p>
                </div>
                <div class="info-section">
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/OBJECTIVES.png" alt="divider" style="width: 621px" class=""><br>
                    <ul style="list-style-type:disc">
                        <li class="content">To determine if the roof system is performing according to its intended function.</li>
                        <li class="content">To identify signs of weakness, deterioration, or hazard.</li>
                        <li class="content">To identify needed repairs.</li>
                    </ul>
                </div>
                <div class="info-section">
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/GENERALAPPROACH.png" alt="divider" style="width: 621px" class=""><br>
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
            </div>

            <div class="pdf-page">
                <table style="width: 100%" class="table-info">
                    <colgroup>
                        <col style="width: 50%;">
                        <col style="width: 50%;">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td><strong>Project Owner</strong>: <?php echo $client->client_project_owner; ?></td>
                        <td><strong>Project Address</strong>: <?php echo $client->client_project_address; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Height at Eave</strong>: <?php echo $client->client_height_at_eave; ?></td>
                        <td><strong>Height at ridge</strong>: <?php echo $client->client_height_at_ridge; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <text class="content"><strong>Clear access: </strong>
								<?php
								if($client->clear_access_id == NULL){
									echo ' No ';
								}else{
									echo ' Yes ';
									$clearSelect = $wpdb->get_results("select clear_access_id, clear_access_name from clear_access");
									foreach($clearSelect as $clear){
										if($client->clear_access_id == $clear->clear_access_id)
											echo '<strong>Front </strong> '.$clear->clear_access_name ;
									}
								}
								?>
                            </text>
                        </td>
                        <td>
                            <text class="content"><strong>Type of roof</strong>:
								<?php
								if($client->type_roof_sloped_id == NULL){
									echo ' Flat/Membrane ';
									$flatMembrane = $wpdb->get_results("select type_roof_flat_id, type_roof_flat_name from type_roof_flat");
									foreach($flatMembrane as $flat){
										if($client->type_roof_flat_id == $flat->type_roof_flat_id)
											echo $flat->type_roof_flat_name;
									}
								}else{
									echo ' Sloped ';
									$slopedSelect = $wpdb->get_results("select type_roof_sloped_id, type_roof_sloped_name from type_roof_sloped");
									foreach($slopedSelect as $sloped){
										if($client->type_roof_sloped_id == $sloped->type_roof_sloped_id)
											echo $sloped->type_roof_sloped_name." <strong>Slope </strong> ".$client->client_sloped. " in 12";
									}
								}
								?>
                            </text>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Size of roof: </strong><?php echo $client->client_size_of_roof; ?> ft&sup2;</td>
                        <td><strong> Manufacturer and brand </strong><?php echo $client->client_manufacturer_and_brand; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Year installed: </strong><?php echo $client->client_year_installed; ?></td>
                        <td> <strong>Year manufactured: </strong><?php echo $client->client_year_manufactured; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Title: </strong><?php echo $client->client_title; ?></td>
                        <td><strong>Date of inspection: </strong>&nbsp;<?php echo date('m/d/Y H:i:s', strtotime($client->client_date)); ?><br></td>
                    </tr>
                    <tr>
                        <td>Inspected by: <?php echo $user_name ?></td>
                        <td>
                            Signature: <br>
                            <img src="<?php echo $client->client_signature; ?>" />
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- checar el titulo -->
                <div id="inspection-checklist">
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/Semiannual.png" alt="divider" style="width: 621px" class=""><br>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <div><strong>Facility </strong><?php echo $inspection->roof_inspection_facility; ?></div>
                        </div>
                        <div class="col-sm-6">
                            <strong>Programmed date:&nbsp;</strong><?php echo  date('m/d/Y H:i:s', strtotime($inspection->roof_inspection_datetime)); ?><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <strong>Location </strong><?php echo $inspection->roof_inspection_location; ?>
                        </div>
                    </div>
                </div>

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/roofinspectionbar.png" alt="barra division" class="division-bar">

                <div id="materials-checklist">
                    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/INSPECTIONMATERIALSCHECKLIST.png" alt="divider" style="width: 621px" class=""><br>
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
            </div>

            <div class="long-pdf-page">
                <div id="inspection-checklist-section">
                    <div class="text-left">
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/INSPECTIONCHECKLIST.png" alt="divider" style="width: 621px;" class=""><br>
                    </div>
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
					$pageCounter = 0;

					for($cat=1;$cat<=15;$cat++) {

						if($pageCounter%1 == 0 || $pageCounter == 0) {
						    if($pageCounter == 0) {
							    echo '<table style="width:100%; margin-bottom: 50px;" id="checklist-table">
                                        <colgroup>
                                            <col style="width: 30%">
                                            <col style="width: 4%">
                                            <col style="width: 4%">
                                            <col style="width: 4%">
                                            <col style="width: 30%">
                                            <col style="width: 30%">
                                        </colgroup>';
                            } else if($pageCounter == 14) {
							    echo '<table style="width:100%; margin-top: 100px;" id="checklist-table">
                                        <colgroup>
                                            <col style="width: 30%">
                                            <col style="width: 4%">
                                            <col style="width: 4%">
                                            <col style="width: 4%">
                                            <col style="width: 30%">
                                            <col style="width: 30%">
                                        </colgroup>';
                            } else {
							    echo '<table style="width:100%; margin: 50px 0;" id="checklist-table">
                                        <colgroup>
                                            <col style="width: 30%">
                                            <col style="width: 4%">
                                            <col style="width: 4%">
                                            <col style="width: 4%">
                                            <col style="width: 30%">
                                            <col style="width: 30%">
                                        </colgroup>';
						    }
						}

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
						} else {
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
                                <td><input type="text" name="daterepair-',$counter,'" id="daterepair',$counter,'" style="width: 100%;" disabled></td></tr>';
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
						$pageCounter++;

						if($pageCounter%1 == 0 || $pageCounter == 15) {
							echo '</table>';
						}
					}

					?>
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
                <br><br><br><br><br><br><br><br><br><br><br>
            </div>

            <div class="long-pdf-page">
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


                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/GLOSSARY.png" alt="divider" style="width: 621px" class=""><br>
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
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/INSTRUCTIONSSKETCH.png" alt="divider" style="width: 621px" class=""><br>
                <ol>
                    <li>Draw rough sketch of facility roof plan on preceding page. (Sketch does not need to be drawn to scale.)</li>
                    <li>Note with arrow and letter code (as shown on the sample below) major defects that require repairs beyond the scope of this inspection. See HBK MS-I, Operation and Maintenance  of Real Property (Appendix 13-B, Guide Number P-20), for inspection procedures.</li>
                    <li>Use the key below to identify problem areas by letter code.</li>
                    <li>Forward a copy of this completed form to your Field Maintenance Office.</li>
                </ol>

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/reportformviews.png" alt="views" class="views-img"><br>

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/BACKGROUND.png" alt="divider" style="width: 621px" class=""><br>
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
            </div>
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
            $('#editinspection-form')[0].submit();
        });
    </script>
<?php include('footer-projects.php'); ?>