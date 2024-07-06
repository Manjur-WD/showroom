<?php
ob_start();
session_start();
include '../config.php'; 

session_destroy();
header('location:index.php');

?>