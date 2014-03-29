<?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  
  if (isset($_COOKIE['rmpicture'])) {
	  $pictur = $_COOKIE['rmpicture'];
	  $picarray = explode('/', $pictur);
	  $rmpic = $picarray[0];
    }
?>

<!DOCTYPE html>
<head>
  <title>esVerta - remove</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/flexslider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/blocksit.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/xml">
<!--

-->
</script>
</head>
<body>
<p>Removing pictures...</p>
<?php
  require_once('appvars.php');
  require_once('connectvars.php');


  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  
	  
    if (!isset($_GET['user_id'])) {
    $query = "SELECT picture FROM esverta_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT picture FROM esverta_user WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    $row = mysqli_fetch_array($data);
	$picture = $row['picture'];
	$pictureArray = explode('/',$picture);
	$newarray = array();
	foreach($pictureArray as $pic){
		if($pic <> $rmpic){
			$newarray[] = $pic;
		}
	}
	$newpicture = implode('/',$newarray);
	$query = "UPDATE esverta_user SET picture = '$newpicture' WHERE user_id = '" . $_SESSION['user_id'] . "'";
	mysqli_query($dbc, $query);
  } 

  mysqli_close($dbc);
  // Redirect to the home page
  //$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';
  //header('Location: ' . $home_url);
  echo "<script>location.href='home.php';</script>";
?>
</body> 
</html>
