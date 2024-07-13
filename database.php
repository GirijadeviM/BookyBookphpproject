<?php
	require "config.php";
/**
 * The dbConnect function connects php with the MySQL server.
 * @param  The function does not take any parameters.
 * @return The function returns the mysqli object on success, or false on failure.
 */	
function dbConnect(){
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if($mysqli->connect_errno != 0){
       return FALSE;
    }else{
       return $mysqli;
    }
 }

function getCategories(){
    $mysqli = dbConnect();
    $result = $mysqli->query("SELECT DISTINCT category FROM availablebooks");
    while ($row = $result->fetch_assoc()) {
       $data[] = $row;
    }
    return $data;
 }
 
function getHomePageProducts($int){
    $mysqli = dbConnect();
    $result = $mysqli->query("SELECT * FROM availablebooks ORDER BY rand() LIMIT $int");
    while ($row = $result->fetch_assoc()){
       $data[] = $row;
    }
    return $data;
 }
 
function getProductsByCategory($category){
    $mysqli = dbConnect();
    $stmt = $mysqli->prepare("SELECT * FROM availablebooks WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    if(count($data) == 0){
       header("Location: index.php");
       exit();
    }else{
       return $data;
    }
 }
 
function getProductByTitle($title){
    $mysqli = dbConnect();
    $stmt = $mysqli->prepare("SELECT * FROM availablebooks WHERE title = ?");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
   
       return $data;
  
 }
?>