<?php
require_once("../model/conexao.php");
session_start();

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$contato = $_POST["contato"];
$cpf_cnpj = $_POST["cpf_cnpj"];
$data_nasc = $_POST["data_nasc"];
$password = $_POST["password"];

$sql2 = "INSERT INTO usuarios (firstName, lastName, password) VALUES (:firstName, :lastName, :password)";


// Prepara a declaração
$ins2 = $pdo->prepare($sql2);

$ins2->bindParam(':firstName', $firstName);
$ins2->bindParam(':lastName', $lastName);
$ins2->bindParam(':password', $password);

#$db->beginTransaction();
$res2 = $ins2->execute();
$_SESSION['id_last_usuario'] = $pdo->lastInsertId();


$sql = "INSERT INTO perfil (lastName, email, contato, cpf_cnpj, data_nasc, id_endereco, id_usuarios) VALUES (:lastName, :email, :contato, :cpf_cnpj, :data_nasc, null, :id_usuario)";
$ins = $pdo->prepare($sql);

$ins->bindParam(':lastName', $lastName);
$ins->bindParam(':email', $email);
$ins->bindParam(':contato', $contato);
$ins->bindParam(':cpf_cnpj', $cpf_cnpj);
$ins->bindParam(':data_nasc', $data_nasc);
$ins->bindParam(':id_usuario', $_SESSION['id_last_usuario']);
$res = $ins->execute();
#$db->commit();


if ($ins === false || $ins2 === false) {
    die('Prepare failed: ' . htmlspecialchars($pdo->errorInfo()[2]));
}

if ($res2 && $res) {
    $_SESSION['id_perfil'] = $pdo->lastInsertId(); // Armazena o ID do perfil na sessão
    $_SESSION['cadastro_completo'] = true;
    header("Location: /Ampera/cadastro1");
} else {
    echo "Erro: " . implode(", ", $ins->errorInfo()) . " " . implode(", ", $ins2->errorInfo());
}

?>
