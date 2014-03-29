<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  
	  
	if (isset($_COOKIE['picture'])) {
	  $picture = $_COOKIE['picture'];
	  $picarray = explode('/', $picture);
	  $_SESSION['picture'] = $picarray[1];
    }	
?>

<!DOCTYPE html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="script2.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.js"></script>
</head>
<body>
<h3></h3>

<?php
  require_once('appvars.php');
  require_once('connectvars.php');
  
  echo '<div id="originalframe">';
echo '<img src="' . MM_UPLOADPATH . $_SESSION['picture'] .'" id="img"/>';
echo '<div id="showbox"></div>';
echo '</div>';
echo '<div id="showframe"><img id="showimg"/></div>';

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
  else {
    echo('<p> '  . ' <a href="home.php">Back</a></p>');
  }
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!isset($_GET['picture'])) {
    $query = "SELECT title, author, paintdate, discribe, comment FROM esverta_picture WHERE picture = '" . $_SESSION['picture'] . "'";
  }
  else {
    $query = "SELECT title, author, paintdate, discribe, comment FROM esverta_picture WHERE picture = '" . $_GET['picture'] . "'";
  }
  $data = mysqli_query($dbc, $query);
	if (mysqli_num_rows($data) == 1) {
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
    echo '<table>';
    if (!empty($row['title'])) {
      echo '<tr><td class="label">Title:</td><td>' . $row['title'] . '</td></tr>';
    }
    if (!empty($row['author'])) {
      echo '<tr><td class="label">Author:</td><td>' . $row['author'] . '</td></tr>';
    }
    if (!empty($row['paintdate'])) {
      echo '<tr><td class="label">Paint time:</td><td>' . $row['paintdate'] . '</td></tr>';
    }
	if (!empty($row['discribe'])) {
      echo '<tr><td class="label">Discribe:</td><td>' . $row['discribe'] . '</td></tr>';
    }
	if (!empty($row['comment'])) {
      echo '<tr><td class="label">Momment:</td><td>' . $row['comment'] . '</td></tr>';
    }
      echo '<tr><td class="label">Picture:</td><td><img src="' . MM_UPLOADPATH . $_SESSION['picture'] .
        '" alt="Profile Picture" /></td></tr>';
    echo '</table>';
	mysqli_close($dbc);
  } 
  else {
    $obj = $_SESSION['picture'];
$objarray = explode('.', $obj);
$ob = $objarray[0];
$lines = file("html/".$ob.".html");
foreach ($lines as $line_num => $line) {
	if($line_num>=4 and $line_num<=7){
    	//echo "" . htmlspecialchars($line) . "<br />";
		echo "" . $line . "";
	}
	if($line_num>=15 and $line_num<=70){
    	//echo "" . htmlspecialchars($line) . "<br />";
		echo "" . $line . "";
	}
}

  }

?>
<?php
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   $query = "SELECT comment1 FROM esverta_comment WHERE user_id = '" . $_SESSION['user_id'] . "'";
   $data = mysqli_query($dbc, $query);
   $row = mysqli_fetch_array($data);
   if ($row != NULL) {
      $comment1 = $row['comment1'];
	$myarray = explode("\r", $comment1);
    }

  if (isset($_POST['submit1'])) {
    $comment1 = mysqli_real_escape_string($dbc, trim($_POST['comment1']));
	$query = "SELECT * FROM esverta_comment WHERE user_id = '" . $_SESSION['user_id'] . "'";
	$data = mysqli_query($dbc, $query);
	if (mysqli_num_rows($data) == 0) {
		$query = "INSERT INTO esverta_comment (user_id, picture, comment1) VALUES ('" . $_SESSION['user_id'] . "', '" . $_SESSION['picture'] . "', '$comment1')";
        mysqli_query($dbc, $query);	
	}
    else{
		$query = "UPDATE esverta_comment SET comment1 = '$comment1' WHERE user_id = '" . $_SESSION['user_id'] . "'";
		mysqli_query($dbc, $query);	 
	}
        mysqli_close($dbc);
		$myarray = explode('\r\n', $comment1);
		echo '    <fieldset style="width:400px">
<legend>My Comment</legend>
<form method="post" action="viewpicture.php">
      <span id="div_04">'; 
	  if (!empty($comment1)){ foreach($myarray as $my){echo $my;echo '<br>';}} 
	  else echo 'Comment1'; 
	  echo '</span><br>
      <div class="name">
      <textarea rows="4" cols="50" type="text" id="comment1" name="comment1">';
	  if (!empty($comment1)){ foreach($myarray as $my){echo $my;echo "\r\n";}} 
	  echo '</textarea><br />
    <input type="submit" value="Save Comment" name="submit1" /><br /></div>
  </form>
</fieldset>';
        exit();
		
  }
?>
    <fieldset style="width:400px">
<legend>My Comment</legend>
<form method="post" action="viewpicture.php">
      <span id="div_04"><?php if (!empty($comment1)){ foreach($myarray as $my){echo $my;echo '<br>';}}  else echo 'Comment1'; ?></span><br>
      <div class="name">
      <textarea rows="4" cols="50" type="text" id="comment1" name="comment1"><?php if (!empty($comment1)) echo $comment1; ?></textarea><br />
    <input type="submit" value="Save Comment" name="submit1" /><br /></div>
  </form>
</fieldset>
</body> 
</html>
