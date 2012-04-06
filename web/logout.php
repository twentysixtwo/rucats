<?php
session_start();
session_destroy();

header("location: index.php");
?>

<!-- store request_uri into sessions for header return? -->