<?php
require_once "conn.php";

$eid = $_GET['profileid'];
$sql = mysqli_query($conn, "SELECT * FROM estudiante WHERE id='$eid'");
$resultado = mysqli_fetch_array($sql);
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
    <!-- Estilos propios -->
    <style>
        body {
            margin-top: 20px;
            color: #696969;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
            width: 30%;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }
    </style>
    <title>CRUD</title>
</head>

<body>

    <div class="container">
        <div class="main-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" class="main-breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Usuario</a></li>
                    <li class="breadcrumb-item active"><a href="#" aria-current="page">Perfil Usuario</a></li>
                </ol>
            </nav>
            <div class="row g-2">
                <div class="col-md-mb3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="img/avatar.png" alt="Imagen de perfil" class="img-circle">
                                <div class="mt-3">
                                    <h4>
                                        <?php echo $resultado['nombre'] . ' ' . $resultado['apellidos']; ?>
                                        <p class="text-secondary fs-6 mb-1">
                                            <i class="fas fa-mobile fa-xs"></i>
                                            <?php echo $resultado['numero_contacto']; ?>
                                        </p>
                                        <p class="text-muted fs-6">
                                            <i class="fas fa-map-marked-alt fa-xs"></i>
                                            <?php echo $resultado['direccion']; ?>
                                        </p>
                                        <p class="text-muted fs-6">
                                            <i class="fas fa-at fa-xs"></i>
                                            <?php echo $resultado['correo']; ?>
                                        </p>
                                        <button class="btn btn-info">Sigueme</button>
                                        <button class="btn btn-success">Mensaje</button>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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