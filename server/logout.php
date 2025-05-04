<!-- logout.php -->
<?php
// Authors: Mahmoud Ibrahim, Sharmarke Yusuf, Mustafa Tareki
// Section: 321, Course: CST8285 Web Programming, Assignment 02: Ottawa Movies

// This code logs the user out by clearing the session and redirecting to the homepage.

include './config.php';

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to index.php
header("Location: ../index.php");
exit();
?>