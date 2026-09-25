<?php

namespace App\Controller;

use App\Model\Conexao;
use App\Model\Usuario;

class UsuarioController {

    public function login() {
        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $db = Conexao::getConn();
            $model = new Usuario($db);
            $user = $model->buscarPorEmail($email);

            if ($user && password_verify($senha, $user['senha'])) {
                session_start();
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nome'] = $user['nome'];

                header("Location: index.php?action=dashboard");
                exit;
            } else {
                $erro = "E-mail ou senha incorretos!";
            }
        }

        require_once __DIR__ . '/../View/login.php';
    }

    public function cadastrar() {
        $erro = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $db = Conexao::getConn();
            $model = new Usuario($db);

            if ($model->cadastrar($nome, $email, $senha)) {
                header("Location: index.php?action=login");
                exit;
            } else {
                $erro = "Erro ao cadastrar!";
            }
        }

        require_once __DIR__ . '/../View/cadastro.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}