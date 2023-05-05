<?php
require_once "conn.php";

if (isset($_POST['update'])) {
    // Regresamos el id origin al del registro
    $edi = $_GET['editid'];
    // Los valores de formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $numero_contacto = $_POST['numero_contacto'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    $sql = mysqli_query($conn, "UPDATE estudiante SET nombre='$nombre', apellidos='$apellidos', numero_contacto='$numero_contacto', correo='$correo', direccion='$direccion' WHERE id='$edi'");

    if ($sql) {
        echo "<script>alert('Se ha realizado la actualizacion correctamente');</script>";
        echo "<script>document.location='index.php';</script>";
    } else {
        echo "<script>alert('Oops... Ha ocurrido un error!!!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- datatables -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"
        integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CRUD</title>
</head>

<body>

    <div class="container" style="width: 50%;">
        <div class="row">
            <div class="col-md-12">
                <h2>Editando registro</h2>
            </div>
        </div>
        <!-- Formulario -->
        <form method="post">
            <?php
            $eid = $_GET['editid'];
            $sql = mysqli_query($conn, "SELECT * FROM estudiante WHERE id='$eid'");
            while ($fila = mysqli_fetch_array($sql)) {
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre">Nombre</label>
                        <input value="<?php echo $fila['nombre'] ?>" type="text" name="nombre" class="form-control"
                            placeholder="Nombre" required />
                    </div>
                    <div class="col-md-6">
                        <label for="apellidos">Apellidos</label>
                        <input value="<?php echo $fila['apellidos'] ?>" type="text" name="apellidos" class="form-control"
                            placeholder="Apellidos" required />
                    </div>
                </div>

                <!--  -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="numero_contacto">Numero de contacto</label>
                        <input value="<?php echo $fila['numero_contacto'] ?>" class="form-control" type="number"
                            name="numero_contacto" id="numero_contacto" placeholder="Numero de contacto" required />
                    </div>
                </div>

                <!--  -->
                <div class="row">
                    <div class="col-md-12">
                        <label for="correo">Correo</label>
                        <input value="<?php echo $fila['correo'] ?>" class="form-control" type="email" name="correo"
                            id="correo" placeholder="Correo" required />
                    </div>
                </div>
                <!--  -->
                <div class="row">
                    <div class="col-md-12">
                        <label for="direccion">Direccion</label>
                        <input value="<?php echo $fila['direccion'] ?>" class="form-control" type="text" name="direccion"
                            id="direccion" placeholder="Direccion" required />
                    </div>
                </div>
            <?php } ?>
            <!--  -->
            <div class="row" style="margin-top:1%">
                <div class="col-md-6">
                    <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
                    <a href="./index.php" class="btn btn-success">Ver registros</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Jquery para script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap 5 js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>