<?php 
// this page will be used to store all basic functions
function mysql_prep($value){
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists("mysql_real_escape_string");//i.e. PHP >= v4.3.0
	if($new_enough_php){ //PHP v4.3.0 or higher
		//undo any magic quote effects so mysql_real_escape_string can do the work
		if($magic_quotes_active){
			$value = stripslashes($value);
		}
	}else{// before PHP v4.3.0
		// if magic quotes aren't already on then add slashes manually
			if(!$magic_quotes_active){
				$value = addslashes($value); }
			//if magic quotes are active, then the slashes already exist
		}
	 return $value;
	}

function redirect_to($location = NULL){
		if( $location !=NULL){
			header("Location: {$location} ");
			exit;
			}
	}

function confirm_query($result_set){
	if(!$result_set){
		die("Database connection failed: ". mysql_error());
		}
	}
	
function get_all_subjects($public = true){
	global $connection;
	$query = "SELECT *
		 	  FROM subjects ";
	if($public){
		$query .= " WHERE visible = 1 ";
		}
	$query .= "ORDER BY position ASC";
	$subject_set = $mysqli->query($query) or die($mysqli->error);
	return $subject_set;
	}
	
function get_all_pages(){
	global $connection;
	$query = "SELECT *
		 	  FROM pages
			  ORDER BY position ASC";
	$page_set = $mysqli->query($query) or die($mysqli->error);
	return $page_set;
	}
	
function get_pages_for_subjects($subject_id, $public = true){
	global $connection;
	$query2 = "SELECT * 
			   FROM pages ";
	$query2 .= " WHERE subject_id = {$subject_id} ";
	if($public){ 
		$query2 .= " AND visible = 1 ";
		}
	$query2 .= " ORDER BY position ASC";
	$page_set = $mysqli->query($query2) or die($mysqli->error);
	confirm_query($page_set);
	return $page_set;		   
	}

function get_page_for_subject($subject_id){
	global $connection;
	$query2 = "SELECT * 
			   FROM pages 
			   WHERE subject_id = {$subject_id}";
	$page_set = $mysqli->query($query2) or die($mysqli->error);
	confirm_query($page_set);
	return $page_set;		   
	}
	
function get_subject_by_id($subject_id){
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE id= '{$subject_id}' ";
	$query .= " LIMIT 1";
	$result_set = $mysqli->query($query) or die($mysqli->error);
	confirm_query($result_set);
	/* REMEMBER:
	if no row is returned, fetch_array will return false
	*/
	if($subject = mysql_fetch_array($result_set)){
		return $subject;
		}
	else{
		return NULL;
		}
	}
	
function get_page_by_id($page_id){
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE id= '{$page_id}' ";
	$query .= " LIMIT 1";
	$result_set = $mysqli->query($query) or die($mysqli->error);
	confirm_query($result_set);
	/* REMEMBER:
	if no row is returned, fetch_array will return false
	*/
	if($page = mysql_fetch_array($result_set)){
		return $page;
		}
	else{
		return NULL;
		}
	}
	
function get_default_page($subject_id){
	//Get all visible pages
	$page_set = get_pages_for_subjects($subject_id, true);
	if($first_page = mysql_fetch_array($page_set)){
		/*print_r($first_page);
		echo "<br />"; */
		return $first_page;
		}else{
			return NULL;
			}
	}	
	
function find_selected_page(){
	global $sel_page;
	global $sel_subj;
	global $select_page;	
	global $sel_subject;	
	if(isset($_GET['subj'])){
			$sel_subj = $_GET['subj'];
			$sel_subject  = get_subject_by_id($sel_subj);
			$sel_page = get_default_page($sel_subject['id']);
			$select_page = $sel_page;
			//print_r($sel_page);
			}
	elseif(isset($_GET['page'])){
			$sel_subj = "";
			$sel_page = $_GET['page'];
			$select_page = get_page_by_id($sel_page);
			}
	else{
				$sel_page = "";
				$sel_subj = "";
				}	
}

