<?php

namespace App\Controller;

use App\Model\Conexao;
use App\Model\Agendamento;

class AgendamentoController {

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $db = Conexao::getConn();
        $model = new Agendamento($db);
        $agendamentos = $model->listarPorUsuario($_SESSION['usuario_id']);

        require_once __DIR__ . '/../View/dashboard.php';
    }

    public function criar() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $petNome = $_POST['pet_nome'] ?? '';
            $servico = $_POST['servico'] ?? '';
            $data    = $_POST['data_agendamento'] ?? '';
            $horario = $_POST['horario'] ?? '';

            if (strtotime($data) < strtotime(date('Y-m-d'))) {
                $erro = "Não é permitido agendar para datas passadas!";
            } else {
                $db = Conexao::getConn();
                $model = new Agendamento($db);

                if ($model->verificarHorarioOcupado($data, $horario)) {
                    $erro = "Este horário já está ocupado por outro atendimento!";
                } else {
                    if ($model->criar($_SESSION['usuario_id'], $petNome, $servico, $data, $horario)) {
                        header("Location: index.php?action=dashboard");
                        exit;
                    } else {
                        $erro = "Erro ao realizar o agendamento!";
                    }
                }
            }
        }

        require_once __DIR__ . '/../View/agendamento.php';
    }

    public function cancelar() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $id = $_GET['id'] ?? 0;

        if ($id) {
            $db = Conexao::getConn();
            $model = new Agendamento($db);
            $model->cancelar((int)$id, $_SESSION['usuario_id']);
        }

        header("Location: index.php?action=dashboard");
        exit;
    }
}