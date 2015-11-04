<?php

	$debug = 1;
	define("HOST", "mysql1.000webhost.com");
	define("DBNAME", "a8773318_acebedo");
	define("DBUSER", "a8773318_acebedo");
	define("PWD", "Dublin2013");

	$dbc=0;
	$dbc = mysqli_connect(HOST, DBUSER, PWD, DBNAME)
	   		or die ('Cannot connect to database');
	define("SITE_ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
	define("USER_UPLOAD_DIR", "uploads/");
	define("MAX_UPLOAD_SIZE", 50*1000);

	$output_form = 1; 
	$error_text = "";
	$correct_image_type = false;
	$file_upload_size = false;

	$photo_types = array("image/png", "image/jpg", "image/jpeg", "image/gif");

	$fname = "";
	$lname = "";
	$user_file = "";

	if (isset($_POST['submit'])) {  // Check data is set for display
	   
	  $fname = trim($_POST['fname']);	// first name input  
      $lname = trim($_POST['lname']);	// last name input
      $user_file = $_FILES['filename']['name'];	// image file name
      $file_type = $_FILES['filename']['type']; // image file type
	  $file_size = $_FILES['filename']['size']; // image file size
	  $file_tmp_name = $_FILES['filename']['tmp_name'];	// temporary folder locaton
	  $upload_error = $_FILES['userphoto']['error']; // upload error
      $target_file = USER_UPLOAD_DIR.$user_file;

	  	if ($file_size ==0 || $file_size > MAX_UPLOAD_SIZE) {  // file doesn't meet criteria
		   
		   $file_upload_size = false;
		   $error_text .="<p>UPLOAD ERROR: Uploaded size is : $file_size <br> Select an images less than 50 kb</p>";  
		   			
		} else { $file_upload_size = true; }
		
		
		if (!in_array($file_type, $photo_types)) {
	
			$correct_image_type = false;
			$error_text .="<p>Images must be  .png, .jpg, .jpeg, or .png</p>";
			
		}  	// End if in_array
		else { $correct_image_type = true; }
		
	  // Check field and proper file upload information
	   
      	if (empty($_POST['fname'])) {
      
         $output_form = 1; // Missing first name field
         $error_text .="<p> Please enter first name.</p>";  
        
      	} if (empty($_POST['lname'])) {
         $output_form = 1; // Missing last name field
         $error_text .="<p> Please enter last name.</p>";

      	} if ( $upload_error != 0 || !$file_upload_size || !$correct_image_type) {
         $output_form = 1; // Missing upload file
         $error_text .="<p> Please select an image file.</p>";

      	} if (file_exists($target_file) AND (!$file_size ==0)) {
 		 $output_form = 1; // File exist in the server
 		 $error_text .="<p> ERROR: The selected file - $user_file exist in the upload server.</p>";

	  	} if (!empty($_POST['fname']) AND (!empty($_POST['lname'])) AND (!file_exists($target_file)))  	{
		$output_form = 0;	// proceed with upload file.
		move_uploaded_file($_FILES['filename']['tmp_name'], $target_file)
			or die("file move failed");
		} // End else  

	} // End If ISSET

?>

<!DOCTYPE html>
<html>

   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link rel="stylesheet" type="text/css" href="./style.css" />
      <title>Assignment-4</title>
   </head>

	<body>
	<div id="main">

<?php      
      if ($output_form) {
?>       

	      <h2>Assignment 4</h2>

         <form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
			<?=$error_text ?>
            <table>
                <tr>
                   <td>First Name:</td>
                   <td>
                      <input name="fname" type="text" value="<?=$fname ?>"/>
                   </td>
                </tr>
                <tr>
                   <td>Last Name:</td>
                   <td>
                      <input name="lname" type="text" value="<?=$lname ?>"/>
                   </td>
                </tr>
                <tr>
                   <td>User Photo (50kb limit): <br> .png, .jpg, .jpeg, .gif only</td>
                   <td>
                      <input name="filename" type="file" />
                   </td>
                </tr>
            </table>
		  
            <input name="submit" type="submit"/>  <!-- Submit address  -->
		</form>
<?php  
         } else {
   
?>
		    
            <!--   Output     -->
            <p>  
               Name: <?=$fname.' '.$lname ?><br><br>           <!-- First and Last Names concatenated    -->     
               Photo:<br> <img src="<?= USER_UPLOAD_DIR.$user_file ?>" />
            </p>     
<?php
        }  // End of IF/ELSE
		// Closing Database
        mysqli_close($dbc);
?>
              
   </body>
</html>