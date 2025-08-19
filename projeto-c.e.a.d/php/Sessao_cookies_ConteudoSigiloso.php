<?php
ob_start();
?>
<html>
    <head>
        <title>sessão e cookies: Conteudo Sigiloso</title>
        <link rel="stylesheet" type="text/css" href="css/theme-sigiloso.css">
    </head>
    <body>

  <div align="right" id=corpo >
        <font color="white" size="3" style="tahoma">
            
<?php echo "Hoje é " . date("d/m/Y") . "<br>"; ?> [ Este ambiente é  privado / Sigiloso ]
</font></div>

       <?php
        session_start();
        
        if(!isset($_SESSION["usuario"]))
        {
            echo "<p> erro </p>";
            exit();
        }
        
        echo"<h1> Olá, ". $_SESSION["usuario"];

        echo"</h1>";
        
        ?>
    
       

      </body>
</html>

<?php
ob_flush();
?>