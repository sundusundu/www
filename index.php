<?php
  require_once('connectvars.php');
	
  session_start();
  error_reporting(0);
  $error_msg = "";
echo $_SERVER['aalio1rdc2w9hm.c6nr3pcl42so.us-west-2.rds.amazonaws.com'];

  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
       //$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	   $dbc = mysqli_connect('aalio1rdc2w9hm.c6nr3pcl42so.us-west-2.rds.amazonaws.com', 'ebroot', '11111111', 'ebdb', 3306);

      //$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      //$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
	  $user_username = $_POST['username'];
	  $user_password = $_POST['password'];
	  //$name = $_POST['firstname'] . ' ' . $_POST['lastname'];
  	  //$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
  	  //$other = mysqli_real_escape_string($dbc, trim($_POST['other']));

      if (!empty($user_username) && !empty($user_password)) {
        $query = "SELECT user_id, username FROM esverta_user WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/home.php';
          header('Location: ' . $home_url);
        }
        else {
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {

  $to = 'sundusundu@163.com';
  $subject = "$email";
  $msg = "$name was contact us that $other";
  mail($to, $subject, $msg);
  
  
      }
	}
  }
?>

<!DOCTYPE html>
<head>
  <title>esVerta</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <style type="text/css">
<!--
body {
 background-image: url(beijing.png);
 background-size:1280px;
}
-->
  </style>
</head>
<body>
<h1 id="visit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VisitTheMuseum</h1>

  <?php
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

<p>&nbsp;</p>
<p>&nbsp;</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div>
    <legend></legend>
      <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="white">Username</font> </label>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" />
      <span style="font-size:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><font color="white" size="+2" face="Comic Sans MS, cursive">download the app</font><br /><br/>
      <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="white">Password</font></label>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" />
    
    <input type="submit" value="Log In" name="submit" />
    </div>
  </form>

<p>
  <?php
  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="signup.php"><font color="white">Sign Up</font></a>';
  }
  else {
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
  }
?>
</p>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p id="visit2" align="center">VisitTheMuseum<br />
________</p>

<p id="visit3" align="center"> VisitTheMuseum is a mobile platform for interactive experiences<br /> in museums. Our technology enables museum visitors to curate<br /> their own collections at any time during or after the actual visit. <br />Visitors can access and share information about the exhibits by<br /> means of personalized queries and social networking.</p>
<p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p id="visit2" align="center">About us<br />
________</p>

<p id="visit3" align="center"> We provide interpretive technology for museums to extend the <br />outreach of educational and cultural programs. Our products <br />address the visitors' need for personalized experiences and, at <br />the same time, facilitate the museum's involvement in public <br />projects and in managing the collections.
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<p id="visit2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact</p>
<p id="visit3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;esVerta LLC<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ithaca, NY</p>


<p id="visit3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  id="visit4" href="mailto:info@esverta.com">info@esverta.com</a></p>

<!--<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="firstname">First name:</label>
    <input type="text" id="firstname" name="firstname" /><br />
    <label for="lastname">Last name:</label>
    <input type="text" id="lastname" name="lastname" /><br />
    <label for="email">Subject:</label>
    <input type="text" id="email" name="email" /><br />
    <label for="other">Anything want to send us?</label>
    <textarea id="other" name="other"></textarea><br />
    <input type="submit" value="Send" name="submit" />
  </form>-->
<p>&nbsp;</p><p>&nbsp;</p>


</body>
</html>
