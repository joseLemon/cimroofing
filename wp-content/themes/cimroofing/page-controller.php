<?php
$user_id = get_current_user_id();

if(isset($_POST['submit-project'])) {
    $start_date = date('Y-m-d',strtotime($_POST['start-date']));
    $end_date = date('Y-m-d',strtotime($_POST['end-date']));
    $target_date = date('Y-m-d',strtotime($_POST['target-date']));
    $query_report = "INSERT INTO `reports` (`report_id`, `report_start_date`, `report_end_date`, `report_square_feet_to_date`, `report_percentage_completed`, `report_completed`, `report_target_completion_date`, `report_field_notes`, `user_id`, `project_id`, created_at) VALUES (NULL, '".$start_date."', '".$end_date."', '".$_POST['square-feet-todate']."', '".$_POST['percentage-completed']."', '".$_POST['completion-metal']."', '".$target_date."', '".$_POST['details-field-notes']."', ".$user_id.", '".$_POST['project-id']."', CURRENT_TIMESTAMP);";

    $wpdb->query( $query_report );

    //FOR EACH DE CHECKBOXES
    $query_workitems = "INSERT INTO `report_work_items` (`report_id`, `work_item_id`) Values ";
    $report_id = $wpdb->get_results('SELECT MAX(report_id) as id FROM reports where user_id = '.$user_id);

    $report_id = $report_id[0]->id;

    $cont = 0;
    if (is_array($_POST["workitems"])) { //lo puse pqe salia warning
        foreach($_POST["workitems"] as $workitem){
            if($cont == 0){
                $query_workitems .= "(".$report_id[0]->id.",$workitem)";
                $cont++;
            }else{
                $query_workitems .= ",(".$report_id[0]->id.",$workitem)";
            }
        }
    }
    $wpdb->query( $query_workitems );

    $target_dir = dirname(__FILE__) . '\\file_uploads\\reports\\' . $report_id . '\\';
    if(!is_dir($target_dir) && !file_exists($target_dir)) {
        mkdir($target_dir);
    }

    //  PROCESO PARA SUBIR IMAGENES
    $i = 1;
    foreach( $_POST['img'] as $key => $img) {
        list($type, $img) = explode(';', $img);
        list(, $img)      = explode(',', $img);
        $data = base64_decode($img);

        $path = $target_dir.$i.'.jpg';

        if(file_put_contents($path, $data)) {
            echo 'uploaded';
        } else {
            echo 'fail';
        }
        $query_project = "INSERT INTO `project_pictures` (`report_id`, `project_picture_name`, `project_picture_description`) VALUES ('".$report_id."', '".$i."', '".$_POST[$key]."');";
        $wpdb->query( $query_project );

        $i++;
    }

    wp_redirect(home_url().'/projecthistory?id='.$_GET['id']);
}
/* EMPIEZA IMAGENES */
if(isset($_POST['tmp-folder'])) {
    $tmpFolder = $_POST['tmp-folder'];

    //  PROCESO PARA SUBIR IMAGENES 
    $total = count($_FILES['pictures']['name']);
    if ($total > 40) {
        $total = 40;
    }

    $counter = 0;

    if(isset($_POST['projects'])) {
        $target_dir = dirname(__FILE__) . '\\file_uploads\\projects\\' . $tmpFolder . '\\';
    } else {
        $target_dir = dirname(__FILE__) . '\\file_uploads\\reports\\' . $tmpFolder . '\\';
    }

    //  Create temporary directory
    if(!is_dir($target_dir) && !file_exists($target_dir)) {
        mkdir($target_dir);
    }

    if(isset($_POST['projects'])) {
        if ($_FILES["pictures"]["size"][$i] > 25000000) {
            echo "The image exceeds 25Mb.";
            return true;
        } else {
            if(move_uploaded_file($_FILES["pictures"]["tmp_name"],$target_dir . 'project_image' . '.tmp')) {
                // Resize it
                GenerateThumbnail($target_dir . 'project_image' . '.tmp',$target_dir . 'project_image' . '.jpg',700,412,0.80);
                // Delete full size
                unlink($target_dir . 'project_image' . '.tmp');
            }
        }
        return true;
    }

    //  Delete files if they exist
    $files = glob($target_dir.'/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }

    for ($i = 0; $i < $total; $i++) {

        if ($_FILES["pictures"]["size"][$i] > 25000000) {
            echo "The image exceeds 25Mb.";
            continue;
        }
        if ($counter == 40) {
            return true;
        }

        if(move_uploaded_file($_FILES["pictures"]["tmp_name"][$i], $target_dir . $i . '.tmp')) {
            // Resize it
            GenerateThumbnail($target_dir . $i . '.tmp',$target_dir . $i . '.png',700,394,0.80);
            // Delete full size
            unlink($target_dir . $i . '.tmp');
            echo 'file uploaded succesfully';
        } else {
            echo 'an error occurred';
        }
    }
}

if(isset($_POST['tmp-folder-unload'])) {
    $tmpFolder = $_POST['tmp-folder-unload'];
    echo $tmpFolder;
    //  DELETE TEMPORARY FOLDER
    if(isset($_POST['projects'])) {
        $TmpDirToDelete = dirname(__FILE__) . '\\file_uploads\\projects\\' . $tmpFolder . '\\';
    }
    if(isset($_POST['reports'])) {
        $TmpDirToDelete = dirname(__FILE__) . '\\file_uploads\\reports\\' . $tmpFolder . '\\';
    }

    $files = glob($TmpDirToDelete.'/*'); // get all file names

    print_r($files);

    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }

    rmdir($TmpDirToDelete);
}

if(isset($_POST['tmp-folder-delete'])) {


}
/* TERMINA IMAGENES */

