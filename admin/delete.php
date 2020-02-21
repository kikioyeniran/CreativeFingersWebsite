<?php require_once("includes/sessions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

if (isset($_GET['picid'])) {
	$id = mysql_prep($_GET['picid']);
	if ($id) {
		$stmt = $mysqli->prepare("DELETE FROM pictures WHERE id = ? LIMIT 1");
		$stmt->bind_param("i", $id);
		if ($stmt->execute()) {
			redirect_to("pictures.php");
		} else {
			//Deletion Failed
			echo "<script>alert(\"Image deleted from database\")<script>";
		}
	} else {
		//subject didn't exist in  database
		redirect_to("pictures.php");
	}
}
if (isset($_GET['prof'])) {
	$id = mysql_prep($_GET['prof']);
	if ($id) {
		$stmt = $mysqli->prepare("DELETE FROM profiles WHERE id = ? LIMIT 1");
		$stmt->bind_param("i", $id);
		if ($stmt->execute()) {
			redirect_to("profiles.php");
		} else {
			//Deletion Failed
			echo "<script>alert(\"Image deleted from database\")<script>";
		}
	} else {
		//subject didn't exist in  database
		redirect_to("profiles.php");
	}
}

?>