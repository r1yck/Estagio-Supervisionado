<?php
$erro = null;
$valido = false;

if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true)
{
    if(strlen(utf8_decode($_POST["nome"])) < 5)
        $erro = "<div class='alert alert-error'>Preencha o campo nome corretamente (mínimo 5 caracteres!)</div>";
    else if(strlen(utf8_decode($_POST["email"])) < 6)
        $erro = "<div class='alert alert-error'>Email inválido, preencha corretamente.</div>";
    else if(!is_numeric($_POST["idade"]))
        $erro = "<div class='alert alert-error'>O campo idade deve ser numérico!</div>";
    else if($_POST["sexo"] != 'M' && $_POST["sexo"] != 'F')
        $erro = "<div class='alert alert-error'>Selecione o campo sexo corretamente!</div>";
    else if(!in_array($_POST["estadocivil"], ["Solteiro(a)","Casado(a)","Divorcido(a)","Viuvo(a)"]))
        $erro = "<div class='alert alert-error'>Selecione o estado civil corretamente.</div>";
    else if(strlen(utf8_decode($_POST["senha"])) < 6)
        $erro = "<div class='alert alert-error'>O campo senha deve ter no mínimo 6 caracteres.</div>";
    else
    {
        $valido = true;
        try {
            $connection = new PDO("mysql:host=localhost;dbname=cursophp", "root","");
            $connection->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Falha: " . $e->getMessage();
            exit();
        }

        $sql = "INSERT INTO usuarios(nome, email, idade, sexo, estado_civil, humanas, exatas, biologicas, senha)
                VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(1, $_POST["nome"]);
        $stmt->bindParam(2, $_POST["email"]);
        $stmt->bindParam(3, $_POST["idade"]);
        $stmt->bindParam(4, $_POST["sexo"]);
        $stmt->bindParam(5, $_POST["estadocivil"]);
        $stmt->bindParam(6, isset($_POST["humanas"]) ? 1 : 0);
        $stmt->bindParam(7, isset($_POST["exatas"]) ? 1 : 0);
        $stmt->bindParam(8, isset($_POST["biologicas"]) ? 1 : 0);
        $stmt->bindParam(9, md5($_POST["senha"]));
        $stmt->execute();

        if($stmt->errorCode() != "00000") {
            $valido = false;
            $erro = "Erro código " . $stmt->errorCode() . ": " . implode(", ", $stmt->errorInfo());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>C.E.A.D Cursos Técnicos - Cadastro</title>
<link rel="stylesheet" href="styles/cadastro.css">
</head>
<body>

<header>
    <img src="imagens/logo.png" alt="Logo Colégio">
    <button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>
    <ul class="menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="quem-somos.html">Nossa Escola</a></li>
        <li><a href="portifolio.html">Portfólio</a></li>
        <li><a href="Galeria.html">Fotos</a></li>
        <li><a href="Secretaria.html">Secretaria</a></li>
        <li><a href="cadastro.php" class="active">Cadastro</a></li>
    </ul>
</header>

<div class="container">
<?php
if($valido) {
    echo "<div class='alert alert-success'><strong>Sucesso!</strong> Dados enviados com sucesso.</div>";
    echo "<a href='BancoDeDados_Lista.php'>Visualizar Cadastro</a>";
} else {
    if(isset($erro)) echo $erro;
?>
<h2>Cadastro de Alunos</h2>
<form method="POST" action="cadastro.php?validar=true">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= isset($_POST["nome"]) ? htmlspecialchars($_POST["nome"]) : '' ?>">
    
    <label>E-mail:</label>
    <input type="text" name="email" value="<?= isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : '' ?>">
    
    <label>Idade:</label>
    <input type="text" name="idade" value="<?= isset($_POST["idade"]) ? htmlspecialchars($_POST["idade"]) : '' ?>">
    
    <label>Sexo:</label><br>
    <input type="radio" name="sexo" value="M" <?= (isset($_POST["sexo"]) && $_POST["sexo"]=="M")?'checked':'' ?>> Masculino
    <input type="radio" name="sexo" value="F" <?= (isset($_POST["sexo"]) && $_POST["sexo"]=="F")?'checked':'' ?>> Feminino
    <br><br>
    
    <label>Curso de Interesse:</label><br>
    <input type="checkbox" name="humanas" <?= isset($_POST["humanas"]) ? 'checked':'' ?>> Ciências Humanas
    <input type="checkbox" name="exatas" <?= isset($_POST["exatas"]) ? 'checked':'' ?>> Ciências Exatas
    <input type="checkbox" name="biologicas" <?= isset($_POST["biologicas"]) ? 'checked':'' ?>> Ciências Biológicas
    <br><br>
    
    <label>Estado Civil:</label>
    <select name="estadocivil">
        <option value="">Selecione...</option>
        <option <?= (isset($_POST["estadocivil"]) && $_POST["estadocivil"]=="Solteiro(a)")?'selected':'' ?>>Solteiro(a)</option>
        <option <?= (isset($_POST["estadocivil"]) && $_POST["estadocivil"]=="Casado(a)")?'selected':'' ?>>Casado(a)</option>
        <option <?= (isset($_POST["estadocivil"]) && $_POST["estadocivil"]=="Divorcido(a)")?'selected':'' ?>>Divorcido(a)</option>
        <option <?= (isset($_POST["estadocivil"]) && $_POST["estadocivil"]=="Viuvo(a)")?'selected':'' ?>>Viuvo(a)</option>
    </select>
    
    <label>Senha:</label>
    <input type="password" name="senha">
    <br>
    <button type="reset">Limpar</button>
    <button type="submit">Enviar</button>
</form>
<?php } ?>
</div>

<footer>
    <div style="display:flex; justify-content:center;"><img src="imagens/gov.png" alt="Governo da Bahia"></div>
    <ul>
        <li><a href="https://www.educacao.ba.gov.br/">SEC</a></li>
        <li><a href="http://www.educacao.ba.gov.br/midias/fotos">Midiotecas</a></li>
        <li><a href="https://www.bahia.ba.gov.br/sites-do-governo/">Site do Governo</a></li>
        <li><a href="http://estudantes.educacao.ba.gov.br/">Estudantes</a></li>
        <li><a href="http://institucional.educacao.ba.gov.br/">Institucional</a></li>
        <li><a href="http://escolas.educacao.ba.gov.br/">Escolas</a></li>
    </ul>
    <p>Endereço: Av. Esperanto, s/n - Centro, Itapetinga - BA, 45700-000</p>
    <p>Telefone: (77) 3261-1219</p>
    <p>Todos os Direitos Reservados: Prof. Ubiratan Ferreira</p>
</footer>

<script>
function toggleMenu() {
    document.querySelector('.menu').classList.toggle('show');
}
</script>
</body>
</html>
