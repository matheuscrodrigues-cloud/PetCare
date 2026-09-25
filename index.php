<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\UsuarioController;
use App\Controller\AgendamentoController;

$action = $_GET['action'] ?? 'login';

$usuarioCtrl = new UsuarioController();
$agendamentoCtrl = new AgendamentoController();

switch ($action) {
    case 'login':
        $usuarioCtrl->login();
        break;
    case 'cadastrar':
        $usuarioCtrl->cadastrar();
        break;
    case 'logout':
        $usuarioCtrl->logout();
        break;
    case 'dashboard':
        $agendamentoCtrl->dashboard();
        break;
    case 'agendar':
        $agendamentoCtrl->criar();
        break;
    case 'cancelar':
        $agendamentoCtrl->cancelar();
        break;
    default:
        $usuarioCtrl->login();
        break;
}