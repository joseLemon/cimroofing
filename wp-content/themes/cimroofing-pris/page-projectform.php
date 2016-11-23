<?php $page = 'projectform'; ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project Form</title>
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>css/formstyles.css">
        <link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </head>
    <body style="margin:0">


        <div id="projectform">
            <div class="general-content">

                <img src="<?php echo bloginfo('template_url').'/'; ?>img/logo.png" alt="cim logo" class="logo"><br>
                <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider"><br>
                <text class="title">PROJECT NAME GOES HERE</text><br>
                <div class="inside-content">
                    <p class="content">Contractor work log: Please submit the following log at the specified frequency identified by Roof Management during the preconstruction meeting. The log should provide an accurate account of the work items completed, progress to completion, issues encountered and photo representation of various stages of work during the reporting period.</p>

                    <form method="POST" action="controller.php">
                        <div class="project-info">
                            <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/project-img-example.png" alt="imagen proyecto" class="project-img">
                            <div class="information">
                                Project Name:&nbsp;<text class="project-name">Macro Dist. Ctr. #4</text><br>
                                Address:&nbsp;<text class="project-name">4709-4727 Macro Drive</text><br>
                                Contract Amount:&nbsp;<text class="project-name">$678,412.75</text><br> <!-- SOLO VISTO POR ADMIN -->
                                Project Year:&nbsp;<text class="project-name">2016</text><br>
                                Project Area:&nbsp;<text class="project-name">132000</text><br>
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
                                    <td class="no-border"><input type="date" name="start-date" id="dateproject"></td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border">End Date: </td>
                                    <td class="no-border"><input type="date" name="end-date" id="dateproject"></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                        <div class="work-items-completed">
                            <text style="font-weight:700;font-size:19px">WORK ITEMS COMPLETED</text><br> 
                            Step 2: Select the work items completed during the reporting period of this log.  <br>
                            <table style="margin-left:auto;margin-right:auto;margin-top:10px">
                                <tr class="no-border">
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Surface preparation</td>
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Installed skylights</td>
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Replaced deck</td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems"/>Installed edge metal</td>
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Installed wood nailer/blocking</td>
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Installed gutters and downspouts</td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems"/>Installed insulation</td>
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Installed internal drains</td>
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Installed field membrane</td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems"/>Applied surfacing</td>
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems"/>Installed inter-ply membrane/felt</td>
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Completed night tie-in</td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Installed capsheet</td>
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Installed 15# felt</td>
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Installed parapet flashings</td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Installed ice and water shield</td>
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Installed curb flashings</td>
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Installed shingles</td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border"><input type="checkbox" name="clipboard" value="clipboard" id="workitems" />Installed detail flashings</td>
                                    <td class="no-border"><input type="checkbox" name="whisk-broom" value="whisk-broom" id="workitems" />Completed punch list</td>
                                </tr>
                                <tr class="no-border">
                            </table><br>
                        </div>
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                        <div class="progress">
                            <text style="font-weight:700;font-size:19px">PROGRESS TO COMPLETION</text><br> 
                            Step 3: Update the progress to completion by inputting the total percent complete and the total square feet of the roofing <text style="color:red;font-weight:600">installed to date.</text>  <br>
                            <table style="margin-left:0" class="no-border">
                                <tr class="no-border">
                                    <td class="no-border">Square feet installed to date:</td> 
                                    <td class="no-border"><input type="text" name="square-feet-todate" id="square-feet-todate"></td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border">Percentage completed: </td>
                                    <td class="no-border"><input type="text" name="percentage completed" id="percentagecompleted"></td>
                                </tr>
                                <tr class="no-border">
                                     <td class="no-border">Target completion date: </td>
                                    <td class="no-border"><input type="date" name="targetdate" id="targetdate"></td>
                                </tr>
                            </table>
                            <input type="checkbox" name="completiondetailmetal" value="completed" /> Upon completion of detail and metal work, please check this box. <br>
                        </div><br>
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                        <div class="fieldnotes">
                            <text style="font-weight:700;font-size:19px">FIELD NOTES</text><br> 
                            Step 4: Provide details on any situations, weather issues or concerns encountered during the reporting period.<br>
                            <textarea id="details-field-notes" name="details-field-notes"></textarea><br>
                        </div><br>
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                        <div class="fieldnotes">
                            <text style="font-weight:700;font-size:19px">PHOTO DOCUMENTATION</text><br> 
                            Step 5: Provide photographs detailing various stages of the installation process for the reporting period.<br>
                            <input type="submit" value="Add/Edit Pictures" name="add-pictures" id="pictures-button"><br>
                            <div class="image-tumbnails">Image thumbnails</div><br>
                        </div><br>
                        <img src="<?php echo bloginfo('template_url').'/'; ?>img/content/division-empleos.png" alt="divider" class="form-divider longwidth" style="height:2px"><br>
                        <div class="fieldnotes">
                            <text style="font-weight:700;font-size:19px">SUBMIT LOG</text><br> 
                            Step 6: Provide the name of the submitter and click the button to submit the log.
                            <div class="signature">
                            <text class="submitted-by">Submitted By: NAME</text><!--nombre de usuario-->
                            <input type="submit" value="Submit Project Update" name="submit-project" id="submitproject-button">
                            </div>
                        </div><br>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>