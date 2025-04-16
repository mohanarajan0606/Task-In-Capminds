<?php
require_once('tcpdf/tcpdf.php');
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM employees WHERE id=$id")->fetch_assoc();

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Employee Name: " . $result['name'], 0, 1);
$pdf->Image('uploads/' . $result['image'], '', '', 60, 40);
$pdf->Output('employee.pdf', 'I');
?>
