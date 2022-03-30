<?php
    if(empty($_GET['ficha']) or !isset($_GET['ficha'])){
        header ('location: ./main.php');
    }else{
        require_once('./cfg/db.php');

        $inserta = "Insert into doc_personales_cliente
                    Select  codempresa, correserva, nit, ruta, coddocumento, documento, usuariogenera, fechacreacion, observacion
                    from doc_personales_cliente_eliminado
                    where correserva = " .$_GET['ficha'];

        // $inserta = "select * from doc_personales_cliente where correserva = 123";
        
        $confirm = Query($inserta);

        if ($confirm){
            echo "<hr>";
            echo "<div class='alert alert-dismissible alert-success'>";
            echo "  <p class='mb-0 text-center'>Documentos recuperados correctamente<br>Por favor verifique el sistema ahora.</p>";
            echo "</div>";
        }else{
            echo "<hr>";
            echo "<div class='alert alert-dismissible alert-danger'>";
            echo "  <p class='mb-0 text-center'>No pudieron recuperarse los documentos solicitados<br>Por favor intente de nuevo más tarde.</p>";
            echo "</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando...</title>
    <link rel="shortcut icon" href="./img/Icono.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <center><a href="./main.php" class="btn btn-info">Volver</a></center>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>