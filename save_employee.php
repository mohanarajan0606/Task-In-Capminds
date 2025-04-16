<?php
include 'db.php';
header('Content-Type: application/json; charset=utf-8');

$id = $_POST['id'] ?? '';
$name = $_POST['name'];
$target = 'uploads/';
$imageName = '';

$fileName = $_FILES['image']['name'];
$allowedFiles =  array('image/png', 'image/jpg', "image/jpeg");

$fileType = $_FILES['image']['type'];

if($fileName && !in_array($fileType, $allowedFiles)){
    echo json_encode(array("success"=>false, "message" => "Allowed only png, jpg and jpeg"));
    die();
}


if($fileName){
    $imageName = time() . '_' . $fileName;
    move_uploaded_file($_FILES['image']['tmp_name'], $target . $imageName);
}

if ($id) {
    $sql = "UPDATE employees SET name='$name'" . ($imageName ? ", image='$imageName'" : "") . " WHERE id=$id";
} else {
    $sql = "INSERT INTO employees (name, image) VALUES ('$name', '$imageName')";
}

if ($conn->query($sql)) {
    echo json_encode(array("success"=>true, "message" => "Saved successfully"));
} else {
    echo json_encode(array("success"=>false, "message" => $conn->error));
}

?>