if(isset($_POST['submit-inspectionlist'])) {


    $client_date = "'".date('Y-m-d H:i:s',strtotime($_POST['date']))."'";

    if(!isset($_POST['flatmembrane-select']))
        $type_roof_flat = 'NULL';
    else
        $type_roof_flat = $_POST['flatmembrane-select'];

    if(!isset($_POST['sloped-select']))
        $type_roof_sloped = 'NULL';
    else
        $type_roof_sloped = $_POST['sloped-select'];

    if(isset($_POST['clearaccessposition']))
        $clear_access_id = $_POST['clearaccessposition'];
    else
        $clear_access_id='NULL';

    if(isset($_POST['slope']))
        $slope = "'".$_POST['slope']."'";
    else
        $slope='NULL';


    $query_client = "INSERT INTO `clients` (`client_id`, `client_project_owner`, `client_project_address`, `client_height_at_eave`, `client_height_at_ridge`, `clear_access_id`, `type_roof_flat_id`, `type_roof_sloped_id`, `client_sloped`, `client_size_of_roof`, `client_manufacturer_and_brand`, `user_id`, `client_year_installed`, `client_year_manufactured`, `client_title`, `client_signature`, `client_date`, deleted_at, created_at) VALUES (NULL, '".$_POST['project-owner']."', '".$_POST['project-address']."', '".$_POST['height-at-eave']."', '".$_POST['height-at-ridge']."', $clear_access_id, $type_roof_flat, $type_roof_sloped , $slope, '".$_POST['size-of-roof']."', '".$_POST['manufacturer']."', ".$user_id.", '".$_POST['year-installed']."', '".$_POST['year-manufactured']."', '".$_POST['title']."', '".$_POST['signature-input']."', $client_date, NULL, CURRENT_TIMESTAMP);";

    $wpdb->query( $query_client );
    $programmed_date = date('Y-m-d H:i:s',strtotime($_POST['date-maintenance']));

    $client_id = $wpdb->get_results('   SELECT MAX(client_id) as id FROM clients where user_id = '.$user_id)[0]->id;

    $query_roof_inspection = "INSERT INTO `roof_inspections` (`roof_inspection_id`, `roof_inspection_facility`, `roof_inspection_location`, `roof_inspection_datetime`, `client_id`, `roof_inspection_core_sample`, `roof_inspection_comment`, `roof_inspection_plan`,`user_id`) VALUES (NULL, '".$_POST['facility']."', '".$_POST['location']."', '$programmed_date', $client_id, '".$_POST['core-sample']."', '".$_POST['comment']."', '".$_POST['sketch-input']."', ".$user_id.");";

    $wpdb->query( $query_roof_inspection );

    $query_materials = "INSERT INTO `roof_materials` (`roof_inspection_id`, `inspection_material_id`) Values ";
    $roof_inspection_id = $wpdb->get_results('SELECT MAX(roof_inspection_id) as id FROM roof_inspections where user_id = '.$user_id);
    $cont = 0;
    if (is_array($_POST["materials"])) { //lo puse pqe salia warning
        foreach($_POST["materials"] as $material){
            if($cont == 0){
                $query_materials .= "(".$roof_inspection_id[0]->id.",$material)";
                $cont++;
            }else{
                $query_materials .= ",(".$roof_inspection_id[0]->id.",$material)";
            }
        }
    }

    $wpdb->query( $query_materials );


    $query_checklists = "INSERT INTO `roof_checklists` (`roof_inspection_id`, `inspection_checklist_id`, `roof_checklist_problem`, `roof_checklist_observation`, `roof_checklist_date_of_repair`) VALUES ";
    $roof_inspection_id = $wpdb->get_results('SELECT MAX(roof_inspection_id) as id FROM roof_inspections where user_id = '.$user_id);

    $count = 0;

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-1']));
    $result = $_POST['status-1'];
    if($result == 0){
    }else{
        $query_checklists .= "(".$roof_inspection_id[0]->id.", '1', '".$_POST['status-1']."', '".$_POST['observation-1']."', '".$checklist_date."')";
        $count++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-2']));
    $result = $_POST['status-2'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '2', '".$_POST['status-2']."', '".$_POST['observation-2']."', '".$checklist_date."')";
        } else{
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '2', '".$_POST['status-2']."', '".$_POST['observation-2']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-3']));
    $result = $_POST['status-3'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '3', '".$_POST['status-3']."', '".$_POST['observation-3']."', '".$checklist_date."')";
        } else{
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '3', '".$_POST['status-3']."', '".$_POST['observation-3']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-4']));
    $result = $_POST['status-4'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '4', '".$_POST['status-4']."', '".$_POST['observation-4']."', '".$checklist_date."')";
        } else{
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '4', '".$_POST['status-4']."', '".$_POST['observation-4']."', '".$checklist_date."')";  
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-5']));
    $result = $_POST['status-5'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '5', '".$_POST['status-5']."', '".$_POST['observation-5']."', '".$checklist_date."')";
        } else{
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '5', '".$_POST['status-5']."', '".$_POST['observation-5']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-6']));
    $result = $_POST['status-6'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '6', '".$_POST['status-6']."', '".$_POST['observation-6']."', '".$checklist_date."')";
        } else{
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '6', '".$_POST['status-6']."', '".$_POST['observation-6']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-7']));
    $result = $_POST['status-7'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '7', '".$_POST['status-7']."', '".$_POST['observation-7']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '7', '".$_POST['status-7']."', '".$_POST['observation-7']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-8']));
    $result = $_POST['status-8'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '8', '".$_POST['status-8']."', '".$_POST['observation-8']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '8', '".$_POST['status-8']."', '".$_POST['observation-8']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-9']));
    $result = $_POST['status-9'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '9', '".$_POST['status-9']."', '".$_POST['observation-9']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '9', '".$_POST['status-9']."', '".$_POST['observation-9']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-10']));
    $result = $_POST['status-10'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '10', '".$_POST['status-10']."', '".$_POST['observation-10']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '10', '".$_POST['status-10']."', '".$_POST['observation-10']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-11']));
    $result = $_POST['status-11'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '11', '".$_POST['status-11']."', '".$_POST['observation-11']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '11', '".$_POST['status-11']."', '".$_POST['observation-11']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-12']));
    $result = $_POST['status-12'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '12', '".$_POST['status-12']."', '".$_POST['observation-12']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '12', '".$_POST['status-12']."', '".$_POST['observation-12']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-13']));
    $result = $_POST['status-13'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '13', '".$_POST['status-13']."', '".$_POST['observation-13']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '13', '".$_POST['status-13']."', '".$_POST['observation-13']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-14']));
    $result = $_POST['status-14'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '14', '".$_POST['status-14']."', '".$_POST['observation-14']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '14', '".$_POST['status-14']."', '".$_POST['observation-14']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-15']));
    $result = $_POST['status-15'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '15', '".$_POST['status-15']."', '".$_POST['observation-15']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '15', '".$_POST['status-15']."', '".$_POST['observation-15']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-16']));
    $result = $_POST['status-16'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '16', '".$_POST['status-16']."', '".$_POST['observation-16']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '16', '".$_POST['status-16']."', '".$_POST['observation-16']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-17']));
    $result = $_POST['status-17'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '17', '".$_POST['status-17']."', '".$_POST['observation-17']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '17', '".$_POST['status-17']."', '".$_POST['observation-17']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-18']));
    $result = $_POST['status-18'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '18', '".$_POST['status-18']."', '".$_POST['observation-18']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '18', '".$_POST['status-18']."', '".$_POST['observation-18']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-19']));
    $result = $_POST['status-19'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '19', '".$_POST['status-19']."', '".$_POST['observation-19']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '19', '".$_POST['status-19']."', '".$_POST['observation-19']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-20']));
    $result = $_POST['status-20'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '20', '".$_POST['status-20']."', '".$_POST['observation-20']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '20', '".$_POST['status-20']."', '".$_POST['observation-20']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-21']));
    $result = $_POST['status-21'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '21', '".$_POST['status-21']."', '".$_POST['observation-21']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '21', '".$_POST['status-21']."', '".$_POST['observation-21']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-22']));
    $result = $_POST['status-22'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '22', '".$_POST['status-22']."', '".$_POST['observation-22']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '22', '".$_POST['status-22']."', '".$_POST['observation-22']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-23']));
    $result = $_POST['status-23'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '23', '".$_POST['status-23']."', '".$_POST['observation-23']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '23', '".$_POST['status-23']."', '".$_POST['observation-23']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-24']));
    $result = $_POST['status-24'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '24', '".$_POST['status-24']."', '".$_POST['observation-24']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '24', '".$_POST['status-24']."', '".$_POST['observation-24']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-25']));
    $result = $_POST['status-25'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '25', '".$_POST['status-25']."', '".$_POST['observation-25']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '25', '".$_POST['status-25']."', '".$_POST['observation-25']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-26']));
    $result = $_POST['status-26'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '26', '".$_POST['status-26']."', '".$_POST['observation-26']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '26', '".$_POST['status-26']."', '".$_POST['observation-26']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-27']));
    $result = $_POST['status-27'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '27', '".$_POST['status-27']."', '".$_POST['observation-27']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '27', '".$_POST['status-27']."', '".$_POST['observation-27']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-28']));
    $result = $_POST['status-28'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '28', '".$_POST['status-28']."', '".$_POST['observation-28']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '28', '".$_POST['status-28']."', '".$_POST['observation-28']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-29']));
    $result = $_POST['status-29'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '29', '".$_POST['status-29']."', '".$_POST['observation-29']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '29', '".$_POST['status-29']."', '".$_POST['observation-29']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-30']));
    $result = $_POST['status-30'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '30', '".$_POST['status-30']."', '".$_POST['observation-30']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '30', '".$_POST['status-30']."', '".$_POST['observation-30']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-31']));
    $result = $_POST['status-31'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '31', '".$_POST['status-31']."', '".$_POST['observation-31']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '31', '".$_POST['status-31']."', '".$_POST['observation-31']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-32']));
    $result = $_POST['status-32'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '32', '".$_POST['status-32']."', '".$_POST['observation-32']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '32', '".$_POST['status-32']."', '".$_POST['observation-32']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-33']));
    $result = $_POST['status-33'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '33', '".$_POST['status-33']."', '".$_POST['observation-33']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '33', '".$_POST['status-33']."', '".$_POST['observation-33']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-34']));
    $result = $_POST['status-34'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '34', '".$_POST['status-34']."', '".$_POST['observation-34']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '34', '".$_POST['status-34']."', '".$_POST['observation-34']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-35']));
    $result = $_POST['status-35'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '35', '".$_POST['status-35']."', '".$_POST['observation-35']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '35', '".$_POST['status-35']."', '".$_POST['observation-35']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-36']));
    $result = $_POST['status-36'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '36', '".$_POST['status-36']."', '".$_POST['observation-36']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '36', '".$_POST['status-36']."', '".$_POST['observation-36']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-37']));
    $result = $_POST['status-37'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '37', '".$_POST['status-37']."', '".$_POST['observation-37']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '37', '".$_POST['status-37']."', '".$_POST['observation-37']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-38']));
    $result = $_POST['status-38'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '38', '".$_POST['status-38']."', '".$_POST['observation-38']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '38', '".$_POST['status-38']."', '".$_POST['observation-38']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-39']));
    $result = $_POST['status-39'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '39', '".$_POST['status-39']."', '".$_POST['observation-39']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '39', '".$_POST['status-39']."', '".$_POST['observation-39']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-40']));
    $result = $_POST['status-40'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '40', '".$_POST['status-40']."', '".$_POST['observation-40']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '40', '".$_POST['status-40']."', '".$_POST['observation-40']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-41']));
    $result = $_POST['status-41'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '41', '".$_POST['status-41']."', '".$_POST['observation-41']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '41', '".$_POST['status-41']."', '".$_POST['observation-41']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-42']));
    $result = $_POST['status-42'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '42', '".$_POST['status-42']."', '".$_POST['observation-42']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '42', '".$_POST['status-42']."', '".$_POST['observation-42']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-43']));
    $result = $_POST['status-43'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '43', '".$_POST['status-43']."', '".$_POST['observation-43']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '43', '".$_POST['status-43']."', '".$_POST['observation-43']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-44']));
    $result = $_POST['status-44'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '44', '".$_POST['status-44']."', '".$_POST['observation-44']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '44', '".$_POST['status-44']."', '".$_POST['observation-44']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-45']));
    $result = $_POST['status-45'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '45', '".$_POST['status-45']."', '".$_POST['observation-45']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '45', '".$_POST['status-45']."', '".$_POST['observation-45']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-46']));
    $result = $_POST['status-46'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '46', '".$_POST['status-46']."', '".$_POST['observation-46']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '46', '".$_POST['status-46']."', '".$_POST['observation-46']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-47']));
    $result = $_POST['status-47'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '47', '".$_POST['status-47']."', '".$_POST['observation-47']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '47', '".$_POST['status-47']."', '".$_POST['observation-47']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-48']));
    $result = $_POST['status-48'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '48', '".$_POST['status-48']."', '".$_POST['observation-48']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '48', '".$_POST['status-48']."', '".$_POST['observation-48']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-49']));
    $result = $_POST['status-49'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '49', '".$_POST['status-49']."', '".$_POST['observation-49']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '49', '".$_POST['status-49']."', '".$_POST['observation-49']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-50']));
    $result = $_POST['status-50'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '50', '".$_POST['status-50']."', '".$_POST['observation-50']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '50', '".$_POST['status-50']."', '".$_POST['observation-50']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-51']));
    $result = $_POST['status-51'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '51', '".$_POST['status-51']."', '".$_POST['observation-51']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '51', '".$_POST['status-51']."', '".$_POST['observation-51']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-52']));
    $result = $_POST['status-52'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '52', '".$_POST['status-52']."', '".$_POST['observation-52']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '52', '".$_POST['status-52']."', '".$_POST['observation-52']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-53']));
    $result = $_POST['status-53'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '53', '".$_POST['status-53']."', '".$_POST['observation-53']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '53', '".$_POST['status-53']."', '".$_POST['observation-53']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-54']));
    $result = $_POST['status-54'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '54', '".$_POST['status-54']."', '".$_POST['observation-54']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '54', '".$_POST['status-54']."', '".$_POST['observation-54']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-55']));
    $result = $_POST['status-55'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '55', '".$_POST['status-55']."', '".$_POST['observation-55']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '55', '".$_POST['status-55']."', '".$_POST['observation-55']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-56']));
    $result = $_POST['status-56'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '56', '".$_POST['status-56']."', '".$_POST['observation-56']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '56', '".$_POST['status-56']."', '".$_POST['observation-56']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-57']));
    $result = $_POST['status-57'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '57', '".$_POST['status-57']."', '".$_POST['observation-57']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '57', '".$_POST['status-57']."', '".$_POST['observation-57']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-58']));
    $result = $_POST['status-58'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '58', '".$_POST['status-58']."', '".$_POST['observation-58']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '58', '".$_POST['status-58']."', '".$_POST['observation-58']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-59']));
    $result = $_POST['status-59'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '59', '".$_POST['status-59']."', '".$_POST['observation-59']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '59', '".$_POST['status-59']."', '".$_POST['observation-59']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-60']));
    $result = $_POST['status-60'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '60', '".$_POST['status-60']."', '".$_POST['observation-60']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '60', '".$_POST['status-60']."', '".$_POST['observation-60']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-61']));
    $result = $_POST['status-61'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '61', '".$_POST['status-61']."', '".$_POST['observation-61']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '61', '".$_POST['status-61']."', '".$_POST['observation-61']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-62']));
    $result = $_POST['status-62'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '62', '".$_POST['status-62']."', '".$_POST['observation-62']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '62', '".$_POST['status-62']."', '".$_POST['observation-62']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-63']));
    $result = $_POST['status-63'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '63', '".$_POST['status-63']."', '".$_POST['observation-63']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '63', '".$_POST['status-63']."', '".$_POST['observation-63']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-64']));
    $result = $_POST['status-64'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '64', '".$_POST['status-64']."', '".$_POST['observation-64']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '64', '".$_POST['status-64']."', '".$_POST['observation-64']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-65']));
    $result = $_POST['status-65'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '65', '".$_POST['status-65']."', '".$_POST['observation-65']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '65', '".$_POST['status-65']."', '".$_POST['observation-65']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-66']));
    $result = $_POST['status-66'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '66', '".$_POST['status-66']."', '".$_POST['observation-66']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '66', '".$_POST['status-66']."', '".$_POST['observation-66']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-67']));
    $result = $_POST['status-67'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '67', '".$_POST['status-67']."', '".$_POST['observation-67']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '67', '".$_POST['status-67']."', '".$_POST['observation-67']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-68']));
    $result = $_POST['status-68'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '68', '".$_POST['status-68']."', '".$_POST['observation-68']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '68', '".$_POST['status-68']."', '".$_POST['observation-68']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-69']));
    $result = $_POST['status-69'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '69', '".$_POST['status-69']."', '".$_POST['observation-69']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '69', '".$_POST['status-69']."', '".$_POST['observation-69']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-70']));
    $result = $_POST['status-70'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '70', '".$_POST['status-70']."', '".$_POST['observation-70']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '70', '".$_POST['status-70']."', '".$_POST['observation-70']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-71']));
    $result = $_POST['status-71'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '71', '".$_POST['status-71']."', '".$_POST['observation-71']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '71', '".$_POST['status-71']."', '".$_POST['observation-71']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-72']));
    $result = $_POST['status-72'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '72', '".$_POST['status-72']."', '".$_POST['observation-72']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '72', '".$_POST['status-72']."', '".$_POST['observation-72']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-73']));
    $result = $_POST['status-73'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '73', '".$_POST['status-73']."', '".$_POST['observation-73']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '73', '".$_POST['status-73']."', '".$_POST['observation-73']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-74']));
    $result = $_POST['status-74'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '74', '".$_POST['status-74']."', '".$_POST['observation-74']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '74', '".$_POST['status-74']."', '".$_POST['observation-74']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-75']));
    $result = $_POST['status-75'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '75', '".$_POST['status-75']."', '".$_POST['observation-75']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '75', '".$_POST['status-75']."', '".$_POST['observation-75']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-76']));
    $result = $_POST['status-76'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '76', '".$_POST['status-76']."', '".$_POST['observation-76']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '76', '".$_POST['status-76']."', '".$_POST['observation-76']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-77']));
    $result = $_POST['status-77'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '77', '".$_POST['status-77']."', '".$_POST['observation-77']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '77', '".$_POST['status-77']."', '".$_POST['observation-77']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-78']));
    $result = $_POST['status-78'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '78', '".$_POST['status-78']."', '".$_POST['observation-78']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '78', '".$_POST['status-78']."', '".$_POST['observation-78']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-79']));
    $result = $_POST['status-79'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '79', '".$_POST['status-79']."', '".$_POST['observation-79']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '79', '".$_POST['status-79']."', '".$_POST['observation-79']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-80']));
    $result = $_POST['status-80'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '80', '".$_POST['status-80']."', '".$_POST['observation-80']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '80', '".$_POST['status-80']."', '".$_POST['observation-80']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-81']));
    $result = $_POST['status-81'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '81', '".$_POST['status-81']."', '".$_POST['observation-81']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '81', '".$_POST['status-81']."', '".$_POST['observation-81']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-82']));
    $result = $_POST['status-82'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '82', '".$_POST['status-82']."', '".$_POST['observation-82']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '82', '".$_POST['status-82']."', '".$_POST['observation-82']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-83']));
    $result = $_POST['status-83'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '83', '".$_POST['status-83']."', '".$_POST['observation-83']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '83', '".$_POST['status-83']."', '".$_POST['observation-83']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-84']));
    $result = $_POST['status-84'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '84', '".$_POST['status-84']."', '".$_POST['observation-84']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '84', '".$_POST['status-84']."', '".$_POST['observation-84']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-85']));
    $result = $_POST['status-85'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '85', '".$_POST['status-85']."', '".$_POST['observation-85']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '85', '".$_POST['status-85']."', '".$_POST['observation-85']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-86']));
    $result = $_POST['status-86'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '86', '".$_POST['status-86']."', '".$_POST['observation-86']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '86', '".$_POST['status-86']."', '".$_POST['observation-86']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-87']));
    $result = $_POST['status-87'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '87', '".$_POST['status-87']."', '".$_POST['observation-87']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '87', '".$_POST['status-87']."', '".$_POST['observation-87']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-88']));
    $result = $_POST['status-88'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '88', '".$_POST['status-88']."', '".$_POST['observation-88']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '88', '".$_POST['status-88']."', '".$_POST['observation-88']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-89']));
    $result = $_POST['status-89'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '89', '".$_POST['status-89']."', '".$_POST['observation-89']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '89', '".$_POST['status-89']."', '".$_POST['observation-89']."', '".$checklist_date."')";
            $count++;
        }
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-90']));
    $result = $_POST['status-90'];
    if($result == 0){
    }else{
        if($count>0){
            $query_checklists .= ", (".$roof_inspection_id[0]->id.", '90', '".$_POST['status-90']."', '".$_POST['observation-90']."', '".$checklist_date."')";
        } else{   
            $query_checklists .= "(".$roof_inspection_id[0]->id.", '90', '".$_POST['status-90']."', '".$_POST['observation-90']."', '".$checklist_date."')";
            $count++;
        }
    }

    $query_checklists .= ";";
    $wpdb->query( $query_checklists );
}

if(isset($_POST['submit-newproject'])) {

    $query_project = "INSERT INTO `projects` (`project_id`, `project_name`, `project_address`, `project_contract_amount`, `project_year`, `project_area`, `deleted_at`, `created_at`) VALUES (NULL, '".$_POST['newproject-name']."', '".$_POST['newproject-address']."', '".$_POST['newproject-amount']."', '".$_POST['newproject-year']."', '".$_POST['newproject-area']."', NULL, CURRENT_TIMESTAMP);";
    $wpdb->query( $query_project );

    $assignedUsers = $_POST['newproject-assigned'];
    $project_id = $wpdb->get_results('SELECT MAX(project_id) as id FROM projects')[0]->id;
    foreach($assignedUsers as $user) {
        $query_project_users = "INSERT INTO project_users (project_id, user_id) VALUES ($project_id,$user);";
        $wpdb->query( $query_project_users );
    }

    $target_dir = dirname(__FILE__) . '\\file_uploads\\projects\\' . $project_id . '\\';
    if(!is_dir(!$target_dir) && !file_exists($target_dir)) {
        mkdir($target_dir);
    }

    //  PROCESO PARA SUBIR IMAGENES
    $i = 1;

    $img = $_POST['img'];

    list($type, $img) = explode(';', $img);
    list(, $img)      = explode(',', $img);
    $data = base64_decode($img);

    $path = $target_dir.'project_image'.'.jpg';

    if(file_put_contents($path, $data)) {
        echo 'uploaded';
    } else {
        echo 'fail';
    }

    wp_redirect(home_url().'/projects');
}

/* UPDATES */

if(isset($_POST['edit-project'])){

    $project_id = $_POST['project-id'];

    $query_editproject = "UPDATE `projects` SET project_name = '".$_POST['project-name']."', project_address = '".$_POST['project-address']."',  project_contract_amount = '".$_POST['project-amount']."', project_year = '".$_POST['project-year']."', project_area = '".$_POST['project-area']."' WHERE project_id = '".$project_id."';";

    $assignedUsers = $_POST['project-assigned'];

    $wpdb->query("DELETE FROM project_users WHERE project_id = ".$_POST['project-id']);

    foreach($assignedUsers as $user) {
        $query_project_users = "INSERT INTO project_users (project_id, user_id) VALUES ($project_id,$user);";
        $wpdb->query( $query_project_users );
    }

    $wpdb->query( $query_editproject );

    $target_dir = dirname(__FILE__) . '\\file_uploads\\projects\\' . $project_id . '\\';
    if(!is_dir(!$target_dir) && !file_exists($target_dir)) {
        mkdir($target_dir);
    }

    //  PROCESO PARA SUBIR IMAGENES
    $img = $_POST['img'];

    list($type, $img) = explode(';', $img);
    list(, $img)      = explode(',', $img);
    $data = base64_decode($img);

    $path = $target_dir.'project_image'.'.jpg';

    if(file_put_contents($path, $data)) {
        echo 'uploaded';
    } else {
        echo 'fail';
    }

    wp_redirect(home_url().'/editproject/?id='.$project_id);
}

if(isset($_POST['edit-report'])){

    $report_id = $_POST['report-id'];
    $project_id = $_POST['project-id'];

    $query_editreport = "UPDATE `reports` SET report_start_date = '".$_POST['start-date']."', report_end_date = '".$_POST['end-date']."',  report_square_feet_to_date = '".$_POST['square-feet-todate']."', report_percentage_completed = '".$_POST['percentage-completed']."', report_completed = '".$_POST['completion-metal']."', report_target_completion_date = '".$_POST['target-date']."', report_field_notes='".$_POST['details-field-notes']."' WHERE report_id = '".$report_id."';";

    $wpdb->query( $query_editreport );

    $rid = $_POST['report-id'];
    $obja = $wpdb->get_results("select work_item_id from report_work_items where report_id = $rid");
    $bn = $_POST["workitems"];

    foreach ($obja as $value) {
        $an[] = $value->work_item_id;
    }

    if (is_array($an)){
        foreach($an as $key1=>$a){
            if (is_array($bn)){
                foreach($bn as $key2=>$b){
                    if($b == $a){
                        $an[$key1]=NULL;
                        $bn[$key2]=NULL;
                    }   
                }
            }
        }
    }
    if (is_array($an)){
        foreach($an as $a){
            if($a != NULL){
                $q_delete = "DELETE FROM report_work_items WHERE work_item_id=$a AND report_id=$rid;";
                $wpdb->query($q_delete);
            }
        }
    }

    $q_add = "INSERT INTO `report_work_items` (`report_id`, `work_item_id`) VALUES ";
    $cont = 0;
    if (is_array($bn)){
        foreach($bn as $b){
            if($b != NULL){
                if($cont == 0){
                    $q_add .= "($rid,$b)";
                    $cont++;
                }else{
                    $q_add .= ",($rid,$b)";
                }
            }
        }
    }

    $wpdb->query($q_add);

    if(!empty($_POST['img'])) {

        $target_dir = dirname(__FILE__) . '\\file_uploads\\reports\\' . $report_id . '\\';
        if (!is_dir($target_dir) && !file_exists($target_dir)) {
            mkdir($target_dir);
        }

        //  Delete files if they exist
        $files = glob($target_dir.'/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }

        //  PROCESO PARA SUBIR IMAGENES
        $delete_images = "DELETE FROM `project_pictures` WHERE report_id = $report_id ;";
        $wpdb->query($delete_images);
        $i = 1;
        foreach ($_POST['img'] as $key => $img) {
            list($type, $img) = explode(';', $img);
            list(, $img) = explode(',', $img);
            $data = base64_decode($img);

            $path = $target_dir . $i . '.jpg';

            if (file_put_contents($path, $data)) {
                echo 'uploaded';
            } else {
                echo 'fail';
            }

            $query_project = "INSERT INTO `project_pictures` (`report_id`, `project_picture_name`, `project_picture_description`) VALUES ('" . $report_id . "', '" . $i . "', '" . $_POST[$key] . "');";
            $wpdb->query($query_project);

            $i++;
        }
    }

    wp_redirect(home_url().'/editreport/?id='.$project_id.'&rid='.$report_id);
}

if(isset($_POST['edit-inspectionlist'])){

    $client_date = "'".date('Y-m-d H:i:s',strtotime($_POST['date']))."'";

    if(!isset($_POST['flatmembrane-select']))
        $type_roof_flat = 'NULL';
    else
        $type_roof_flat = "'".$_POST['flatmembrane-select']."'";

    if(!isset($_POST['sloped-select']))
        $type_roof_sloped = 'NULL';
    else
        $type_roof_sloped = "'".$_POST['sloped-select']."'";

    if(isset($_POST['clearaccessposition']))
        $clear_access_id = "'".$_POST['clearaccessposition']."'";
    else
        $clear_access_id='NULL';

    if(isset($_POST['slope']))
        $slope = "'".$_POST['slope']."'";
    else
        $slope='NULL';

    $signature = $_POST['signature-input'];
    if(!empty($signature)){
        $query_editclient = "UPDATE `clients` SET 
                    `client_project_owner` = '".$_POST['project-owner']."', 
                    `client_project_address` = '".$_POST['project-address']."',  
                    `client_height_at_eave` = '".$_POST['height-at-eave']."', 
                    `client_height_at_ridge` = '".$_POST['height-at-ridge']."', 
                    `clear_access_id` = $clear_access_id, 
                    `type_roof_flat_id` = $type_roof_flat, 
                    `type_roof_sloped_id`= $type_roof_sloped, 
                    `client_sloped` = $slope,
                    `client_size_of_roof` = '".$_POST['size-of-roof']."', 
                    `client_manufacturer_and_brand` = '".$_POST['manufacturer']."', 
                    `client_year_installed` = '".$_POST['year-installed']."', 
                    `client_year_manufactured` = '".$_POST['year-manufactured']."', 
                    `client_title` = '".$_POST['title']."', 
                    `client_signature` = '".$_POST['signature-input']."', 
                    `client_date` = $client_date,
                     `deleted_at` = NULL 
                WHERE `client_id` = ".$_POST['client-id'].";"; 
        $wpdb->query($query_editclient);
    } else {
        $query_editclient = "UPDATE `clients` SET 
                    `client_project_owner` = '".$_POST['project-owner']."', 
                    `client_project_address` = '".$_POST['project-address']."',  
                    `client_height_at_eave` = '".$_POST['height-at-eave']."', 
                    `client_height_at_ridge` = '".$_POST['height-at-ridge']."', 
                    `clear_access_id` = $clear_access_id, 
                    `type_roof_flat_id` = $type_roof_flat, 
                    `type_roof_sloped_id`= $type_roof_sloped, 
                    `client_sloped` = $slope,
                    `client_size_of_roof` = '".$_POST['size-of-roof']."', 
                    `client_manufacturer_and_brand` = '".$_POST['manufacturer']."', 
                    `client_year_installed` = '".$_POST['year-installed']."', 
                    `client_year_manufactured` = '".$_POST['year-manufactured']."', 
                    `client_title` = '".$_POST['title']."',
                    `client_date` = $client_date,
                     `deleted_at` = NULL 
                WHERE `client_id` = ".$_POST['client-id'].";"; 
        $wpdb->query($query_editclient);
    }

    $programmed_date = date('Y-m-d H:i:s',strtotime($_POST['date-maintenance']));

    $sketch = $_POST['sketch-input'];
    
    if(isset($_POST['null-sketch'])?"checked":""){
       $query_editinspection = "UPDATE `roof_inspections` SET roof_inspection_facility = '".$_POST['facility']."', roof_inspection_location = '".$_POST['location']."',  roof_inspection_datetime = '$programmed_date', roof_inspection_core_sample = '".$_POST['core-sample']."', roof_inspection_comment = '".$_POST['comment']."', roof_inspection_plan = NULL WHERE roof_inspection_id = '".$_POST['inspection-id']."';"; 

        $wpdb->query( $query_editinspection ); 
    } else if(!empty($sketch)){
        $query_editinspection = "UPDATE `roof_inspections` SET roof_inspection_facility = '".$_POST['facility']."', roof_inspection_location = '".$_POST['location']."',  roof_inspection_datetime = '$programmed_date', roof_inspection_core_sample = '".$_POST['core-sample']."', roof_inspection_comment = '".$_POST['comment']."', roof_inspection_plan = '".$_POST['sketch-input']."' WHERE roof_inspection_id = '".$_POST['inspection-id']."';"; 

        $wpdb->query( $query_editinspection );
    } else{
        $query_editinspection = "UPDATE `roof_inspections` SET roof_inspection_facility = '".$_POST['facility']."', roof_inspection_location = '".$_POST['location']."',  roof_inspection_datetime = '$programmed_date', roof_inspection_core_sample = '".$_POST['core-sample']."', roof_inspection_comment = '".$_POST['comment']."' WHERE roof_inspection_id = '".$_POST['inspection-id']."';"; 

        $wpdb->query( $query_editinspection ); 
    }
    

    $rid = $_POST['inspection-id'];
    $obja = $wpdb->get_results("select inspection_material_id from roof_materials where roof_inspection_id = $rid");
    $bn = $_POST["materials"];

    foreach ($obja as $value) {
        $an[] = $value->inspection_material_id;
    }

    if (is_array($an)){
        foreach($an as $key1=>$a){
            if (is_array($bn)){
                foreach($bn as $key2=>$b){
                    if($b == $a){
                        $an[$key1]=NULL;
                        $bn[$key2]=NULL;
                    }   
                }
            }
        }
    }
    if (is_array($an)){
        foreach($an as $a){
            if($a != NULL){
                $q_delete = "DELETE FROM roof_materials WHERE inspection_material_id=$a AND roof_inspection_id=$rid;";
                $wpdb->query($q_delete);
            }
        }
    }

    $q_add = "INSERT INTO `roof_materials` (`roof_inspection_id`, `inspection_material_id`) VALUES ";
    $cont = 0;
    if (is_array($bn)){
        foreach($bn as $b){
            if($b != NULL){
                if($cont == 0){
                    $q_add .= "($rid,$b)";
                    $cont++;
                }else{
                    $q_add .= ",($rid,$b)";
                }
            }
        }
    }


    $wpdb->query($q_add);


    //UPDATE DE roof_checklists
    $objactual = $wpdb->get_results("select * from roof_checklists where roof_inspection_id = $rid");
    $aux = 0;
    foreach ($objactual as $value) {
        $aid[$aux] = $value->inspection_checklist_id;
        $aproblem[$aux] = $value->roof_checklist_problem;
        $aobservation[$aux] = $value->roof_checklist_observation;
        $adate[$aux] = $value->roof_checklist_date_of_repair;
        $aux++;
    }

    $aux = 0;
    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-1']));
    $result = $_POST['status-1'];
    if($result == 0){
    }else{
        $bid[$aux] = 1;
        $bproblem[$aux] = $_POST['status-1'];
        $bobservation[$aux] = $_POST['observation-1'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-2']));
    $result = $_POST['status-2'];
    if($result == 0){
    }else{
        $bid[$aux] = 2;
        $bproblem[$aux] = $_POST['status-2'];
        $bobservation[$aux] = $_POST['observation-2'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-3']));
    $result = $_POST['status-3'];
    if($result == 0){
    }else{
        $bid[$aux] = 3;
        $bproblem[$aux] = $_POST['status-3'];
        $bobservation[$aux] = $_POST['observation-3'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-4']));
    $result = $_POST['status-4'];
    if($result == 0){
    }else{
        $bid[$aux] = 4;
        $bproblem[$aux] = $_POST['status-4'];
        $bobservation[$aux] = $_POST['observation-4'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-5']));
    $result = $_POST['status-5'];
    if($result == 0){
    }else{
        $bid[$aux] = 5;
        $bproblem[$aux] = $_POST['status-5'];
        $bobservation[$aux] = $_POST['observation-5'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-6']));
    $result = $_POST['status-6'];
    if($result == 0){
    }else{
        $bid[$aux] = 6;
        $bproblem[$aux] = $_POST['status-6'];
        $bobservation[$aux] = $_POST['observation-6'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-7']));
    $result = $_POST['status-7'];
    if($result == 0){
    }else{
        $bid[$aux] = 7;
        $bproblem[$aux] = $_POST['status-7'];
        $bobservation[$aux] = $_POST['observation-7'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-8']));
    $result = $_POST['status-8'];
    if($result == 0){
    }else{
        $bid[$aux] = 8;
        $bproblem[$aux] = $_POST['status-8'];
        $bobservation[$aux] = $_POST['observation-8'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-9']));
    $result = $_POST['status-9'];
    if($result == 0){
    }else{
        $bid[$aux] = 9;
        $bproblem[$aux] = $_POST['status-9'];
        $bobservation[$aux] = $_POST['observation-9'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-10']));
    $result = $_POST['status-10'];
    if($result == 0){
    }else{
        $bid[$aux] = 10;
        $bproblem[$aux] = $_POST['status-10'];
        $bobservation[$aux] = $_POST['observation-10'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-11']));
    $result = $_POST['status-11'];
    if($result == 0){
    }else{
        $bid[$aux] = 11;
        $bproblem[$aux] = $_POST['status-11'];
        $bobservation[$aux] = $_POST['observation-11'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-12']));
    $result = $_POST['status-12'];
    if($result == 0){
    }else{
        $bid[$aux] = 12;
        $bproblem[$aux] = $_POST['status-12'];
        $bobservation[$aux] = $_POST['observation-12'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-13']));
    $result = $_POST['status-13'];
    if($result == 0){
    }else{
        $bid[$aux] = 13;
        $bproblem[$aux] = $_POST['status-13'];
        $bobservation[$aux] = $_POST['observation-13'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-14']));
    $result = $_POST['status-14'];
    if($result == 0){
    }else{
        $bid[$aux] = 14;
        $bproblem[$aux] = $_POST['status-14'];
        $bobservation[$aux] = $_POST['observation-14'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-15']));
    $result = $_POST['status-15'];
    if($result == 0){
    }else{
        $bid[$aux] = 15;
        $bproblem[$aux] = $_POST['status-15'];
        $bobservation[$aux] = $_POST['observation-15'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-16']));
    $result = $_POST['status-16'];
    if($result == 0){
    }else{
        $bid[$aux] = 16;
        $bproblem[$aux] = $_POST['status-16'];
        $bobservation[$aux] = $_POST['observation-16'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-17']));
    $result = $_POST['status-17'];
    if($result == 0){
    }else{
        $bid[$aux] = 17;
        $bproblem[$aux] = $_POST['status-17'];
        $bobservation[$aux] = $_POST['observation-17'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-18']));
    $result = $_POST['status-18'];
    if($result == 0){
    }else{
        $bid[$aux] = 18;
        $bproblem[$aux] = $_POST['status-18'];
        $bobservation[$aux] = $_POST['observation-18'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-19']));
    $result = $_POST['status-19'];
    if($result == 0){
    }else{
        $bid[$aux] = 19;
        $bproblem[$aux] = $_POST['status-19'];
        $bobservation[$aux] = $_POST['observation-19'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-20']));
    $result = $_POST['status-20'];
    if($result == 0){
    }else{
        $bid[$aux] = 20;
        $bproblem[$aux] = $_POST['status-20'];
        $bobservation[$aux] = $_POST['observation-20'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-21']));
    $result = $_POST['status-21'];
    if($result == 0){
    }else{
        $bid[$aux] = 21;
        $bproblem[$aux] = $_POST['status-21'];
        $bobservation[$aux] = $_POST['observation-21'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-22']));
    $result = $_POST['status-22'];
    if($result == 0){
    }else{
        $bid[$aux] = 22;
        $bproblem[$aux] = $_POST['status-22'];
        $bobservation[$aux] = $_POST['observation-22'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-23']));
    $result = $_POST['status-23'];
    if($result == 0){
    }else{
        $bid[$aux] = 23;
        $bproblem[$aux] = $_POST['status-23'];
        $bobservation[$aux] = $_POST['observation-23'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-24']));
    $result = $_POST['status-24'];
    if($result == 0){
    }else{
        $bid[$aux] = 24;
        $bproblem[$aux] = $_POST['status-24'];
        $bobservation[$aux] = $_POST['observation-24'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-25']));
    $result = $_POST['status-25'];
    if($result == 0){
    }else{
        $bid[$aux] = 25;
        $bproblem[$aux] = $_POST['status-25'];
        $bobservation[$aux] = $_POST['observation-25'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-26']));
    $result = $_POST['status-26'];
    if($result == 0){
    }else{
        $bid[$aux] = 26;
        $bproblem[$aux] = $_POST['status-26'];
        $bobservation[$aux] = $_POST['observation-26'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-27']));
    $result = $_POST['status-27'];
    if($result == 0){
    }else{
        $bid[$aux] = 27;
        $bproblem[$aux] = $_POST['status-27'];
        $bobservation[$aux] = $_POST['observation-27'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-28']));
    $result = $_POST['status-28'];
    if($result == 0){
    }else{
        $bid[$aux] = 28;
        $bproblem[$aux] = $_POST['status-28'];
        $bobservation[$aux] = $_POST['observation-28'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-29']));
    $result = $_POST['status-29'];
    if($result == 0){
    }else{
        $bid[$aux] = 29;
        $bproblem[$aux] = $_POST['status-29'];
        $bobservation[$aux] = $_POST['observation-29'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-30']));
    $result = $_POST['status-30'];
    if($result == 0){
    }else{
        $bid[$aux] = 30;
        $bproblem[$aux] = $_POST['status-30'];
        $bobservation[$aux] = $_POST['observation-30'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-31']));
    $result = $_POST['status-31'];
    if($result == 0){
    }else{
        $bid[$aux] = 31;
        $bproblem[$aux] = $_POST['status-31'];
        $bobservation[$aux] = $_POST['observation-31'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-32']));
    $result = $_POST['status-32'];
    if($result == 0){
    }else{
        $bid[$aux] = 32;
        $bproblem[$aux] = $_POST['status-32'];
        $bobservation[$aux] = $_POST['observation-32'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-33']));
    $result = $_POST['status-33'];
    if($result == 0){
    }else{
        $bid[$aux] = 33;
        $bproblem[$aux] = $_POST['status-33'];
        $bobservation[$aux] = $_POST['observation-33'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-34']));
    $result = $_POST['status-34'];
    if($result == 0){
    }else{
        $bid[$aux] = 34;
        $bproblem[$aux] = $_POST['status-34'];
        $bobservation[$aux] = $_POST['observation-34'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-35']));
    $result = $_POST['status-35'];
    if($result == 0){
    }else{
        $bid[$aux] = 35;
        $bproblem[$aux] = $_POST['status-35'];
        $bobservation[$aux] = $_POST['observation-35'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-36']));
    $result = $_POST['status-36'];
    if($result == 0){
    }else{
        $bid[$aux] = 36;
        $bproblem[$aux] = $_POST['status-36'];
        $bobservation[$aux] = $_POST['observation-36'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-37']));
    $result = $_POST['status-37'];
    if($result == 0){
    }else{
        $bid[$aux] = 37;
        $bproblem[$aux] = $_POST['status-37'];
        $bobservation[$aux] = $_POST['observation-37'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-38']));
    $result = $_POST['status-38'];
    if($result == 0){
    }else{
        $bid[$aux] = 38;
        $bproblem[$aux] = $_POST['status-38'];
        $bobservation[$aux] = $_POST['observation-38'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-39']));
    $result = $_POST['status-39'];
    if($result == 0){
    }else{
        $bid[$aux] = 39;
        $bproblem[$aux] = $_POST['status-39'];
        $bobservation[$aux] = $_POST['observation-39'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-40']));
    $result = $_POST['status-40'];
    if($result == 0){
    }else{
        $bid[$aux] = 40;
        $bproblem[$aux] = $_POST['status-40'];
        $bobservation[$aux] = $_POST['observation-40'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-41']));
    $result = $_POST['status-41'];
    if($result == 0){
    }else{
        $bid[$aux] = 41;
        $bproblem[$aux] = $_POST['status-41'];
        $bobservation[$aux] = $_POST['observation-41'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-42']));
    $result = $_POST['status-42'];
    if($result == 0){
    }else{
        $bid[$aux] = 42;
        $bproblem[$aux] = $_POST['status-42'];
        $bobservation[$aux] = $_POST['observation-42'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-43']));
    $result = $_POST['status-43'];
    if($result == 0){
    }else{
        $bid[$aux] = 43;
        $bproblem[$aux] = $_POST['status-43'];
        $bobservation[$aux] = $_POST['observation-43'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-44']));
    $result = $_POST['status-44'];
    if($result == 0){
    }else{
        $bid[$aux] = 44;
        $bproblem[$aux] = $_POST['status-44'];
        $bobservation[$aux] = $_POST['observation-44'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-45']));
    $result = $_POST['status-45'];
    if($result == 0){
    }else{
        $bid[$aux] = 45;
        $bproblem[$aux] = $_POST['status-45'];
        $bobservation[$aux] = $_POST['observation-45'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-46']));
    $result = $_POST['status-46'];
    if($result == 0){
    }else{
        $bid[$aux] = 46;
        $bproblem[$aux] = $_POST['status-46'];
        $bobservation[$aux] = $_POST['observation-46'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-47']));
    $result = $_POST['status-47'];
    if($result == 0){
    }else{
        $bid[$aux] = 47;
        $bproblem[$aux] = $_POST['status-47'];
        $bobservation[$aux] = $_POST['observation-47'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-48']));
    $result = $_POST['status-48'];
    if($result == 0){
    }else{
        $bid[$aux] = 48;
        $bproblem[$aux] = $_POST['status-48'];
        $bobservation[$aux] = $_POST['observation-48'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-49']));
    $result = $_POST['status-49'];
    if($result == 0){
    }else{
        $bid[$aux] = 49;
        $bproblem[$aux] = $_POST['status-49'];
        $bobservation[$aux] = $_POST['observation-49'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-50']));
    $result = $_POST['status-50'];
    if($result == 0){
    }else{
        $bid[$aux] = 50;
        $bproblem[$aux] = $_POST['status-50'];
        $bobservation[$aux] = $_POST['observation-50'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-51']));
    $result = $_POST['status-51'];
    if($result == 0){
    }else{
        $bid[$aux] = 51;
        $bproblem[$aux] = $_POST['status-51'];
        $bobservation[$aux] = $_POST['observation-51'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-52']));
    $result = $_POST['status-52'];
    if($result == 0){
    }else{
        $bid[$aux] = 52;
        $bproblem[$aux] = $_POST['status-52'];
        $bobservation[$aux] = $_POST['observation-52'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-53']));
    $result = $_POST['status-53'];
    if($result == 0){
    }else{
        $bid[$aux] = 53;
        $bproblem[$aux] = $_POST['status-53'];
        $bobservation[$aux] = $_POST['observation-53'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-54']));
    $result = $_POST['status-54'];
    if($result == 0){
    }else{
        $bid[$aux] = 54;
        $bproblem[$aux] = $_POST['status-54'];
        $bobservation[$aux] = $_POST['observation-54'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-55']));
    $result = $_POST['status-55'];
    if($result == 0){
    }else{
        $bid[$aux] = 55;
        $bproblem[$aux] = $_POST['status-55'];
        $bobservation[$aux] = $_POST['observation-55'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-56']));
    $result = $_POST['status-56'];
    if($result == 0){
    }else{
        $bid[$aux] = 56;
        $bproblem[$aux] = $_POST['status-56'];
        $bobservation[$aux] = $_POST['observation-56'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-57']));
    $result = $_POST['status-57'];
    if($result == 0){
    }else{
        $bid[$aux] = 57;
        $bproblem[$aux] = $_POST['status-57'];
        $bobservation[$aux] = $_POST['observation-57'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-58']));
    $result = $_POST['status-58'];
    if($result == 0){
    }else{
        $bid[$aux] = 58;
        $bproblem[$aux] = $_POST['status-58'];
        $bobservation[$aux] = $_POST['observation-58'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-59']));
    $result = $_POST['status-59'];
    if($result == 0){
    }else{
        $bid[$aux] = 59;
        $bproblem[$aux] = $_POST['status-59'];
        $bobservation[$aux] = $_POST['observation-59'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-60']));
    $result = $_POST['status-60'];
    if($result == 0){
    }else{
        $bid[$aux] = 60;
        $bproblem[$aux] = $_POST['status-60'];
        $bobservation[$aux] = $_POST['observation-60'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-61']));
    $result = $_POST['status-61'];
    if($result == 0){
    }else{
        $bid[$aux] = 61;
        $bproblem[$aux] = $_POST['status-61'];
        $bobservation[$aux] = $_POST['observation-61'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-62']));
    $result = $_POST['status-62'];
    if($result == 0){
    }else{
        $bid[$aux] = 62;
        $bproblem[$aux] = $_POST['status-62'];
        $bobservation[$aux] = $_POST['observation-62'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-63']));
    $result = $_POST['status-63'];
    if($result == 0){
    }else{
        $bid[$aux] = 63;
        $bproblem[$aux] = $_POST['status-63'];
        $bobservation[$aux] = $_POST['observation-63'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-64']));
    $result = $_POST['status-64'];
    if($result == 0){
    }else{
        $bid[$aux] = 64;
        $bproblem[$aux] = $_POST['status-64'];
        $bobservation[$aux] = $_POST['observation-64'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-65']));
    $result = $_POST['status-65'];
    if($result == 0){
    }else{
        $bid[$aux] = 65;
        $bproblem[$aux] = $_POST['status-65'];
        $bobservation[$aux] = $_POST['observation-65'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-66']));
    $result = $_POST['status-66'];
    if($result == 0){
    }else{
        $bid[$aux] = 66;
        $bproblem[$aux] = $_POST['status-66'];
        $bobservation[$aux] = $_POST['observation-66'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-67']));
    $result = $_POST['status-67'];
    if($result == 0){
    }else{
        $bid[$aux] = 67;
        $bproblem[$aux] = $_POST['status-67'];
        $bobservation[$aux] = $_POST['observation-67'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-68']));
    $result = $_POST['status-68'];
    if($result == 0){
    }else{
        $bid[$aux] = 68;
        $bproblem[$aux] = $_POST['status-68'];
        $bobservation[$aux] = $_POST['observation-68'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-69']));
    $result = $_POST['status-69'];
    if($result == 0){
    }else{
        $bid[$aux] = 69;
        $bproblem[$aux] = $_POST['status-69'];
        $bobservation[$aux] = $_POST['observation-69'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-70']));
    $result = $_POST['status-70'];
    if($result == 0){
    }else{
        $bid[$aux] = 70;
        $bproblem[$aux] = $_POST['status-70'];
        $bobservation[$aux] = $_POST['observation-70'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-71']));
    $result = $_POST['status-71'];
    if($result == 0){
    }else{
        $bid[$aux] = 71;
        $bproblem[$aux] = $_POST['status-71'];
        $bobservation[$aux] = $_POST['observation-71'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-72']));
    $result = $_POST['status-72'];
    if($result == 0){
    }else{
        $bid[$aux] = 72;
        $bproblem[$aux] = $_POST['status-72'];
        $bobservation[$aux] = $_POST['observation-72'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-73']));
    $result = $_POST['status-73'];
    if($result == 0){
    }else{
        $bid[$aux] = 73;
        $bproblem[$aux] = $_POST['status-73'];
        $bobservation[$aux] = $_POST['observation-73'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-74']));
    $result = $_POST['status-74'];
    if($result == 0){
    }else{
        $bid[$aux] = 74;
        $bproblem[$aux] = $_POST['status-74'];
        $bobservation[$aux] = $_POST['observation-74'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-75']));
    $result = $_POST['status-75'];
    if($result == 0){
    }else{
        $bid[$aux] = 75;
        $bproblem[$aux] = $_POST['status-75'];
        $bobservation[$aux] = $_POST['observation-75'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-76']));
    $result = $_POST['status-76'];
    if($result == 0){
    }else{
        $bid[$aux] = 76;
        $bproblem[$aux] = $_POST['status-76'];
        $bobservation[$aux] = $_POST['observation-76'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-77']));
    $result = $_POST['status-77'];
    if($result == 0){
    }else{
        $bid[$aux] = 77;
        $bproblem[$aux] = $_POST['status-77'];
        $bobservation[$aux] = $_POST['observation-77'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-78']));
    $result = $_POST['status-78'];
    if($result == 0){
    }else{
        $bid[$aux] = 78;
        $bproblem[$aux] = $_POST['status-78'];
        $bobservation[$aux] = $_POST['observation-78'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-79']));
    $result = $_POST['status-79'];
    if($result == 0){
    }else{
        $bid[$aux] = 79;
        $bproblem[$aux] = $_POST['status-79'];
        $bobservation[$aux] = $_POST['observation-79'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-80']));
    $result = $_POST['status-80'];
    if($result == 0){
    }else{
        $bid[$aux] = 80;
        $bproblem[$aux] = $_POST['status-80'];
        $bobservation[$aux] = $_POST['observation-80'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-81']));
    $result = $_POST['status-81'];
    if($result == 0){
    }else{
        $bid[$aux] = 81;
        $bproblem[$aux] = $_POST['status-81'];
        $bobservation[$aux] = $_POST['observation-81'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-82']));
    $result = $_POST['status-82'];
    if($result == 0){
    }else{
        $bid[$aux] = 82;
        $bproblem[$aux] = $_POST['status-82'];
        $bobservation[$aux] = $_POST['observation-82'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-83']));
    $result = $_POST['status-83'];
    if($result == 0){
    }else{
        $bid[$aux] = 83;
        $bproblem[$aux] = $_POST['status-83'];
        $bobservation[$aux] = $_POST['observation-83'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-84']));
    $result = $_POST['status-84'];
    if($result == 0){
    }else{
        $bid[$aux] = 84;
        $bproblem[$aux] = $_POST['status-84'];
        $bobservation[$aux] = $_POST['observation-84'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-85']));
    $result = $_POST['status-85'];
    if($result == 0){
    }else{
        $bid[$aux] = 85;
        $bproblem[$aux] = $_POST['status-85'];
        $bobservation[$aux] = $_POST['observation-85'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-86']));
    $result = $_POST['status-86'];
    if($result == 0){
    }else{
        $bid[$aux] = 86;
        $bproblem[$aux] = $_POST['status-86'];
        $bobservation[$aux] = $_POST['observation-86'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-87']));
    $result = $_POST['status-87'];
    if($result == 0){
    }else{
        $bid[$aux] = 87;
        $bproblem[$aux] = $_POST['status-87'];
        $bobservation[$aux] = $_POST['observation-87'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-88']));
    $result = $_POST['status-88'];
    if($result == 0){
    }else{
        $bid[$aux] = 88;
        $bproblem[$aux] = $_POST['status-88'];
        $bobservation[$aux] = $_POST['observation-88'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-89']));
    $result = $_POST['status-89'];
    if($result == 0){
    }else{
        $bid[$aux] = 89;
        $bproblem[$aux] = $_POST['status-89'];
        $bobservation[$aux] = $_POST['observation-89'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $checklist_date = date('Y-m-d',strtotime($_POST['daterepair-90']));
    $result = $_POST['status-90'];
    if($result == 0){
    }else{
        $bid[$aux] = 90;
        $bproblem[$aux] = $_POST['status-90'];
        $bobservation[$aux] = $_POST['observation-90'];
        $bdate[$aux] = $checklist_date;
        $aux++;
    }

    $check = array_fill(1, 90, 2);

    if (is_array($aid)){
        foreach($aid as $key1=>$a){
            if (is_array($bid)){
                foreach($bid as $key2=>$b){
                    if($b == $a){
                        $check[$a] = 1;
                        if(($aproblem[$key1] == $bproblem[$key2]) && ($aobservation[$key1]==$bobservation[$key2]) && ($adate[$key1]==$bdate[$key2]))
                            $check[$a] = 0;
                    }   
                }
            }
        }
    }

    if (is_array($aid)){
        foreach($aid as $key1=>$a){
            if($check[$a] == 2){
                $q_deleteold = "DELETE FROM roof_checklists WHERE inspection_checklist_id=$a AND roof_inspection_id=$rid;";
                $wpdb->query($q_deleteold);
            }
        }
    }

    $q_addnew = "INSERT INTO `roof_checklists` (`roof_inspection_id`, `inspection_checklist_id`, `roof_checklist_problem`, `roof_checklist_observation`, `roof_checklist_date_of_repair`) VALUES ";
    $cont = 0;
    if (is_array($bid)){
        foreach($bid as $key2=>$b){
            if($check[$b] == 2){
                if($cont == 0){
                    $q_addnew .= "('$rid','$b','$bproblem[$key2]','$bobservation[$key2]','$bdate[$key2]')";
                    $cont++;
                }else{
                    $q_addnew .= ",('$rid','$b','$bproblem[$key2]','$bobservation[$key2]','$bdate[$key2]')";
                }
            }else if($check[$b] == 1){
                $q_updateit = "UPDATE `roof_checklists` SET roof_checklist_problem = '$bproblem[$key2]', roof_checklist_observation = '$bobservation[$key2]', roof_checklist_date_of_repair = '$bdate[$key2]' WHERE roof_inspection_id = '$rid' AND inspection_checklist_id = '$b';";
                $wpdb->query($q_updateit);
            }
        }
    }
    $q_addnew .= ";";
    $wpdb->query($q_addnew);


}

// SOFT DELETE DE PROJECTS

if(isset($_POST['delete-project'])){

    $q_deleteproject = "UPDATE `projects` SET deleted_at = CURRENT_TIMESTAMP WHERE project_id = '".$_POST['delete-project']."' ;";

    $wpdb->query($q_deleteproject);

    wp_redirect(home_url().'/projects');
}

//return print_r($_POST);