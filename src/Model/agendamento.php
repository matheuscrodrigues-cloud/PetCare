<?php

namespace App\Model;

use PDO;

class Agendamento {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function criar($usuarioId, $petNome, $servico, $data, $horario) {
        $sql = "INSERT INTO agendamento (usuario_id, pet_nome, servico, data_agendamento, horario) 
                VALUES (:usuario_id, :pet_nome, :servico, :data_agendamento, :horario)";
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":usuario_id", $usuarioId, PDO::PARAM_INT);
        $stmt->bindValue(":pet_nome", $petNome, PDO::PARAM_STR);
        $stmt->bindValue(":servico", $servico, PDO::PARAM_STR);
        $stmt->bindValue(":data_agendamento", $data, PDO::PARAM_STR);
        $stmt->bindValue(":horario", $horario, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function listarPorUsuario($usuarioId) {
        $sql = "SELECT * FROM agendamento WHERE usuario_id = :usuario_id ORDER BY data_agendamento ASC, horario ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":usuario_id", $usuarioId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificarHorarioOcupado($data, $horario) {
        $sql = "SELECT id FROM agendamento WHERE data_agendamento = :data_agendamento AND horario = :horario LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":data_agendamento", $data, PDO::PARAM_STR);
        $stmt->bindValue(":horario", $horario, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cancelar($id, $usuarioId) {
        $sql = "DELETE FROM agendamento WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":usuario_id", $usuarioId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}