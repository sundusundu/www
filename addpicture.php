<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>

<!DOCTYPE html>
<head>
  <title>esVerta - Add Picture</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h3>esVerta - Add Picture</h3>

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p>Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
  else {
    echo('<p>You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
  }

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $title = $_POST['title'];
    $author = $_POST['author'];
    $paintdate = $_POST['paintdate'];
    $discribe = $_POST['discribe'];
    $comment = $_POST['comment'];
    $new_picture = $_FILES['new_picture']['name'];
    $new_picture_type = $_FILES['new_picture']['type'];
    $new_picture_size = $_FILES['new_picture']['size']; 
    list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);
    $error = false;
	
	// Grab the oldpicture data from the database
    $query = "SELECT picture FROM esverta_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);

    if ($row != NULL) {
      $old_picture = $row['picture'];
    }
    else {
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }
	if($picture == null or $picture == ""){$picture = $new_picture;}
	else{
	$picture = $old_picture.'/'.$new_picture;}
	
	

    // Validate and move the uploaded picture file, if necessary
    if (!empty($new_picture)) {
      if ((($new_picture_type == 'image/gif') || ($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') ||
        ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MM_MAXFILESIZE) &&
        ($new_picture_width <= MM_MAXIMGWIDTH) && ($new_picture_height <= MM_MAXIMGHEIGHT)) {
        if ($_FILES['file']['error'] == 0) {
          // Move the file to the target upload folder
          $target = MM_UPLOADPATH . basename($new_picture);
          if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
            $query = "UPDATE esverta_user SET picture = '$picture' WHERE user_id = '" . $_SESSION['user_id'] . "'";
			mysqli_query($dbc, $query);
          }
          else {
            // The new picture file move failed, so delete the temporary file and set the error flag
            @unlink($_FILES['new_picture']['tmp_name']);
            $error = true;
            echo '<p class="error">Sorry, there was a problem uploading your picture.</p>';
          }
        }
      }
      else {
        // The new picture file is not valid, so delete the temporary file and set the error flag
        @unlink($_FILES['new_picture']['tmp_name']);
        $error = true;
        echo '<p class="error">Your picture must be a GIF, JPEG, or PNG image file no greater than ' . (MM_MAXFILESIZE / 1024) .
          ' KB and ' . MM_MAXIMGWIDTH . 'x' . MM_MAXIMGHEIGHT . ' pixels in size.</p>';
      }
    }

    // Update the profile data in the database
    if (!$error) {
      if (!empty($title) && !empty($author) && !empty($paintdate) && !empty($discribe) && !empty($comment) && !empty($new_picture)) {
        // Only set the picture column if there is a new picture
		$query = "SELECT * FROM esverta_picture WHERE picture = '$new_picture'";
      $data = mysqli_query($dbc, $query);
	  if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO esverta_picture (title, author, paintdate, discribe, comment, picture) VALUES ('$title', '$author', '$paintdate', '$discribe', '$comment', '$new_picture')";
       mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Your Picture has been successfully added. Would you like to <a href="home.php">go back your home</a>?</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">The Picture already exists. Please add a different picture.</p>';
        $new_picture = "";
      }
          
        
        
      }
      else {
        echo '<p class="error">You must enter all of the data .</p>';
      }
    }
  } // End of check for form submission


  mysqli_close($dbc);
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
    <fieldset>
      <legend>Picture Information</legend>
      <label for="title">Title:</label>
      <input type="text" id="title" name="title"/><br />
      <label for="author">Author:</label>
      <input type="text" id="author" name="author"/><br />
      <label for="paintdate">Paintdate:</label>
      <input type="text" id="paintdate" name="paintdate" value="<?php echo 'YYYY-MM-DD'; ?>" /><br />
      <label for="discribe">Discribe:</label>
      <textarea rows="4" cols="50" id="discribe" name="discribe">
Put your discribe here. </textarea><br />
      <label for="comment">Comment:</label>
     <textarea rows="4" cols="50" id="comment" name="comment">
Put your comment here. </textarea><br />
      <label for="new_picture">Picture:</label>
      <input type="file" id="new_picture" name="new_picture" />
    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
  </form>
</body> 
</html>
