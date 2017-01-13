<?php $page = 'inspectionform'; ?>
<?php include('header-projects.php'); ?>
<div id="reportform">
    <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
    <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
    <text class="title">ROOF INSPECTION LIST</text><br>

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
            <text class="content" style="color: #004989;text-align:center;display: inherit">To set up roof inspections or existing conditions inspections contact    IOCHOA@CIMROOFING.COM</text>

            <form method="POST" action="<?php echo home_url().'/'; ?>controller" id="inspection-form">
                <div id="client">
                    <div class="row no-margin">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="project-owner" id="project-owner" placeholder="Project Owner"><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-8 col-sm-12">
                            <input type="text" name="project-address" id="project-address" placeholder="Project Address"><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-4 col-sm-6">
                            <input type="text" name="height-at-eave" id="height-at-eave" placeholder="Height at eave">
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <input type="text" name="height-at-ridge" id="height-at-ridge" placeholder="Height at ridge"><br>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-12">
                            <text class="content">Clear access  </text>
                            <input type="radio" name="clear-access" value="no" checked><text class="content">No </text>
                            <input type="radio" name="clear-access" value="yes"><text class="content">Yes </text>
                            <select name="clearaccessposition" id="clearaccessposition" disabled>
                                <option value="" disabled selected>Select</option>
		                        <?php
		                        $clearSelect = $wpdb->get_results("select clear_access_id, clear_access_name from clear_access");
		                        foreach($clearSelect as $clear){
			                        echo '<option value="'.$clear->clear_access_id.'">'.$clear->clear_access_name.'</option>';
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
                            <text class="content">Type of roof  </text>
                            <input type="radio" name="type-of-roof" value="flatmembrane" checked><text class="content">Flat/Membrane </text>
                            <select name="flatmembrane-select" id="flatmembraneselect" disabled>
                                <option value="" disabled selected>Select</option>
		                        <?php
		                        $flatMembrane = $wpdb->get_results("select type_roof_flat_id, type_roof_flat_name from type_roof_flat");
		                        foreach($flatMembrane as $flat){
			                        echo '<option value="'.$flat->type_roof_flat_id.'">'.$flat->type_roof_flat_name.'</option>';
		                        }
		                        ?>
                            </select>
                            <input type="radio" name="type-of-roof" value="sloped"><text class="content">Sloped </text>
                            <select name="sloped-select" id="slopedselect" disabled>
                                <option value="" disabled selected>Select</option>
		                        <?php
		                        $slopedSelect = $wpdb->get_results("select type_roof_sloped_id, type_roof_sloped_name from type_roof_sloped");
		                        foreach($slopedSelect as $sloped){
			                        echo '<option value="'.$sloped->type_roof_sloped_id.'">'.$sloped->type_roof_sloped_name.'</option>';
		                        }
		                        ?>
                            </select>
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
                            </script>
                            <input type="text" name="slope" id="slope" placeholder="Slope"> &nbsp;in 12
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-12">
                            <input type="text" name="size-of-roof" id="size-of-roof" placeholder="Size of roof"> ft&sup2;
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <input type="text" name="manufacturer" id="manufacturer" placeholder="Manufacturer and brand">
                        </div>
                        <div class="col-sm-6">
                            Year installed:&nbsp;<input type="text" name="year-installed" style="width:50px" id="year-installed" value="<?php echo date('Y'); ?>">
                            &nbsp;Year manufactured:&nbsp;<input type="text" name="year-manufactured" id="year-manufactured" style="width:50px" value="<?php echo date('Y'); ?>">
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <input type="text" name="title" id="title" placeholder="Title">
                        </div>
                        <div class="col-sm-6">
                            Date of inspection:&nbsp; <input type="text" value="<?php echo date('H:i:s Y-m-d'); ?>" name="date" class="hidden datetimepicker"/>
                        </div>
                    </div>
                    <div class="signature-canvas" style="margin-left:10px">
                        Inspected by: NAME OF EMPLOYEE HERE<br>
                        Signature: <br>
                        <div class="canvas-area">
                            <canvas id="signature"style="border: 1px solid black; display: block;" width="400" height="250"></canvas>
                        </div>
                        <div class="canvas-actions">
                            <button id="clear-canvas">Redo</button>
                            <!-- <button id="test">Accept</button> -->
                        </div>
                    </div>

                    <input type="hidden" id="signature-input" name="signature-input">
                </div>

                <!-- checar el titulo -->
                <div id="inspection-checklist">
                    <div class="title-section">Semiannual Roof Maintenance Inspection Checklist</div>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <input type="text" name="facility" id="facility" placeholder="Facility">
                        </div>
                        <div class="col-sm-6">
                            &nbsp;Programmed date:&nbsp; <input type="text" value="<?php echo date('H:i:s Y-m-d'); ?>" name="date-maintenance"  class="hidden datetimepicker"/>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-sm-6">
                            <input type="text" name="location" id="location" placeholder="Location">
                        </div>
                    </div>
                </div>

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/roofinspectionbar.png" alt="barra division" class="division-bar">

                <div id="materials-checklist">
                    <div class="title-section">INSPECTION MATERIALS CHECKLIST</div>
                    <ul class="checkbox-grid">
                        <li><input type="checkbox" name="materials[]" value="1" /><text class="content">Clipboard </text></li>
                        <li><input type="checkbox" name="materials[]" value="2" /><text class="content">Whisk broom </text></li>
                        <li><input type="checkbox" name="materials[]" value="3" /><text class="content">Screw driver </text></li>
                        <li><input type="checkbox" name="materials[]" value="4" /><text class="content">Stiff wire brush </text></li>
                        <li><input type="checkbox" name="materials[]" value="5" /><text class="content">Scissors </text></li>
                        <li><input type="checkbox" name="materials[]" value="6" /><text class="content">Camera and film </text></li>
                        <li><input type="checkbox" name="materials[]" value="7" /><text class="content">Flashlight </text></li>
                        <li><input type="checkbox" name="materials[]" value="8" /><text class="content">Tool bag </text></li>
                        <li><input type="checkbox" name="materials[]" value="9" /><text class="content">Claw hammer </text></li>
                        <li><input type="checkbox" name="materials[]" value="10" /><text class="content">Work gloves </text></li>
                        <li><input type="checkbox" name="materials[]" value="11" /><text class="content">Spray paint (bright) </text></li>
                        <li><input type="checkbox" name="materials[]" value="12" /><text class="content">Roof Mastic </text></li>
                        <li><input type="checkbox" name="materials[]" value="13" /><text class="content">Primer and brush </text></li>
                        <li><input type="checkbox" name="materials[]" value="14" /><text class="content">Measuring tape </text></li>
                        <li><input type="checkbox" name="materials[]" value="15" /><text class="content">Reinforcement tape </text></li>
                        <li><input type="checkbox" name="materials[]" value="16" /><text class="content">Sharp Knife </text></li>
                        <li><input type="checkbox" name="materials[]" value="17" /><text class="content">Pointed Trowel </text></li>
                        <li><input type="checkbox" name="materials[]" value="18" /><text class="content">Plastic for elasto/plastic room </text></li>
                        <li><input type="checkbox" name="materials[]" value="19" /><text class="content">Rope with safety clip </text></li>
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
                                <td>',$type_name[$type]->inspection_checklist_name,'</td>
                                <td><input type="radio" name="status-',$counter,'" value="0" checked></td>
                                <td><input type="radio" name="status-',$counter,'" value="1"></td>
                                <td><input type="radio" name="status-',$counter,'" value="2"></td>
                                <td><input type="text" name="observation-',$counter,'" id="observation',$counter,'" style="width: 100%;" disabled></td>
                                <td><input type="date" name="daterepair-',$counter,'" id="daterepair',$counter,'" style="width: 100%;" disabled></td></tr>';

								$counter++;

							}
						}

						?>
                    </table>
                    <script>
                        $('#checklist-table input[type=radio').change(function() {
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
                <textarea class="textarea-comment" name="comment"></textarea>
                <div class="blueparagraph">
                    Core sample
                </div>
                <textarea class="textarea-coresample" name="core-sample"></textarea>
                <div class="blueparagraph smallfont">
                    <p class ="title-centered">ROOF PLAN AND DETAILS</p>
                    <p><text class="title-centered">- USE THIS AREA ONLY IF DEFICIENCIES ARE OBSERVED -</text><br>Sketch roof plan. Include north arrow, the location of the items listed below, approximate dimensions of building, roofing materials, and other relevant items located on the roof. Show changes in roof elevations in a separate sketch.</p>
                </div>
                <div class="drawingarea">
                    <canvas id="sketch" width="680" height="400" style="border: 1px solid black;display:block;margin: 0 auto;"></canvas>
                    <div class="canvas-actions">
                        <button id="clear-sketch" style="margin-left:35px;margin-top:15px">Redo</button>
                        <!-- <button id="test">Accept</button> -->
                    </div>
                </div>
                <input type="hidden" id="sketch-input" name="sketch-input">
                <div class="blueparagraph smallfont">
                    <p class ="title-centered">IMAGES OF INSPECTION</p>
                </div>
                <div class="image-upload">

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
                <input type="hidden" name="submit-inspectionlist" id="inspectionlist-button">
                <input type="submit" value="Submit Checklist" style="display:block;margin:0 auto">
            </form>
        </div>
    </div>
</div>
</body>
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
<script>
    //  INITIALIZE SIGNATURE PAD
    var signaturePad = '';
    var sketchPad = '';

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
    $('#inspection-form').submit(function(e) {
        e.preventDefault();
        var $saveSignature = signaturePad.toDataURL(); // save image as PNG
        $('#signature-input').val($saveSignature);
        var $saveSketch = sketchPad.toDataURL(); // save image as PNG
        $('#sketch-input').val($saveSketch);
        $('#inspection-form')[0].submit();
    });
</script>
<?php include('footer-projects.php'); ?>