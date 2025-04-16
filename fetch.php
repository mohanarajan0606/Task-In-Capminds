<?php
include 'db.php';
$result = $conn->query("SELECT * FROM employees");

echo '<table class="table table-bordered bg-white">
<tr><th>ID</th><th>Employee Name</th><th>Employee Logo</th><th>Edit</th><th>Delete</th><th>Preview</th></tr>';
$serial = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$serial}</td>
        <td>{$row['name']}</td>";
        if($row['image']){
            echo "<td><img src='uploads/{$row['image']}' width='60' height='60'></td>";
        } else {
            echo "<td>&nbsp;</td>";
        }
        
        echo "<td><button class='btn btn-warning' onclick=\"showModal('{$row['id']}', '{$row['name']}')\">Edit</button></td>
        <td><button class='btn btn-danger' onclick='deleteEmployee({$row['id']})'>Delete</button></td>
        <td><button class='btn btn-info' onclick='previewEmployee({$row['id']})'>Preview</button></td>
    </tr>";
    $serial++;
}
echo "</table>";
?>
