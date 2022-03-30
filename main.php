<?php

    $respuesta = array();

    session_start();
    if(empty($_SESSION['nombre'])){
        session_destroy();
        header('location: ./index.php');
    }else if(empty($_GET['ficha']) or !isset($_GET['ficha'])){
        $existe = 0;
    }else{
        $existe = 0;
        require_once('./cfg/db.php');

        $consulta = "Select  codempresa, correserva, nit, ruta, coddocumento, documento, usuariogenera, fechacreacion, observacion
                    from doc_personales_cliente
                    where correserva = " .$_GET['ficha'];
        $lineas = countQuery($consulta);

        if ($lineas == 0){
            $query = "Select  codempresa, correserva, nit, ruta, coddocumento, documento, usuariogenera, fechacreacion, observacion
                 from doc_personales_cliente_eliminado
                 where correserva =  " .$_GET['ficha'];
            $existe = countQuery($query);
            $respuesta = Query($query);
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Developers | Recuperación de Documentos de Clientes</title>
    <link rel="shortcut icon" href="./img/Icono.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-secondary">
<hr>
<script>
    function mostrarExiste(){
        let siModal = document.getElementById('btnModalExiste');
        siModal.click();
    }
    function mostrarNoExiste(){
        let noModal = document.getElementById('btnModalNoExiste');
        noModal.click();
    }
    function qInserta(){
        let pagInsertar = './process.php?ficha=<?=$_GET['ficha'];?>';
        location.href = pagInsertar;
    }
</script>
<div class="container-fluid">
    <form id="frmFicha" method="get" class="d-flex justify-content-between align-items-center">
        <div class="form-group align-items-center" >
            <input type="number" name="ficha" id="ficha" placeholder="Número de ficha...">
            <button type="submit" class="btn btn-success">Consultar Ficha</button>
        </div>
        <div class="form-group align-items-center" >
            <a href="./check-logout.php" class="btn btn-dark" class="form-control" type="button">Salir del Módulo</a>
        </div>
    </form>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h1 id="prueba" class="m-0 font-weight-bold text-dark">Recuperación de Documentos de Clientes</h6>
        <img src="./img/Global.png">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tblDocumentos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Reserva</th>
                        <th>NIT</th>
                        <th>Ruta</th>
                        <th>Usuario Genera</th>
                        <th>Fecha de Creación</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
<?php
                foreach ($respuesta as $row){
                    echo '<tr>';
                    echo '<td>'.$row['codempresa'].'</td>';
                    echo '<td>'.$row['correserva'].'</td>';
                    echo '<td>'.$row['nit'].'</td>';
                    echo '<td>'.$row['ruta'].'</td>';
                    echo '<td>'.$row['usuariogenera'].'</td>';
                    echo '<td>'.$row['fechacreacion'].'</td>';
                    echo '<td>'.$row['observacion'].'</td>';
                    echo '</tr>';
                }
?>
                </tbody>
            </table>
        </div>
        <button onClick="qInserta();" type="button" class="btn btn-primary" <?php if(!$existe){ echo 'disabled'; } ?>>Recuperar</button>
    </div>
</div>
</div>
</div>
<!--############################ Button Modal Existe ############################-->
<button hidden id="btnModalExiste" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalExiste">
  x
</button>
<!--############################ FIN Button Modal Existe ############################-->

<!--############################ Modal Existe ############################-->
<div class="modal fade" id="modalExiste" tabindex="-1" aria-labelledby="modalExisteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExisteLabel">Mensaje del Sistema</h5>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <p class="text-center">El numero de documento <b><?=$_GET['ficha']?></b> ya existe!<br>Favor revisar nuevamente en sistema</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--############################ FIN Modal Existe ############################-->
<!--############################ Button Modal NO Existe ############################-->
<button hidden id="btnModalNoExiste" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNoExiste">
  x
</button>
<!--############################ FIN Button Modal NO Existe ############################-->

<!--############################ Modal NO Existe ############################-->
<div class="modal fade" id="modalNoExiste" tabindex="-1" aria-labelledby="modalNoExisteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNoExisteLabel">Mensaje del Sistema</h5>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
      <p class="text-center">El numero de ficha <b><?=$_GET['ficha']?></b> no contiene documentos.<br>Favor verificar el numero de ficha.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--############################ FIN Modal NO Existe ############################-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<?php
if (isset($_GET['ficha'])){
    if ($lineas > 0){
        echo '<script type="text/javascript">',
                'mostrarExiste();',
             '</script>';
    }else if ($existe == 0){
        echo '<script type="text/javascript">',
                'mostrarNoExiste();',
             '</script>';
    }
}
?>
</body>
</html>