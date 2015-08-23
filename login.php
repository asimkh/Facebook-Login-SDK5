<?php
session_start() ;
if(isset($_SESSION['firstN']))
{
	header("Location: index.php");
}
require_once ('Facebook/autoload.php');
require_once ('config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Facebook Login System</title>
	</head>
	<body>
		<h1>Facebook Login System</h1>
		<div> You are currently not logged in!</div>

	</body>
</html>

<?php

$app_id = FACEBOOK_APP_ID;
$app_secret = FACEBOOK_APP_SECRET;


$fb = new Facebook\Facebook([
  'app_id' => FACEBOOK_APP_ID,
  'app_secret' => FACEBOOK_APP_SECRET,
  'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'public_profile']; // optional
$loginUrl = $helper->getLoginUrl('http://www.liriant.com/Login_System/fb-callback.php', $permissions);


echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>
