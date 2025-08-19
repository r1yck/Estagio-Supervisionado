<?php
class OrdemServico {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("
            SELECT os.*, e.tipo AS equipamento_tipo, c.nome AS cliente_nome
            FROM ordens_servico os
            JOIN equipamentos e ON os.equipamento_id = e.id
            JOIN clientes c ON e.cliente_id = c.id
            ORDER BY os.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionar($equipamento_id, $descricao, $status, $data_conclusao = null) {
        $stmt = $this->pdo->prepare("
            INSERT INTO ordens_servico (equipamento_id, descricao, status, data_conclusao)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$equipamento_id, $descricao, $status, $data_conclusao]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM ordens_servico WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $equipamento_id, $descricao, $status, $data_conclusao) {
        $stmt = $this->pdo->prepare("
            UPDATE ordens_servico
            SET equipamento_id = ?, descricao = ?, status = ?, data_conclusao = ?
            WHERE id = ?
        ");
        return $stmt->execute([$equipamento_id, $descricao, $status, $data_conclusao, $id]);
    }

    public function deletar($id) {
    try {
        $stmt = $this->pdo->prepare("DELETE FROM ordens_servico WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            return false;
        } else {
            throw $e;
        }
    }
}

}
