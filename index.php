<?php
session_start();
require_once ('Facebook/autoload.php');
require_once ('config.php');

ob_start(); 

if(!isset($_SESSION['firstN']))
{
	echo "<script>alert('You must be logged in, to view this page!');</script>";
	header("Location: login.php");
}

$fb = new Facebook\Facebook([
  'app_id' => FACEBOOK_APP_ID,
  'app_secret' => FACEBOOK_APP_SECRET,
  'default_graph_version' => 'v2.2',
  ]);

$fb->setDefaultAccessToken($_SESSION['fb_access_token']);

try {
  $response = $fb->get('/me');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  
  echo 'You aren\'t a valid user! You have reached this page mistakenly' . $response; #Added this so when user isn't logged in they can't seee
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
echo "<a href = 'logout.php'> Logout</a>";
$user = $userNode;

?>

<!DOCTYPE html>
<html>
  <head>
    <title> Facebook Login System</title>
  </head>
  <body>
    <h1>Facebook Login System</h1>
    <div> You are logged in!</div>

  </body>
</html>


<?php

echo "Your Facebook ID is: " . $user['id']. '<br>';
echo 'Your Name is: ' . $user['first_name']. ' ' . $user['last_name'] . '<br>';
echo ' Your E-mail Address is: ' . $user['email'] . '<br>';
echo ' Your Gender is: ' . $user['gender'] . '<br>';
echo ' Your Facebook profile link is: ' . $user['link'] . '<br>';
echo ' Your Profile Verification Status is: ' . $user['verified'] . '<br>';

ob_flush(); 