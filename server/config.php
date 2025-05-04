<?php
// Authors: Mahmoud Ibrahim, Sharmarke Yusuf, Mustafa Tareki
// Section: 321, Course: CST8285 Web Programming, Assignment 02: Ottawa Movies

// This code connects to a MySQL database using PDO and starts a session for the Ottawa Movies project.

$host = 'localhost';         
$dbname = 'flixgo_db';       
$username = 'root';          
$password = '';              

// Create the PDO connection 
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Start a session for user data
session_start();
