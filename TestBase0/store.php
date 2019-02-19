<?php

//echo '<pre>';
//var_dump($_POST, $_FILES);
//echo '</pre>';

function uploadImage($image){
   //echo '<pre>';
//var_dump(pathinfo($image['name'], 4) ,$image);
//echo '</pre>'; 
    $extention = pathinfo($image['name'], 4);
    $filename = uniqid().".".$extention;
    move_uploaded_file($image['tmp_name'], "./uploads/".$filename);
    
    return $filename;

}

/* @var $filename type */
 $filename = uploadImage($_FILES['image']);

$pdo = new PDO("mysql:host=localhost;dbname=example", "root", "");
//var_dump($pdo);
$sql = "INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)";
$statement = $pdo->prepare($sql);
$statement->bindParam(":title", $_POST['title']);
        $statement->bindParam(":content", $_POST['content']);
        $statement->bindParam(":image", $filename);
        $statement->execute();

