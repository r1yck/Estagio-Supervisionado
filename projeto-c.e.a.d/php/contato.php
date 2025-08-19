<!--- inicio 1 ( Orientar o php para o que deve ser feio!!! ) -->
<?php

$erro = null;
$valido = false;

if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true)
{
    if(strlen(utf8_decode($_POST["nome"])) < 5)
    {
        $erro = "<div class='alert alert-success'> Preecha o campo nome corretamente (Com o minimo de 5 caracteres!)</div>";
    }
    else if(strlen(utf8_decode($_POST["email"])) < 6)
    {
        $erro = "<div class='alert alert-success'>Email invalido preencha corretamente.</div>";
    }
    else if(is_numeric($_POST["idade"]) == false)
    {
        $erro = "<div class='alert alert-success'>O campo idade, deve ser numerico!</div>";
       
    }
    else if($_POST["sexo"] != 'M' && $_POST["sexo"] != 'F')
    {
        $erro = "<div class='alert alert-success'>Selecione o campo sexo corretamente!</div>";
    }
    else if  ($_POST["estadocivil"]  != "Solteiro(a)"
           && $_POST["estadocivil"]  != "Casado(a)"
           && $_POST["estadocivil"]  != "Divorcido(a)"
           && $_POST["estadocivil"]  != "Viuvo(a)"
           )
    {
        $erro = "<div class='alert alert-success'> selecione o campo de estado civil corretamente. </div>";
    }
    else if(strlen(utf8_decode($_POST["senha"])) < 6)
    {
        
        $erro = "<div class='alert alert-success'> O campo de senha deve ser preenchido, com o minino de 6 caraceteres.</div>";
        //echo "<div class='alert alert-success'>  <strong>$erro </strong> </div>";
    }
    else
    {
        $valido = true;
        
        //  Inicio --- conecxão com o banco de dados começa aqui!! --- \\
        
        try
        {
            $connection = new PDO("mysql:host=localhost;dbname=cursophp", "root","");
            $connection->exec("set names utf8");
        }
        catch(PDOException $e)
        {
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
         //inicoi exemplo de If curto       
        $checkHumanas = isset($_POST["humanas"]) ? 1 : 0;
        $stmt->bindParam(6, $checkHumanas);
        
        $checkExatas = isset($_POST["exatas"]) ? 1 : 0;
        $stmt->bindParam(7, $checkExatas);
        
        $checkBiologicas = isset($_POST["biologicas"]) ? 1 : 0;
        $stmt->bindParam(8, $checkBiologicas);
         // Fim exemplo de If curto
         
         $passwordHash = md5($_POST["senha"]);
         $stmt->bindParam(9, $passwordHash);
         //$passwordHash = md5("@bhil@" . $_POST["senha"]);
         //$stmt->bindParam(9, $passwordHash);
         
         
         $stmt->execute();
         
         if($stmt->errorCode() != "00000")
         {
            $valido = false;
            $erro = "Erro codigo " . $stmt->errorCode() . " : ";
            $erro = implode(", ", $stmt->errorInfo());
            
         }
                 
    }
}

?>
<!--- Fim 1 ( Orientar o php para o que deve ser feio!!! ) -->



<!DOCTYPE html>
 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<html>

<head>
	<title>C.E.A.D CURSOS TÉCNICOS</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/c_style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="style/botton.css"/>	
</head>

<body background="imagens/fundo2.png">
  <table border="0" width="999" align="center">

    <tr ><td height="89" ><img src="imagens/logo.png"></td>
    <td align="right">
  <ul class="menu">
  <li><a href="index.html">Home</a></li>
  <li></li>
  <li><a href="quem-somos.html">Nossa Escola</a></li>
  <li><a href="portifolio.html">Portifólio</a></li>
  <li><a href="Galeria.html">Fotos</a></li>
  <li><a href="Secretaria.html">Secretaría</a></li>
  <li><a href="./php/BancoDeDados_Cadastro.php">Contato</a></li>
  </ul>
  </td>
</tr>
</tr>
</table>
    	<div class="borpo">

		<font size="5" face="Thames">
			<br>			
<!-- inicio 2 informa o tipo de erro -->
        <?php
        if($valido == true)
        {
            echo "<div class='alert alert-success'>  <strong>Sucesso! </strong> Dados enviados! </div>";
            //echo"Dados enviados, com sucesso!";
            echo"<br>";
            echo "<a href='BancoDeDados_Lista.php'>Visualizar Cadastro</a>";
         
        }
        else
        {
        if(isset($erro))
        {
            echo $erro . "<br><br>";            
        }
        
        ?>
        <!-- fim 2 informa o tipo de erro -->        
        
        <H2>Cadastro de Alunos</H2>
        <br>
        <div id="form">
        <form method=POST action="BancoDeDados_Cadastro.php?validar=true">
            
      <!-- mantem os elementos preenchidos-->
                
          <label>Nome:</label> <br>
      <input type=TEXT name=nome  <?php if(isset($_POST["nome"])) {echo  "value='"  . $_POST["nome"]  . "'";} ?> ><br>    
           <label>E-mail: </label> <br>
            <input type=TEXT name=email <?php if(isset($_POST["email"])){echo "value='" . $_POST["email"]    . "'";} ?> ><br>  
           <label>Idade:</label> <br>
            <input type=TEXT name=idade  <?php if(isset($_POST["idade"])){echo "value='" . $_POST["idade"]   . "'";} ?> ><br>  
            <br>
            
            <label>Sexo:</label> <br>
            <input type=RADIO name=sexo value="M"  <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "M") {echo  "checked";} ?>>Masculino
            <input type=RADIO name=sexo value="F"  <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "F") {echo  "checked";} ?>>Feminino
            <br> <br>
            
            <label>Qual curso é seu Interesse?</label> <br>
            <input type=CHECKBOX name="humanas"    <?php if(isset($_POST["humanas"]))   {echo "checked";}  ?>  >Ciências Humanas
            <input type=CHECKBOX name="exatas"     <?php if(isset($_POST["exatas"]))    {echo "checked"; } ?>  >Ciências Exatas
            <input type=CHECKBOX name="biologicas" <?php if(isset($_POST["biologicas"])){echo "checked"; } ?>  >Ciências Biologicas 
            <br>
            <br>            
            <label>Estado Civil:</label> 
            <select name="estadocivil">
                <option>Selecione..</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Solteiro(a)") {echo"Selected";} ?> >Solteiro(a)  </option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Casado(a)") {echo"Selected";}   ?> >Casado(a)    </option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Divorcido(a)") {echo"Selected";} ?> >Divorcido(a)</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Viuvo(a)") {echo"Selected";}    ?>  >Viuvo(a)     </option>  
            </select>
            <br>
            <br>
            <label> Senha: </label><br>
            <input type=PASSWORD name="senha"><br>
            <p>
            <button id="reset" type=RESET value="limpar">Limpar</button>
            <button id="sumit" type=SUBMIT value="Enviar">Enviar</button>
             </p>
            
         </form>        
        </div>
        <!-- fecha o bloco php aberto logo abaixo do body -->
        
        <?php
        
        }
        
        ?>


    <!-- botão flutuante inicio-->
 <div class="fab">
  <button class="main" onclick="void(0)">
  </button>
  <ul class="button">
     <li>
      <label for="opcao1">contato</label>
      <button id="opcao1">
      ☏ 
      </button>
      <label for="opcao2">Videos</label>
      <button id="opcao2">
      🎦
      </button>
      <label for="opcao3">Mp3</label>
      <button id="opcao3">
      🎶
      </button>
     <label for="opcao4">Imagens</label>
      <button id="opcao4">
      🖼      
      </button>

      
      </ul>