function navigation( $sel_subject, $select_page,$sel_subj, $sel_page, $public = false){
	echo "<ul class= \"subjects\">";
	//Perform Database Query on subjects
	$subject_set = get_all_subjects($public);
	//exception handling if subject_set was not retrieved from database
	confirm_query($subject_set);	
	//Use returned data from subjects
	while ($subject = mysql_fetch_array($subject_set)){
					echo "<li";
						if($subject["id"] == $sel_subj){
							echo " class = \"selected\" ";
							}
						
						echo "><a href = \"edit_subject.php?subj=" .urlencode($subject["id"]). "\"> {$subject['menu_name']}</a>
					</li>";
					
					//Perform Database Query on pages database
					
					$page_set = get_pages_for_subjects($subject['id'],$public);
			
					echo '<ul class = "pages">';	
					//Use returned data from pages
					while ($page = mysql_fetch_array($page_set)){
						echo "<li";
						if($page["id"] == $sel_page){
							echo " class = \"selected\" ";
							}
						
						echo "><a href = \"content.php?page=". urlencode($page["id"]) .  "\">{$page['menu_name']}</a></li>";
					}
					echo"</ul>";
				}
			
            echo"</ul>";
	
	}

function public_navigation($sel_subject, $select_page,$sel_subj, $sel_page, $public = true){
	echo "<ul class= \"subjects\">";
	//Perform Database Query on subjects
	$subject_set = get_all_subjects($public);
	//exception handling if subject_set was not retrieved from database
	confirm_query($subject_set);	
	//Use returned data from subjects
	while ($subject = mysql_fetch_array($subject_set)){
					echo "<li";
						if($subject["id"] == $sel_subj){
							echo " class = \"selected\" ";
							}
						
						echo "><a href = \"index.php?subj=" .urlencode($subject["id"]). "\"> {$subject['menu_name']}</a>
					</li>";
					
					//Perform Database Query on pages database
					if($subject["id"] == $sel_subj){
						$page_set = get_pages_for_subjects($subject['id'], $public);
				
						echo '<ul class = "pages">';	
						//Use returned data from pages
						while ($page = mysql_fetch_array($page_set)){
							echo "<li";
							if($page["id"] == $sel_page){
								echo " class = \"selected\" ";
								}
							
							echo "><a href = \"index.php?page=". urlencode($page["id"]) .  "\">{$page['menu_name']}</a></li>";
						}
						echo"</ul>";
						}
				}
			
            echo"</ul>";
	}
	
function get_pages_for_subject($sel_subj){
		$subject_set = get_all_subjects();
		echo '<ul>';
		while($subject = mysql_fetch_array($subject_set)){
						//echo '<li>';
						if($subject["id"] == $sel_subj)
						{
							$page_set = get_pages_for_subjects($subject['id']);
								while($page = mysql_fetch_array($page_set))
								{
									if(isset($page_set))
									{
										//$page = mysql_fetch_array($page_set);	
										$pagename = "{$page['menu_name']}";
									} 
									echo '<li><a href ="content.php?page="'.urlencode($page["id"]).'">'.$pagename.'<br /></a></li>';
								
								}
						}
						
		 }
		echo '</ul>';
		}
		
function get_content_for_pages($sel_subj){
		$subject_set = get_all_subjects();
		echo '<ul>';
		while($subject = mysql_fetch_array($subject_set)){
						if($subject["id"] == $sel_subj){
							$page_set = get_pages_for_subjects($subject['id']);
							while($page = mysql_fetch_array($page_set)){
								if(isset($page_set)){
								$pagecontent = "{$page['content']}";
								} echo '<li><a href ="content.php?page="'.urlencode($page["id"]).'">'. $pagecontent .'<br /></a></li>';
								
							}
						}
						
		 }
		echo '</ul>';
		}	

function check_required_fields($required_fields){
	$field_errors = array();
	foreach($required_fields as $fieldname){
			if(!isset($_POST[$fieldname]) || (!isset($_POST[$fieldname]) && !is_int($_POST[$fieldname])))   {
				$field_errors[] = $fieldname;
				}
	}
	return $field_errors;
}

function check_max_field_lengths($field_length_array){
	$field_errors = array();
	foreach($field_length_array as $fieldname => $maxlength ){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$field_errors[] = $fieldname;
			}
		}
		return $field_errors;
	}
	
function display_errors($error_array){
	echo "<p class = 'errors'>";
	echo "Please review the following fields:<br />";
	foreach($error_array as $error){
		echo "-" . $error . "<br />";
		}
	echo "</p>";
	}


?>