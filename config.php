<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$db = "studee";

$conn = mysqli_connect($host, $username, $password);
if(!$conn){
    die("Koneksi gagal");
}

$conn->select_db($db);

function is_logged_in(){
    return isset($_SESSION['email']);
}

function is_registered_as_guru(){
    return isset($_SESSION['guru']);
}

