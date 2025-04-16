<?php
include 'db.php';

$id = $_POST['id'] ?? '';
$name = $_POST['name'];
$target = 'uploads/';
$imageName = '';

if ($_FILES['image']['name']) {
    $imageName = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $target . $imageName);
}

if ($id) {
    $sql = "UPDATE employees SET name='$name'" . ($imageName ? ", image='$imageName'" : "") . " WHERE id=$id";
} else {
    $sql = "INSERT INTO employees (name, image) VALUES ('$name', '$imageName')";
}

if ($conn->query($sql)) {
    echo "Saved successfully";
} else {
    echo "Error: " . $conn->error;
}
?>
