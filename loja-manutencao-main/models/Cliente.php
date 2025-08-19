<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM clientes ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionar($nome, $telefone, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $telefone, $email]);
    }

    public function atualizar($id, $nome, $telefone, $email) {
        $stmt = $this->pdo->prepare("UPDATE clientes SET nome = ?, telefone = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nome, $telefone, $email, $id]);
    }

public function deletar($id) {
    try {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
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
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
