<?php
class Equipamento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("
            SELECT e.*, c.nome AS cliente_nome
            FROM equipamentos e
            JOIN clientes c ON e.cliente_id = c.id
            ORDER BY e.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionar($cliente_id, $tipo, $marca, $modelo) {
    $stmt = $this->pdo->prepare("
        INSERT INTO equipamentos (cliente_id, tipo, marca, modelo)
        VALUES (?, ?, ?, ?)
    ");
    return $stmt->execute([$cliente_id, $tipo, $marca, $modelo]);
}


    public function atualizar($id, $cliente_id, $descricao, $marca, $modelo, $numero_serie) {
        $stmt = $this->pdo->prepare("
            UPDATE equipamentos
            SET cliente_id = ?, descricao = ?, marca = ?, modelo = ?, numero_serie = ?
            WHERE id = ?
        ");
        return $stmt->execute([$cliente_id, $descricao, $marca, $modelo, $numero_serie, $id]);
    }

    public function deletar($id) {
    try {
        $stmt = $this->pdo->prepare("DELETE FROM equipamentos WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            return false;
        } else {
            throw $e;
        }
    }
}


    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM equipamentos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarPorCliente($cliente_id) {
    $stmt = $this->pdo->prepare("
        SELECT * FROM equipamentos WHERE cliente_id = ?
    ");
    $stmt->execute([$cliente_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
