<?php $page = 'editreport'; ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url').'/'; ?>style.css">
	<style>
		/* PDF STYLES */
		.pdf-page {
			width: 21cm;
			height: 29.7cm;
			font-family: Lato, sans-serif;
		}

		.table-container div[class*=col-] {
			padding: 0;
		}

		.pdf-page table {
			width: 100%;
			border-collapse: collapse;
		}

		.pdf-page tr {
			border: 1px solid #1a1a1a;
			width: 100%;
		}

		.pdf-page th, .pdf-page td {
		}

		.pdf-page .black {
			background-color: #1a1a1a!important;
			color: #fff;
		}

		.pdf-page .red {
			background-color: #ff2d2d!important;
			color: #fff;
			border: 1px solid #1a1a1a;
		}

		.pdf-page .img-table tr {
			border: 0;
		}

		.pdf-page .img-table td {
			padding: 5px;
		}

		.pdf-page .img-table img {
			padding: 30px 0;
			width: 100%;
		}

		.pdf-page .text-divider {
			padding: 15px 0;
		}

		.pdf-page .bold {
			font-weight: bold;
		}
	</style>
	<title>REPORT PDF</title>
</head>
<body style="-webkit-print-color-adjust:exact;">
<?php

$id = $_GET['id'];
$rid = $_GET['rid'];
$project = $wpdb->get_results("select * from projects where project_id = $id");
$report = $wpdb->get_results("select * from reports where report_id = $rid");
$report = $report[0];

$user_id = $report->user_id;

if(get_user_meta($user_name, 'first_name',true) != null) {
	$user_name = get_user_meta($user_id, 'first_name',true).' '.get_user_meta($user_id, 'last_name',true);
} else {
	$user_name =  get_user_by('id', $user_id)->user_login;
}

?>
<div class="pdf-page">
	<table>
		<thead>
		<tr>
			<th class="black">
				Project Details
			</th>
		</tr>
		</thead>
	</table>
	<!--<div class="table-row">
		Client:
	</div>-->
	<table>
		<tbody>
		<colgroup>
			<col style="width: 58.33%;">
			<col style="width: 41.67%;">
		</colgroup>
		<tr>
			<td style="vertical-align: top">
				<table>
					<tbody>
					<tr>
						<td>Project: <text class="project-name"><?php echo $project[0]->project_name ?></text></td>
					</tr>
					<tr>
						<td>Address: <text class="project-name"><?php  echo $project[0]->project_address ?></text></td>
					</tr>
					<tr>
						<td>Total Project Area: <text class="project-name"><?php echo $project[0]->project_area ?></text></td>
					</tr>
					<tr>
						<td>Contracto: CIM Roofing</td>
					</tr>
					</tbody>
					<tr>
						<td class="black">
							Progress Report Details
						</td>
					</tr>
					<tr>
						<td>Reporting Period: <?php echo $report->report_start_date; ?> to <?php echo $report->report_end_date; ?></td>
					</tr>
					<tr>
						<td>Roof Area: <?php echo $report->report_square_feet_to_date; ?></td>
					</tr>
					<tr>
						<td>Percentage Complete: <?php echo $report->report_percentage_completed; ?></td>
					</tr>
					<tr>
						<td>Report Submission Date: <?php echo $report->created_at; ?></td>
					</tr>
					<tr>
						<td>Report Submitted By: <?php echo $user_name; ?></td>
					</tr>
					<tr>
						<td>Target Completion Date: <?php echo $report->report_target_completion_date; ?></td>
					</tr>
				</table>
			</td>
			<td style="text-align: center;">
				<img src="<?php echo bloginfo('template_url').'/'; ?>img/content/project-img-example.png" alt="imagen proyecto" class="project-img">
			</td>
		</tr>
		</tbody>
	</table>
	<div class="text-divider bold">
		The summary below provides details related to the work completed by the contractor during the reporting period.
	</div>
	<table>
		<thead>
		<tr>
			<th class="red">
				Work Completed
			</th>
		</tr>
		</thead>
	</table>
	<div class="text-divider bold">
		Notes
	</div>
	<div class="notes">
		<?php echo $report->report_field_notes; ?>
	</div>
</div>


<?php
$directory = dirname(__FILE__) . '\\file_uploads\\' . $_GET['id'] . '\\';
$images = glob($directory.'*.jpg');
$arraySize = count($images);
$counter = 0;

foreach($images as $image) {
	if($counter == 0 || $counter%6 == 0) {
		echo '<div class="pdf-page">
				<table class="img-table">
					<colgroup>
						<col style="width: 50%;">
						<col style="width: 50%;">
					</colgroup>
					<thead>
					<tr>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>';
	}
	if($counter == 0 || $counter%2 == 0) {
		echo '<tr>';
	}
	?>
	<td>
		<?php
		echo '<img src="'.get_bloginfo('template_url').'/file_uploads/'.$_GET['id'].'/'.basename($image).'" class="center-block">';
		?>
	</td>
	<?php
	$counter++;
	if($counter%2 == 0 || $counter == $arraySize) {
		echo '</tr>';
	}
	if($counter%6 == 0 || $counter == $arraySize) {
		echo '</tbody>
			</table>
		</div>';
	}
}
?>
</body>
</html>