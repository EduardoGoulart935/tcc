<?php
require_once(ROOT_PATH . 'model/conexao.php');
@session_start();

$login = $_POST['login'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM usuarios WHERE login = :login AND senha = :senha");
$query->bindValue(":login", $login);
$query->bindValue(":senha", $senha);
$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($res);
if ($total_reg > 0) {
    $_SESSION['login'] = $res[0]['login'];
    $_SESSION['id'] = $res[0]['id'];
    $_SESSION['autenticado'] = true;  // Definindo como autenticado

    $query_perfil = $pdo->prepare("SELECT id FROM perfil WHERE id_usuarios = :id_usuario");
    $query_perfil->bindValue(":id_usuario", $_SESSION['id']);
    $query_perfil->execute();

    $res_perfil = $query_perfil->fetch(PDO::FETCH_ASSOC);
    if ($res_perfil) {
        $_SESSION['id_perfil'] = $res_perfil['id'];
    }

    // Redireciona para o menu
    header("Location: /Ampera/menu");
} else {
    // Redireciona para a página inicial em caso de falha de login
    header("Location: /Ampera/");
}
