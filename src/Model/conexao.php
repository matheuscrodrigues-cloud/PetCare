<?php

namespace App\Model;

use PDO;
use PDOException;

class Conexao {
    private static $instance = null;

    public static function getConn() {
        if (!self::$instance) {
            try {
                $caminhoBanco = __DIR__ . '/../../petcare.sqlite';
                self::$instance = new PDO("sqlite:" . $caminhoBanco);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::criarTabelas();
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    private static function criarTabelas() {
        $sqlUsuario = "
            CREATE TABLE IF NOT EXISTS usuario (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                senha TEXT NOT NULL
            );
        ";

        $sqlAgendamento = "
            CREATE TABLE IF NOT EXISTS agendamento (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                usuario_id INTEGER NOT NULL,
                pet_nome TEXT NOT NULL,
                servico TEXT NOT NULL,
                data_agendamento TEXT NOT NULL,
                horario TEXT NOT NULL,
                FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
            );
        ";

        self::$instance->exec($sqlUsuario);
        self::$instance->exec($sqlAgendamento);
    }
}