</div>
</li>
</ul></div></td></tr></table>

<script type="text/javascript">
function toggleFAB(fab){
  if(document.querySelector(fab).classList.contains('show')){
    document.querySelector(fab).classList.remove('show');
  }else{
    document.querySelector(fab).classList.add('show');
  }
}

document.querySelector('.fab .main').addEventListener('click', function(){
  toggleFAB('.fab');
});

document.querySelectorAll('.fab ul li button').forEach((item)=>{
  item.addEventListener('click', function(){
    toggleFAB('.fab');
  });
});
</script>
<!-- botão flutuante fim-->
<div class="top-rodape" align="center">
	<hr>
	<div>
  <ul>
  <li><a href="https://www.educacao.ba.gov.br/">SEC</a></li>
  <li><a href="http://www.educacao.ba.gov.br/midias/fotos">Midiotecas</a></li>
  <li><a href="https://www.bahia.ba.gov.br/sites-do-governo/">Site do Governo</a></li>
  <li><a href="http://estudantes.educacao.ba.gov.br/">Estudantes</a></li>
  <li><a href="http://institucional.educacao.ba.gov.br/">Institucional</a></li>
  <li><a href="http://escolas.educacao.ba.gov.br/">Escolas</a></li>
  </ul>
</div>

<p>
Endereço: Av. Esperanto, s/n - Centro, Itapetinga - BA, 45700-000
</p>


<p>Telefone: (77) 3261-1219</p>

<br>
	Todos os Direitos Reservados: Prof:.Ubiratan Ferreira</div>
</body>
</html>