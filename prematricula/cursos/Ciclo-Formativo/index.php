<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ciclo Formativo</title>
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../../css/app.css">
  <link rel="stylesheet" type="text/css" href="../../../css/prematriculas.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body >
 <?php
        include('./../../nav.php');
    ?>
    <section style="font-size: 16px;">

    <a href="Basico/index.php" id="basico">
        FP Grado Basico
        <img src="../../../images/1eso.jpg" alt="basico ">
        <img src="../../../images/clase2.png" alt="basico">
      </a>
      
      <a href="Medio/index.php" id="medio">
      FP Grado Medio
        <img src="../../../images/2eso.jpg" alt="medio">
        <img src="../../../images/clase2.png" alt="medio">
      </a>

      <a href="Superior/index.php" id="superior">
      FP Grado Superior
        <img src="../../../images/3eso.jpg" alt="superior" style="height: 190px">
        <img src="../../../images/clase2.png" alt="superior">
      </a>

    </section>


    <?php
    include('./../../footer.php');
    ?>
</body>
</html>