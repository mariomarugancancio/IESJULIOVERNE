<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prematrícula</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/app.css">
  <link rel="stylesheet" type="text/css" href="../css/prematriculas.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">

</head>

<body>
  <?php
    include('nav.php');
  ?>
   <section style="font-size: 16px;">

    <a href="../prematricula/cursos/ESO/index.php" id="eso">
        Educación Secundaria Obligatoria
        <img src="../images/ESO.png" alt="Partes1">
        <img src="../images/clase2.png" alt="Imagen Prematricula2">
    </a>
      
      <a href="../prematricula/cursos/Bachillerato/index.php" id="bachillerato">
        Bachillerato
        <img src="../images/bachillerato.jpg" alt="Partes1">
        <img src="../images/clase2.png" alt="Imagen Prematricula2">
      </a>

      <a href="../prematricula/cursos/Ciclo-Formativo/index.php" id="fp">
        Ciclo Formativo
        <img src="../images/fp.jpg" alt="imagen Inventario1">
        <img src="../images/clase2.png" alt="Imagen Prematricula2">
      </a>

      <a href="../prematricula/cursos/PEFP/index.php" id="pefp">
        PEFP
        <img src="../images/pefp.jpg" alt="Imagen Prematricula1">
        <img src="../images/clase2.png" alt="Imagen Prematricula2">
      </a>
      <a href="../prematricula/datos/index.php" id="datos">
        Datos de las matrículas
        <img src="../images/asignaturas1.webp" alt="Datos1">
        <img src="../images/clase2.png" alt="Datos2">
    </a>
    </section> 

  <?php
  include('footer.php');
  ?>
   <?php

        if(isset($_SESSION["usuario_login"]["rol"])){
        if($_SESSION["usuario_login"]["rol"] == 0){
          print '<script>
          document.getElementById("datos").style.display="block";
          </script>';
        }else{
            print '<script>
            document.getElementById("datos").style.display="none";
            </script>';
          }
        }else{
          print '<script>
          document.getElementById("datos").style.display="none";
          </script>';
        }
      ?>
</body>

</html>