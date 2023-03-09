<?php 
$tabela = 'solicitacao';
require_once("../../conexao.php");

$atendimento = $_POST['atendimento'];
$obstecnico = $_POST['obstecnico'];
$km_inicial = $_POST['km_inicial'];
$km_final = $_POST['km_final'];
$id = $_POST['id'];


$query = $pdo->prepare("UPDATE $tabela SET obstecnico = :obstecnico, km_inicial = :km_inicial, km_final = :km_final, atendimento = :atendimento, data_tec = now() WHERE id = '$id'");

$query->bindValue(":atendimento", "$atendimento");
$query->bindValue(":obstecnico", "$obstecnico");
$query->bindValue(":km_inicial", "$km_inicial");
$query->bindValue(":km_final", "$km_final");
$query->execute();



echo 'Salvo com Sucesso'; 

?>