<?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>

<!DOCTYPE html>
<head>
<meta property="og:url"             content="http://samples.ogp.me/136756249803614" /> 
<meta property="og:title"           content="Chocolate Pecan Pie" /> 
<meta property="og:image"           content="https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/851565_496755187057665_544240989_n.jpg" /> 
  <title>esVerta - Welcome to your home!</title>
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
<div id="fb-root"></div>
<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '265609636934494',
          status     : true,
          xfbml      : true
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
<!-- Header -->
<header id="header">
	<h1>VisitTheMuseum - Welcome to your album!</h1>
	<div id="backlinks">


<p>
  <?php
  require_once('appvars.php');
  require_once('connectvars.php');

  if (isset($_SESSION['username'])) {
    echo '<a href="editprofile.php">Manage your account &raquo;</a>';
	//echo '&#10084; <a href="addpicture.php">Add a picture</a><br />';
    echo '<a href="logout.php">Log Out (' . $_SESSION['username'] . ') &raquo;</a>';
  }
  else {
    echo '&#10084; <a href="index.php">Log In &raquo;</a>';
    echo '&#10084; <a href="signup.php">Sign Up &raquo;</a>';
  }

?>
</div>
	<div class="clearfix"></div>
</header>
<br />
<section id="wrapper">
	<hgroup>
		<h2>This is your album</h2> 
		<h3><a href="addpicture.php">Add picture From Computer</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="rootpicture.php">Add picture From Museum</a></h3>
	</hgroup>
<?php


  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $result = $mysqli->query("SELECT picture FROM esverta_user WHERE user_id = '" . $_SESSION['user_id'] . "'");

  if ($result->num_rows == 1) {
	$row = $result->fetch_assoc(); 
    echo '<div id="container">';
	$picture = $row['picture'];
	$pictureArray = explode('/',$picture);
    if (!empty($row['picture'])) {
		foreach($pictureArray as $pic){
			echo '<div class="grid">';
			echo '<div class="imgholder">';
			$result2 = $mysqli->query("SELECT title, author FROM esverta_picture WHERE picture = '$pic'");
			$row2 = $result2->fetch_assoc();
			if (!empty($row2['title'])) {
			echo '<a href="viewpicture.php"><img class="block" src="' . MM_UPLOADPATH . $pic .'" alt="Profile Picture"/></a>';
			echo '</div>';
			echo '<strong>'.$row2['title'].'</strong>';
			echo $row2['author'];
			}
			else{
				$obj = $pic;
				$objarray = explode('.', $obj);
				$ob = $objarray[0];
				$lines = file("html/".$ob.".html");
				foreach ($lines as $line_num => $line) {
				if($line_num==4){
    				//echo "" . htmlspecialchars($line) . "<br />";
					$title = $line;
				}
				if($line_num==5){
    				//echo "" . htmlspecialchars($line) . "<br />";
					$author =  $line;
				}
			}
			echo '<a href="viewpicture.php"><img class="block" src="' . MM_UPLOADPATH . $pic .'" alt="Profile Picture"/></a>';
			echo '</div>';
			echo '<strong>'.$title.'</strong>';
			echo $author;
			}
			echo '<div class="meta" title="' . $pic .'"><a class="remove" href="remove.php" style="color:white">X<a></div>';
			echo '</div>';
		}
    }
    echo '</div>';
  } 
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }

  $mysqli->close();
?>
</section>
</body> 
</html>
