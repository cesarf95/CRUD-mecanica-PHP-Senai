<?php
include 'conecta.php';

$codigo = $_GET['codigo'];
$sql = "SELECT * FROM Pessoas WHERE codigo= :codigo";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
$stmt->execute();
$codigo = $stmt->fetch(PDO::FETCH_ASSOC);
//Usado para retornar um valor em json chamando $pessoa
echo json_encode($codigo);
