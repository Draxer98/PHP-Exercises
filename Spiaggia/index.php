<?php
session_start();

$conn = new mysqli("192.168.60.144:3306", "michele_gaino", "scremerebbero.associavamo.", "michele_gaino_");

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT admin FROM persona WHERE cf = ?");
$stmt->bind_param("i", $_SESSION['codiceFiscale']);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['admin'] == -128) {
    $stmt->close();
    $stmt = $conn->prepare("SELECT cf FROM persona WHERE admin = ? AND cf = ?");
    $stmt->bind_param("ii", $row['admin'], $_SESSION['codiceFiscale']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo "Administrator with cf: ".$row['cf']."<br>";
} else {
    $stmt->close();
    echo "not administrator";
}