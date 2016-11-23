<?php $page = 'reportform'; ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Report Form</title>
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/formstyles.css">
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </head>
    <body style="margin:0">


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
                    <text class="content" style="color: #004989;text-align:center;display: inherit">To set up roof inspections or existing conditions inspections contact    IOCHOA@CIMROOFING.COM</text><br>


                    <form method="POST" action="controller.php">
                        <div id="client">
                            <input type="text" name="project-owner" id="project-owner" placeholder="Project Owner"><br>
                            <input type="text" name="project-address" id="project-address" placeholder="Project Address"><br>
                            <input type="text" name="height-at-eave" id="height-at-eave" placeholder="Height at eave">
                            <input type="text" name="height-at-ridge" id="height-at-ridge" placeholder="Height at ridge"><br>
                            <text class="content">Clear access  </text>
                            <input type="radio" name="clear-access" value="no"><text class="content">No </text>
                            <input type="radio" name="clear-access" value="yes"><text class="content">Yes </text>
                            <select name="clearaccessposition" id="clearaccessposition">
                                <option value="" disabled selected>Select</option>
                                <option value="front">Front</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                                <option value="rear">Rear</option>
                            </select><br>
                            <text class="content">Type of roof  </text>
                            <input type="radio" name="type-of-roof" value="flatmembrane"><text class="content">Flat/Membrane </text>
                            <select name="flatmembraneselect" id="flatmembraneselect">
                                <option value="" disabled selected>Select</option>
                                <option value="tpo">TPO</option>
                                <option value="pvc">PVC</option>
                                <option value="epdm">EPDM</option>
                                <option value="app">APP</option>
                                <option value="sbs">SBS</option>
                                <option value="bur">BUR</option>
                                <option value="metaldeck">Metal Deck</option>
                                <option value="standingseam">Standing Seam</option>
                            </select>
                            <input type="radio" name="type-of-roof" value="sloped"><text class="content">Sloped </text>
                            <select name="slopedselect" id="slopedselect">
                                <option value="" disabled selected>Select</option>
                                <option value="asphaltshingles">Asphalt Shingles</option>
                                <option value="metalshingle">Metal Shingle</option>
                                <option value="metalpanel">Metal Panel</option>
                                <option value="metalpanelseams">Metal Panel Seams</option>
                                <option value="bermudastyle">Bermuda Style</option>
                                <option value="oilcaning">Oil Caning</option>
                                <option value="woodshingles">Wood Shingles</option>
                                <option value="claytile">Clay Tile</option>
                            </select>
                            <input type="text" name="slope" id="slope" placeholder="Slope"> &nbsp;in 12<br>
                            <input type="text" name="size-of-roof" id="size-of-roof" placeholder="Size of roof"><br>
                            <input type="text" name="manufacturer" id="manufacturer" placeholder="Manufacturer and brand">
                            <input type="text" name="year-installed" id="year-installed" placeholder="Year installed">
                            <input type="text" name="year-manufactured" id="year-manufactured" placeholder="Year manufactured"><br>
                            <input type="text" name="inspected-by" id="inspected-by" placeholder="Inspected by">
                            <input type="text" name="title" id="title" placeholder="Title"><br>
                            <input type="text" name="signature" id="signature" placeholder="Signature">
                            <input type="date" name="date" id="date" placeholder="Date">
                        </div>



                        <!-- checar el titulo -->
                        <div id="inspection-checklist">
                            <div class="title-section">Semiannual Roof Maintenance Inspection Checklist</div>
                            <input type="text" name="facility" id="facility" placeholder="Facility">
                            <input type="date" name="date-maintenance" id="date-maintenance" placeholder="Date"><br>
                            <input type="text" name="location" id="location" placeholder="Location">
                            <input type="text" name="inspected" id="inspected" placeholder="Inspected">
                        </div>

                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/roofinspectionbar.png" alt="barra division" class="division-bar">

                        <div id="materials-checklist">
                            <div class="title-section">INSPECTION MATERIALS CHECKLIST</div>
                            <ul class="checkbox-grid">
                                <li><input type="checkbox" name="clipboard" value="clipboard" /><text class="content">Clipboard </text></li>
                                <li><input type="checkbox" name="whisk-broom" value="whisk-broom" /><text class="content">Whisk broom </text></li>
                                <li><input type="checkbox" name="screw-driver" value="screw-driver" /><text class="content">Screw driver </text></li>
                                <li><input type="checkbox" name="wire-brush" value="wire-brush" /><text class="content">Stiff wire brush </text></li>
                                <li><input type="checkbox" name="scissors" value="scissors" /><text class="content">Scissors </text></li>
                                <li><input type="checkbox" name="camera" value="camera" /><text class="content">Camera and film </text></li>
                                <li><input type="checkbox" name="flashlight" value="flashlight" /><text class="content">Flashlight </text></li>
                                <li><input type="checkbox" name="tool-bag" value="tool-bag" /><text class="content">Tool bag </text></li>
                                <li><input type="checkbox" name="claw-hammer" value="claw-hammer" /><text class="content">Claw hammer </text></li>
                                <li><input type="checkbox" name="work-gloves" value="work-gloves" /><text class="content">Work gloves </text></li>
                                <li><input type="checkbox" name="spray-paint" value="spray-paint" /><text class="content">Spray paint (bright) </text></li>
                                <li><input type="checkbox" name="roof-mastic" value="roof-mastic" /><text class="content">Roof Mastic </text></li>
                                <li><input type="checkbox" name="primer" value="primer" /><text class="content">Primer and brush </text></li>
                                <li><input type="checkbox" name="measuring-tape" value="measuring-tape" /><text class="content">Measuring tape </text></li>
                                <li><input type="checkbox" name="reinforcement-tape" value="reinforcement-tape" /><text class="content">Reinforcement tape </text></li>
                                <li><input type="checkbox" name="sharp-knife" value="sharp-knife" /><text class="content">Sharp Knife </text></li>
                                <li><input type="checkbox" name="pointed-trowel" value="pointed-trowel" /><text class="content">Pointed Trowel </text></li>
                                <li><input type="checkbox" name="plastic" value="plastic" /><text class="content">Plastic for elasto/plastic room </text></li>
                                <li><input type="checkbox" name="rope" value="rope" /><text class="content">Rope with safety clip </text></li>
                            </ul>
                        </div>
                        <br>

                        <div id="inspection-checklist-section">
                            <div class="title-section">INSPECTION CHECKLIST</div><br>
                            <table style="width:100%">
                                <tr>
                                    <th>ROOF SYSTEM</th>
                                    <th>OK</th>
                                    <th>Minor problem</th>
                                    <th>Major problem</th>
                                    <th>Observation</th>
                                    <th>Date of repair</th>
                                </tr>
                                <tr>
                                    <td>TPO</td>
                                    <td><input type="radio" name="status-roofsystemtpo" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofsystemtpo" value="minor"></td>
                                    <td><input type="radio" name="status-roofsystemtpo" value="major"></td>
                                    <td><input type="text" name="observation-roofsystemtpo" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofsystemtpo" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>PVC</td>
                                    <td><input type="radio" name="status-roofsystempvc" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofsystempvc" value="minor"></td>
                                    <td><input type="radio" name="status-roofsystempvc" value="major"></td>
                                    <td><input type="text" name="observation-roofsystempvc" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofsystempvc" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>SBS</td>
                                    <td><input type="radio" name="status-roofsystemsbs" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofsystemsbs" value="minor"></td>
                                    <td><input type="radio" name="status-roofsystemsbs" value="major"></td>
                                    <td><input type="text" name="observation-roofsystemsbs" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofsystemsbs" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>APP</td>
                                    <td><input type="radio" name="status-roofsystemapp" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofsystemapp" value="minor"></td>
                                    <td><input type="radio" name="status-roofsystemapp" value="major"></td>
                                    <td><input type="text" name="observation-roofsystemapp" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofsystemapp" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>BUR</td>
                                    <td><input type="radio" name="status-roofsystembur" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofsystembur" value="minor"></td>
                                    <td><input type="radio" name="status-roofsystembur" value="major"></td>
                                    <td><input type="text" name="observation-roofsystembur" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofsystembur" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>ROOF CONDITION</th>
                                </tr>
                                <tr>
                                    <td>General Appearance</td>
                                    <td><input type="radio" name="status-roofconditionappearance" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofconditionappearance" value="minor"></td>
                                    <td><input type="radio" name="status-roofconditionappearance" value="major"></td>
                                    <td><input type="text" name="observation-roofconditionappearance" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofconditionappearance" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Debris</td>
                                    <td><input type="radio" name="status-roofconditiondebris" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofconditiondebris" value="minor"></td>
                                    <td><input type="radio" name="status-roofconditiondebris" value="major"></td>
                                    <td><input type="text" name="observation-roofconditiondebris" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofconditiondebris" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Drainage</td>
                                    <td><input type="radio" name="status-roofconditiondrainage" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofconditiondrainage" value="minor"></td>
                                    <td><input type="radio" name="status-roofconditiondrainage" value="major"></td>
                                    <td><input type="text" name="observation-roofconditiondrainage" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofconditiondrainage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Physical Damage</td>
                                    <td><input type="radio" name="status-roofconditiondamage" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofconditiondamage" value="minor"></td>
                                    <td><input type="radio" name="status-roofconditiondamage" value="major"></td>
                                    <td><input type="text" name="observation-roofconditiondamage" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofconditiondamage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>General Condition</td>
                                    <td><input type="radio" name="status-roofconditioncondition" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofconditioncondition" value="minor"></td>
                                    <td><input type="radio" name="status-roofconditioncondition" value="major"></td>
                                    <td><input type="text" name="observation-roofconditioncondition" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofconditioncondition" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>New equipment/alterations</td>
                                    <td><input type="radio" name="status-roofconditionequipment" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofconditionequipment" value="minor"></td>
                                    <td><input type="radio" name="status-roofconditionequipment" value="major"></td>
                                    <td><input type="text" name="observation-roofconditionequipment" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofconditionequipment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-roofconditionother" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofconditionother" value="minor"></td>
                                    <td><input type="radio" name="status-roofconditionother" value="major"></td>
                                    <td><input type="text" name="observation-roofconditionother" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofconditionother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>SURFACE CONDITION</th>
                                </tr>
                                <tr>
                                    <td>Base spots in gravel</td>
                                    <td><input type="radio" name="status-surfaceconditionspots" value="ok" checked></td>
                                    <td><input type="radio" name="status-surfaceconditionspots" value="minor"></td>
                                    <td><input type="radio" name="status-surfaceconditionspots" value="major"></td>
                                    <td><input type="text" name="observation-surfaceconditionspots" id="observation"></td>
                                    <td><input type="date" name="daterepair-surfaceconditionspots" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Alligatoring/cracking</td>
                                    <td><input type="radio" name="status-surfaceconditionalligatoring" value="ok" checked></td>
                                    <td><input type="radio" name="status-surfaceconditionalligatoring" value="minor"></td>
                                    <td><input type="radio" name="status-surfaceconditionalligatoring" value="major"></td>
                                    <td><input type="text" name="observation-surfaceconditionalligatoring" id="observation"></td>
                                    <td><input type="date" name="daterepair-surfaceconditionalligatoring" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Slippage</td>
                                    <td><input type="radio" name="status-surfaceconditionslippage" value="ok" checked></td>
                                    <td><input type="radio" name="status-surfaceconditionslippage" value="minor"></td>
                                    <td><input type="radio" name="status-surfaceconditionslippage" value="major"></td>
                                    <td><input type="text" name="observation-surfaceconditionslippage" id="observation"></td>
                                    <td><input type="date" name="daterepair-surfaceconditionslippage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-surfaceconditionother" value="ok" checked></td>
                                    <td><input type="radio" name="status-surfaceconditionother" value="minor"></td>
                                    <td><input type="radio" name="status-surfaceconditionother" value="major"></td>
                                    <td><input type="text" name="observation-surfaceconditionother" id="observation"></td>
                                    <td><input type="date" name="daterepair-surfaceconditionother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>MEMBRANE CONDITION</th>
                                </tr>
                                <tr>
                                    <td>Blistering</td>
                                    <td><input type="radio" name="status-membraneconditionblistering" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionblistering" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionblistering" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionblistering" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionblistering" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Splitting</td>
                                    <td><input type="radio" name="status-membraneconditionsplitting" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionsplitting" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionsplitting" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionsplitting" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionsplitting" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Ridging</td>
                                    <td><input type="radio" name="status-membraneconditionridging" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionridging" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionridging" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionridging" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionridging" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Fishmouthing</td>
                                    <td><input type="radio" name="status-membraneconditionfishmouth" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionfishmouth" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionfishmouth" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionfishmouth" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionfishmouth" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Loose felt laps</td>
                                    <td><input type="radio" name="status-membraneconditionlaps" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionlaps" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionlaps" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionlaps" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionlaps" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Punctures</td>
                                    <td><input type="radio" name="status-membraneconditionpunctures" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionpunctures" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionpunctures" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionpunctures" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionpunctures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Securement to substrate</td>
                                    <td><input type="radio" name="status-membraneconditionsecurement" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionsecurement" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionsecurement" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionsecurement" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionsecurement" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Fasteners</td>
                                    <td><input type="radio" name="status-membraneconditionfasteners" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionfasteners" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionfasteners" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionfasteners" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionfasteners" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Membrane slippage</td>
                                    <td><input type="radio" name="status-membraneconditionslippage" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionslippage" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionslippage" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionslippage" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionslippage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-membraneconditionother" value="ok" checked></td>
                                    <td><input type="radio" name="status-membraneconditionother" value="minor"></td>
                                    <td><input type="radio" name="status-membraneconditionother" value="major"></td>
                                    <td><input type="text" name="observation-membraneconditionother" id="observation"></td>
                                    <td><input type="date" name="daterepair-membraneconditionother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>FLASHING CONDITION</th>
                                </tr>
                                <tr>
                                    <td>Base</td>
                                    <td><input type="radio" name="status-flashingconditionbase" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionbase" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionbase" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionbase" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionbase" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Flashing</td>
                                    <td><input type="radio" name="status-flashingconditionflashing" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionflashing" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionflashing" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionflashing" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionflashing" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Punctures</td>
                                    <td><input type="radio" name="status-flashingconditionpunctures" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionpunctures" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionpunctures" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionpunctures" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionpunctures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Deterioration</td>
                                    <td><input type="radio" name="status-flashingconditiondeterior" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditiondeterior" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditiondeterior" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditiondeterior" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditiondeterior" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Blistering</td>
                                    <td><input type="radio" name="status-flashingconditionblistering" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionblistering" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionblistering" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionblistering" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionblistering" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Open laps</td>
                                    <td><input type="radio" name="status-flashingconditionlaps" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionlaps" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionlaps" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionlaps" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionlaps" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Attachment</td>
                                    <td><input type="radio" name="status-flashingconditionattachment" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionattachment" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionattachment" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionattachment" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionattachment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Ridging or wrinklinkg</td>
                                    <td><input type="radio" name="status-flashingconditionridging" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionridging" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionridging" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionridging" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionridging" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-flashingconditionother" value="ok" checked></td>
                                    <td><input type="radio" name="status-flashingconditionother" value="minor"></td>
                                    <td><input type="radio" name="status-flashingconditionother" value="major"></td>
                                    <td><input type="text" name="observation-flashingconditionother" id="observation"></td>
                                    <td><input type="date" name="daterepair-flashingconditionother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>COUNTER FLASHING</th>
                                </tr>
                                <tr>
                                    <td>Open laps</td>
                                    <td><input type="radio" name="status-counterflashinglaps" value="ok" checked></td>
                                    <td><input type="radio" name="status-counterflashinglaps" value="minor"></td>
                                    <td><input type="radio" name="status-counterflashinglaps" value="major"></td>
                                    <td><input type="text" name="observation-counterflashinglaps" id="observation"></td>
                                    <td><input type="date" name="daterepair-counterflashinglaps" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Punctures</td>
                                    <td><input type="radio" name="status-counterflashingpunctures" value="ok" checked></td>
                                    <td><input type="radio" name="status-counterflashingpunctures" value="minor"></td>
                                    <td><input type="radio" name="status-counterflashingpunctures" value="major"></td>
                                    <td><input type="text" name="observation-counterflashingpunctures" id="observation"></td>
                                    <td><input type="date" name="daterepair-counterflashingpunctures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Attachment</td>
                                    <td><input type="radio" name="status-counterflashingattachment" value="ok" checked></td>
                                    <td><input type="radio" name="status-counterflashingattachment" value="minor"></td>
                                    <td><input type="radio" name="status-counterflashingattachment" value="major"></td>
                                    <td><input type="text" name="observation-counterflashingattachment" id="observation"></td>
                                    <td><input type="date" name="daterepair-counterflashingattachment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Rusting</td>
                                    <td><input type="radio" name="status-counterflashingrusting" value="ok" checked></td>
                                    <td><input type="radio" name="status-counterflashingrusting" value="minor"></td>
                                    <td><input type="radio" name="status-counterflashingrusting" value="major"></td>
                                    <td><input type="text" name="observation-counterflashingrusting" id="observation"></td>
                                    <td><input type="date" name="daterepair-counterflashingrusting" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Fasteners</td>
                                    <td><input type="radio" name="status-counterflashingfasteners" value="ok" checked></td>
                                    <td><input type="radio" name="status-counterflashingfasteners" value="minor"></td>
                                    <td><input type="radio" name="status-counterflashingfasteners" value="major"></td>
                                    <td><input type="text" name="observation-counterflashingfasteners" id="observation"></td>
                                    <td><input type="date" name="daterepair-counterflashingfasteners" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Caulking</td>
                                    <td><input type="radio" name="status-counterflashingcaulking" value="ok" checked></td>
                                    <td><input type="radio" name="status-counterflashingcaulking" value="minor"></td>
                                    <td><input type="radio" name="status-counterflashingcaulking" value="major"></td>
                                    <td><input type="text" name="observation-counterflashingcaulking" id="observation"></td>
                                    <td><input type="date" name="daterepair-counterflashingcaulking" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-counterflashingother" value="ok" checked></td>
                                    <td><input type="radio" name="status-counterflashingother" value="minor"></td>
                                    <td><input type="radio" name="status-counterflashingother" value="major"></td>
                                    <td><input type="text" name="observation-counterflashingother" id="observation"></td>
                                    <td><input type="date" name="daterepair-counterflashingother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>COPING</th>
                                </tr>
                                <tr>
                                    <td>Open</td>
                                    <td><input type="radio" name="status-copingopen" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingopen" value="minor"></td>
                                    <td><input type="radio" name="status-copingopen" value="major"></td>
                                    <td><input type="text" name="observation-copingopen" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingopen" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Fractures</td>
                                    <td><input type="radio" name="status-copingfractures" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingfractures" value="minor"></td>
                                    <td><input type="radio" name="status-copingfractures" value="major"></td>
                                    <td><input type="text" name="observation-copingfractures" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingfractures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Punctures</td>
                                    <td><input type="radio" name="status-copingpunctures" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingpunctures" value="minor"></td>
                                    <td><input type="radio" name="status-copingpunctures" value="major"></td>
                                    <td><input type="text" name="observation-copingpunctures" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingpunctures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Attachment</td>
                                    <td><input type="radio" name="status-copingattachment" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingattachment" value="minor"></td>
                                    <td><input type="radio" name="status-copingattachment" value="major"></td>
                                    <td><input type="text" name="observation-copingattachment" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingattachment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Rusting</td>
                                    <td><input type="radio" name="status-copingrusting" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingrusting" value="minor"></td>
                                    <td><input type="radio" name="status-copingrusting" value="major"></td>
                                    <td><input type="text" name="observation-copingrusting" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingrusting" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Drainage</td>
                                    <td><input type="radio" name="status-copingdrainage" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingdrainage" value="minor"></td>
                                    <td><input type="radio" name="status-copingdrainage" value="major"></td>
                                    <td><input type="text" name="observation-copingdrainage" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingdrainage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Fasteners</td>
                                    <td><input type="radio" name="status-copingfasteners" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingfasteners" value="minor"></td>
                                    <td><input type="radio" name="status-copingfasteners" value="major"></td>
                                    <td><input type="text" name="observation-copingfasteners" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingfasteners" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Caulking</td>
                                    <td><input type="radio" name="status-copingcaulking" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingcaulking" value="minor"></td>
                                    <td><input type="radio" name="status-copingcaulking" value="major"></td>
                                    <td><input type="text" name="observation-copingcaulking" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingcaulking" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-copingother" value="ok" checked></td>
                                    <td><input type="radio" name="status-copingother" value="minor"></td>
                                    <td><input type="radio" name="status-copingother" value="major"></td>
                                    <td><input type="text" name="observation-copingother" id="observation"></td>
                                    <td><input type="date" name="daterepair-copingother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>WALL</th>
                                </tr>
                                <tr>
                                    <td>Mortar joints</td>
                                    <td><input type="radio" name="status-wallmortarjoints" value="ok" checked></td>
                                    <td><input type="radio" name="status-wallmortarjoints" value="minor"></td>
                                    <td><input type="radio" name="status-wallmortarjoints" value="major"></td>
                                    <td><input type="text" name="observation-wallmortarjoints" id="observation"></td>
                                    <td><input type="date" name="daterepair-wallmortarjoints" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Spalling</td>
                                    <td><input type="radio" name="status-wallspalling" value="ok" checked></td>
                                    <td><input type="radio" name="status-wallspalling" value="minor"></td>
                                    <td><input type="radio" name="status-wallspalling" value="major"></td>
                                    <td><input type="text" name="observation-wallspalling" id="observation"></td>
                                    <td><input type="date" name="daterepair-wallspalling" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Movement cracks</td>
                                    <td><input type="radio" name="status-wallcracks" value="ok" checked></td>
                                    <td><input type="radio" name="status-wallcracks" value="minor"></td>
                                    <td><input type="radio" name="status-wallcracks" value="major"></td>
                                    <td><input type="text" name="observation-wallcracks" id="observation"></td>
                                    <td><input type="date" name="daterepair-wallcracks" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>ROOF</th>
                                </tr>
                                <tr>
                                    <td>Edging/Fascia</td>
                                    <td><input type="radio" name="status-roofedging" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofedging" value="minor"></td>
                                    <td><input type="radio" name="status-roofedging" value="major"></td>
                                    <td><input type="text" name="observation-roofedging" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofedging" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Splitting</td>
                                    <td><input type="radio" name="status-roofsplitting" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofsplitting" value="minor"></td>
                                    <td><input type="radio" name="status-roofsplitting" value="major"></td>
                                    <td><input type="text" name="observation-roofsplitting" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofsplitting" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Securement</td>
                                    <td><input type="radio" name="status-roofsecurement" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofsecurement" value="minor"></td>
                                    <td><input type="radio" name="status-roofsecurement" value="major"></td>
                                    <td><input type="text" name="observation-roofsecurement" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofsecurement" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Rusting</td>
                                    <td><input type="radio" name="status-roofrusting" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofrusting" value="minor"></td>
                                    <td><input type="radio" name="status-roofrusting" value="major"></td>
                                    <td><input type="text" name="observation-roofrusting" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofrusting" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Felt deterioration</td>
                                    <td><input type="radio" name="status-roofdeterioration" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofdeterioration" value="minor"></td>
                                    <td><input type="radio" name="status-roofdeterioration" value="major"></td>
                                    <td><input type="text" name="observation-roofdeterioration" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofdeterioration" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Fasteners</td>
                                    <td><input type="radio" name="status-rooffasteners" value="ok" checked></td>
                                    <td><input type="radio" name="status-rooffasteners" value="minor"></td>
                                    <td><input type="radio" name="status-rooffasteners" value="major"></td>
                                    <td><input type="text" name="observation-rooffasteners" id="observation"></td>
                                    <td><input type="date" name="daterepair-rooffasteners" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Punctures</td>
                                    <td><input type="radio" name="status-roofpunctures" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpunctures" value="minor"></td>
                                    <td><input type="radio" name="status-roofpunctures" value="major"></td>
                                    <td><input type="text" name="observation-roofpunctures" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpunctures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>ROOF PENETRATIONS</th>
                                </tr>
                                <tr>
                                    <td>Equipment</td>
                                    <td><input type="radio" name="status-roofpenetrationsequipment" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpenetrationsequipment" value="minor"></td>
                                    <td><input type="radio" name="status-roofpenetrationsequipment" value="major"></td>
                                    <td><input type="text" name="observation-roofpenetrationsequipment" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpenetrationsequipment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Base</td>
                                    <td><input type="radio" name="status-roofpenetrationsbase" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpenetrationsbase" value="minor"></td>
                                    <td><input type="radio" name="status-roofpenetrationsbase" value="major"></td>
                                    <td><input type="text" name="observation-roofpenetrationsbase" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpenetrationsbase" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Flashing</td>
                                    <td><input type="radio" name="status-roofpenetrationsflashing" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpenetrationsflashing" value="minor"></td>
                                    <td><input type="radio" name="status-roofpenetrationsflashing" value="major"></td>
                                    <td><input type="text" name="observation-roofpenetrationsflashing" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpenetrationsflashing" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Open laps</td>
                                    <td><input type="radio" name="status-roofpenetrationslaps" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpenetrationslaps" value="minor"></td>
                                    <td><input type="radio" name="status-roofpenetrationslaps" value="major"></td>
                                    <td><input type="text" name="observation-roofpenetrationslaps" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpenetrationslaps" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Punctures</td>
                                    <td><input type="radio" name="status-roofpenetrationspunctures" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpenetrationspunctures" value="minor"></td>
                                    <td><input type="radio" name="status-roofpenetrationspunctures" value="major"></td>
                                    <td><input type="text" name="observation-roofpenetrationspunctures" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpenetrationspunctures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Attachment</td>
                                    <td><input type="radio" name="status-roofpenetrationsattachment" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpenetrationsattachment" value="minor"></td>
                                    <td><input type="radio" name="status-roofpenetrationsattachment" value="major"></td>
                                    <td><input type="text" name="observation-roofpenetrationsattachment" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpenetrationsattachment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-roofpenetrationsother" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofpenetrationsother" value="minor"></td>
                                    <td><input type="radio" name="status-roofpenetrationsother" value="major"></td>
                                    <td><input type="text" name="observation-roofpenetrationsother" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofpenetrationsother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>EQUIPMENT HOUSING</th>
                                </tr>
                                <tr>
                                    <td>Counter flashing</td>
                                    <td><input type="radio" name="status-equipmenthousingflash" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmenthousingflash" value="minor"></td>
                                    <td><input type="radio" name="status-equipmenthousingflash" value="major"></td>
                                    <td><input type="text" name="observation-equipmenthousingflash" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmenthousingflash" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Open seams</td>
                                    <td><input type="radio" name="status-equipmenthousingseams" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmenthousingseams" value="minor"></td>
                                    <td><input type="radio" name="status-equipmenthousingseams" value="major"></td>
                                    <td><input type="text" name="observation-equipmenthousingseams" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmenthousingseams" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Physical damage</td>
                                    <td><input type="radio" name="status-equipmenthousingdamage" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmenthousingdamage" value="minor"></td>
                                    <td><input type="radio" name="status-equipmenthousingdamage" value="major"></td>
                                    <td><input type="text" name="observation-equipmenthousingdamage" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmenthousingdamage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Caulking</td>
                                    <td><input type="radio" name="status-equipmenthousingcaulking" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmenthousingcaulking" value="minor"></td>
                                    <td><input type="radio" name="status-equipmenthousingcaulking" value="major"></td>
                                    <td><input type="text" name="observation-equipmenthousingcaulking" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmenthousingcaulking" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Draining</td>
                                    <td><input type="radio" name="status-equipmenthousingdraining" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmenthousingdraining" value="minor"></td>
                                    <td><input type="radio" name="status-equipmenthousingdraining" value="major"></td>
                                    <td><input type="text" name="observation-equipmenthousingdraining" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmenthousingdraining" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-equipmenthousingother" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmenthousingother" value="minor"></td>
                                    <td><input type="radio" name="status-equipmenthousingother" value="major"></td>
                                    <td><input type="text" name="observation-equipmenthousingother" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmenthousingother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>EQUIPMENT OPERATION</th>
                                </tr>
                                <tr>
                                    <td>Discharge of contaminants</td>
                                    <td><input type="radio" name="status-equipmentopdischarge" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmentopdischarge" value="minor"></td>
                                    <td><input type="radio" name="status-equipmentopdischarge" value="major"></td>
                                    <td><input type="text" name="observation-equipmentopdischarge" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmentopdischarge" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Excessive traffic wear</td>
                                    <td><input type="radio" name="status-equipmentoptraffic" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmentoptraffic" value="minor"></td>
                                    <td><input type="radio" name="status-equipmentoptraffic" value="major"></td>
                                    <td><input type="text" name="observation-equipmentoptraffic" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmentoptraffic" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-equipmentopother" value="ok" checked></td>
                                    <td><input type="radio" name="status-equipmentopother" value="minor"></td>
                                    <td><input type="radio" name="status-equipmentopother" value="major"></td>
                                    <td><input type="text" name="observation-equipmentopother" id="observation"></td>
                                    <td><input type="date" name="daterepair-equipmentopother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>ROOF JACKS/VENTS</th>
                                </tr>
                                <tr>
                                    <td>Attachment</td>
                                    <td><input type="radio" name="status-roofjacksattachment" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofjacksattachment" value="minor"></td>
                                    <td><input type="radio" name="status-roofjacksattachment" value="major"></td>
                                    <td><input type="text" name="observation-roofjacksattachment" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofjacksattachment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Physical damage</td>
                                    <td><input type="radio" name="status-roofjacksdamage" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofjacksdamage" value="minor"></td>
                                    <td><input type="radio" name="status-roofjacksdamage" value="major"></td>
                                    <td><input type="text" name="observation-roofjacksdamage" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofjacksdamage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Vents operable</td>
                                    <td><input type="radio" name="status-roofjacksvents" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofjacksvents" value="minor"></td>
                                    <td><input type="radio" name="status-roofjacksvents" value="major"></td>
                                    <td><input type="text" name="observation-roofjacksvents" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofjacksvents" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-roofjacksother" value="ok" checked></td>
                                    <td><input type="radio" name="status-roofjacksother" value="minor"></td>
                                    <td><input type="radio" name="status-roofjacksother" value="major"></td>
                                    <td><input type="text" name="observation-roofjacksother" id="observation"></td>
                                    <td><input type="date" name="daterepair-roofjacksother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>EXPANSION JOINT COVERS</th>
                                </tr>
                                <tr>
                                    <td>Open joints</td>
                                    <td><input type="radio" name="status-jointcoversjoints" value="ok" checked></td>
                                    <td><input type="radio" name="status-jointcoversjoints" value="minor"></td>
                                    <td><input type="radio" name="status-jointcoversjoints" value="major"></td>
                                    <td><input type="text" name="observation-jointcoversjoints" id="observation"></td>
                                    <td><input type="date" name="daterepair-jointcoversjoints" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Puncture/splits</td>
                                    <td><input type="radio" name="status-jointcoverspunctures" value="ok" checked></td>
                                    <td><input type="radio" name="status-jointcoverspunctures" value="minor"></td>
                                    <td><input type="radio" name="status-jointcoverspunctures" value="major"></td>
                                    <td><input type="text" name="observation-jointcoverspunctures" id="observation"></td>
                                    <td><input type="date" name="daterepair-jointcoverspunctures" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Securements</td>
                                    <td><input type="radio" name="status-jointcoverssecurements" value="ok" checked></td>
                                    <td><input type="radio" name="status-jointcoverssecurements" value="minor"></td>
                                    <td><input type="radio" name="status-jointcoverssecurements" value="major"></td>
                                    <td><input type="text" name="observation-jointcoverssecurements" id="observation"></td>
                                    <td><input type="date" name="daterepair-jointcoverssecurements" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Rusting</td>
                                    <td><input type="radio" name="status-jointcoversrusting" value="ok" checked></td>
                                    <td><input type="radio" name="status-jointcoversrusting" value="minor"></td>
                                    <td><input type="radio" name="status-jointcoversrusting" value="major"></td>
                                    <td><input type="text" name="observation-jointcoversrusting" id="observation"></td>
                                    <td><input type="date" name="daterepair-jointcoversrusting" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Fasteners</td>
                                    <td><input type="radio" name="status-jointcoversfasteners" value="ok" checked></td>
                                    <td><input type="radio" name="status-jointcoversfasteners" value="minor"></td>
                                    <td><input type="radio" name="status-jointcoversfasteners" value="major"></td>
                                    <td><input type="text" name="observation-jointcoversfasteners" id="observation"></td>
                                    <td><input type="date" name="daterepair-jointcoversfasteners" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-jointcoversother" value="ok" checked></td>
                                    <td><input type="radio" name="status-jointcoversother" value="minor"></td>
                                    <td><input type="radio" name="status-jointcoversother" value="major"></td>
                                    <td><input type="text" name="observation-jointcoversother" id="observation"></td>
                                    <td><input type="date" name="daterepair-jointcoversother" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <th>PITCH PANS</th>
                                </tr>
                                <tr>
                                    <td>Fill material shrinkage</td>
                                    <td><input type="radio" name="status-pitchpansshrinkage" value="ok" checked></td>
                                    <td><input type="radio" name="status-pitchpansshrinkage" value="minor"></td>
                                    <td><input type="radio" name="status-pitchpansshrinkage" value="major"></td>
                                    <td><input type="text" name="observation-pitchpansshrinkage" id="observation"></td>
                                    <td><input type="date" name="daterepair-pitchpansshrinkage" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Attachment</td>
                                    <td><input type="radio" name="status-pitchpansattachment" value="ok" checked></td>
                                    <td><input type="radio" name="status-pitchpansattachment" value="minor"></td>
                                    <td><input type="radio" name="status-pitchpansattachment" value="major"></td>
                                    <td><input type="text" name="observation-pitchpansattachment" id="observation"></td>
                                    <td><input type="date" name="daterepair-pitchpansattachment" id="daterepair"></td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td><input type="radio" name="status-pitchpansother" value="ok" checked></td>
                                    <td><input type="radio" name="status-pitchpansother" value="minor"></td>
                                    <td><input type="radio" name="status-pitchpansother" value="major"></td>
                                    <td><input type="text" name="observation-pitchpansother" id="observation"></td>
                                    <td><input type="date" name="daterepair-pitchpansother" id="daterepair"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="blueparagraph">
                            Comment on changes from previous inspections, and overall roof condition. Indicate recommended action of roof repair and/or further assessment, and estimated remaining life  expectancy of roof system. Include any photographs and thermography records in this report
                        </div>
                        <textarea class="textarea-comment" name="textarea-comment"></textarea>
                        <div class="blueparagraph">
                            Core sample
                        </div>
                        <textarea class="textarea-coresample" name="textarea-coresample"></textarea>
                        <div class="blueparagraph smallfont">
                            <p class ="title-centered">ROOF PLAN AND DETAILS</p>
                            <p><text class="title-centered">- USE THIS AREA ONLY IF DEFICIENCIES ARE OBSERVED -</text><br>Sketch roof plan. Include north arrow, the location of the items listed below, approximate dimensions of building, roofing materials, and other relevant items located on the roof. Show changes in roof elevations in a separate sketch.</p>
                        </div>
                        <div class="drawingarea">
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
                            <input type="submit" value="Submit Checklist" name="submit-inspectionlist" id="inspectionlist-button">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>