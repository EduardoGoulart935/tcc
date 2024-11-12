<?php
session_start();
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Ampera/');

$url = explode("/", $_SERVER['REQUEST_URI']); // Pega um array da URL

function validaLogin()
{
    // Se o usuário não estiver logado, redireciona para a página de login
    if (isset($_SESSION['autenticado'])) {
        header("Location: /Ampera/menu");
        exit();
    } else {
        header("Location: /Ampera/login");
        exit();
    }
}

function VerificaSessao()
{
    if (!isset($_SESSION['id_perfil'])) {
        header("Location: login");
    }
}

// Variável para controlar se o header/footer deve ser exibido
$exibirHeaderFooter = isset($_SESSION['autenticado']) ||isset($_SESSION['cadastro1_completo']);

// Exibe o header se o usuário estiver autenticado e não estiver nas páginas de cadastro ou login
if ($exibirHeaderFooter && !in_array($url[2], ['cadastro', 'cadastro1', 'login', 'autenticar'])) {
    require_once(ROOT_PATH . 'view/header.php');
}

if ($url[1] != "Ampera") { // Validações de URL
    validaLogin();
    include 'view/login.php';
    exit;
}

if (!isset($url[2])) {
    validaLogin();
    include 'view/login.php'; // Padrão, página de login
    exit;
}

if (count($url) > 5) {
    if (!empty($url[5])) {
        include 'view/erro404.php';
        exit;
    }
}

// Chamadas das rotas
switch ($url[2]) {
    case 'autenticar':
        include './controller/autenticar.php';
        break;
    case 'autenticarGoogle':
        include './controller/autenticarGoogle.php';
        break;
    case 'login':
        include 'view/login.php';
        break;
    case 'sobre':
        include 'view/sobre.php';
        break;
    case 'menu':
        include 'view/menu.php';
        break;
    case 'notificacao':
        include 'view/notificacao.php';
        break;
    case 'pedidos':
        VerificaSessao();
        include 'view/pedidos.php';
        break;
    case 'cadastro':
        include 'view/cadastro.php';
        break;
    case 'cadastro1':
        // Verifica se o cadastro inicial foi feito antes de carregar o cadastro1
        if (isset($_SESSION['cadastro_completo'])) {
            include 'view/cadastro1.php';
        } else {
            header("Location: /Ampera/cadastro");
            exit();
        }
        break;
    case 'perfil':
        VerificaSessao();
        include 'view/perfil.php';
        break;
    case 'suas_ofertas':
        VerificaSessao();
        include 'view/suas_ofertas.php';
        break;
    case 'criar-oferta':
        VerificaSessao();
        include 'view/criar_oferta.php';
        break;
    case 'logout':
        include './controller/logout.php';
        break;
    case 'logoutGoogle':
        include './controller/logoutGoogle.php';
        break;
    default:
        header("Location: /Ampera/login");
        exit();
}

// Exibe o footer se o usuário estiver autenticado e não estiver nas páginas de cadastro ou login
if ($exibirHeaderFooter && !in_array($url[2], ['cadastro', 'cadastro1', 'login', 'autenticar'])) {
    require_once(ROOT_PATH . 'view/footer.php');
}
