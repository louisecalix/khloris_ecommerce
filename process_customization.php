<?php
session_start();

// Process customization data from POST request
$response = array();

if (isset($_POST['wrapper'])) {
  $_SESSION['wrapper'] = $_POST['wrapper'];
  $response['wrapper'] = $_SESSION['wrapper'];
}

if (isset($_POST['ribbon'])) {
  $_SESSION['ribbon'] = $_POST['ribbon'];
  $response['ribbon'] = $_SESSION['ribbon'];
}

if (isset($_POST['flowers'])) {
  $_SESSION['flowers'] = $_POST['flowers'];
  $response['flowers'] = $_SESSION['flowers'];
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
