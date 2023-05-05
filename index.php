<?php
require_once "conn.php";

if (isset($_GET['deleteid'])) {
    $id = intval($_GET['deleteid']);
    $sql = mysqli_query($conn, "DELETE FROM estudiante WHERE id='$id'");
    echo "<script>alert('El registro fue eliminado correctamente');</script>";
    echo "<script>window.location='index.php';</script>";
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
    <style>
        .centrado {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 form-group">
                <h3>Lista de registros</h3>
                <a href="insert.php" class="btn btn-success float-end mb-2"><i class="fa-regular fa-plus"></i>Agregar
                    registro</a>
                <a href="generar_pdf.php"> PDF</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" name="myInput" id="myInput" placeholder="Buscar..." class="form-control">
                </div>
                <div class="table-responsive mt-3">
                    <table class="table-striped-columns table table-hover table-borderless table-striped">
                        <thead class="table-dark">
                            <th>#</th>
                            <th class="centrado">Nombre</th>
                            <th class="centrado">Apellido</th>
                            <th class="centrado">Telefono</th>
                            <th class="centrado">Correo</th>
                            <th class="centrado">Direccion</th>
                            <th class="centrado">Fecha de creacion</th>
                            <th class="centrado">Acciones</th>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            require_once "conn.php";

                            // Paginacion
                            if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                                $page_no = $_GET['page_no'];
                            } else {
                                $page_no = 1;
                            }
                            $registros_totales_por_pagina = 10;
                            $offset = ($page_no - 1) * $registros_totales_por_pagina;
                            $pagina_previa = $page_no - 1;
                            $pagina_siguente = $page_no + 1;
                            $adjuste = "2";

                            $contador_resultado = mysqli_query($conn, "SELECT COUNT(*) as registros_totales FROM estudiante");
                            $registros_totales = mysqli_fetch_array($contador_resultado);
                            $registros_totales = $registros_totales['registros_totales'];
                            $numero_totales_paginas = ceil($registros_totales / $registros_totales_por_pagina);
                            $second_last = $numero_totales_paginas - 1;


                            $sql = mysqli_query($conn, "SELECT * FROM estudiante ORDER BY nombre LIMIT $offset, $registros_totales_por_pagina");
                            $contador = 1;
                            $fila = mysqli_num_rows($sql);
                            if ($fila > 0) {
                                while ($fila = mysqli_fetch_array($sql)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $contador; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['nombre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['apellidos']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['numero_contacto']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['correo']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['direccion']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['fecha_alta']; ?>
                                        </td>
                                        <td>
                                            <a href="profile.php?profileid=<?php echo htmlentities($fila['id']); ?>"
                                                class="btn btn-primary btn-sm"><i class="fa-regular fa-eye fa-xs"></i>
                                                Ver</a>
                                            <a href="edit.php?editid=<?php echo htmlentities($fila['id']); ?>"
                                                class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square fa-xs"></i>
                                                Editar</a>
                                            <a href="index.php?deleteid=<?php echo htmlentities($fila['id']); ?>"
                                                onclick="return confirm('Estas seguro de querer eliminar este registro?');"
                                                class="btn btn-danger btn-sm"><i class="fa-regular fa-trash-can fa-xs"></i>
                                                Eliminar</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $contador += 1;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="...">
                    <ul class="pagination justify-content-end">
                        <li class="page-item" <?php if ($page_no <= 1) {
                            echo "class='disabled'";
                        } ?>><a class="page-link" <?php if ($page_no > 1) {
                             echo "href='?page_no=$pagina_previa'";
                         } ?>>Anterior</a>
                        </li>
                        <?php
                        if ($registros_totales_por_pagina <= 10) {
                            for ($i = 1; $i <= $numero_totales_paginas; $i++) {
                                if ($i == $page_no) {
                                    echo "<li class='active'><a class='page-link'>$i</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$i'>$i</a></li>";
                                }
                            }
                        } elseif ($numero_totales_paginas > 10) {
                            if ($page_no <= 4) {
                                for ($i = 1; $i < 8; $i++) {
                                    if ($i == $page_no) {
                                        echo "<li class='active'><a class='page-link'>$i</a></li>";
                                    } else {
                                        echo "<li><a class='page-link' href='?page_no=$i'>$i</a></li>";
                                    }
                                }
                                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$numero_totales_paginas'>$numero_totales_paginas</a></li>";
                            } else if ($page_no > 4 && $page_no < $numero_totales_paginas - 4) {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                for ($i = $page_no - $adjuste; $i <= $page_no + $adjuste; $i++) {
                                    if ($i == $page_no) {
                                        echo "<li class='active'><a>$i</a></li>";
                                    } else {
                                        echo "<li><a class='page-link' href='?page_no=$i'>$i</a></li>";
                                    }
                                }
                            }
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$numero_totales_paginas'>$numero_totales_paginas</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";
                            for ($i = $numero_totales_paginas - 6; $i <= $numero_totales_paginas; $i++) {
                                if ($i == $page_no) {
                                    echo "<li class='active'><a class='page-link'>$i</a></li>";
                                } else {
                                    echo "<li><a class='page-link' href='?page_no=$i'>$i</a></li>";
                                }
                            }
                        }
                        ?>
                        <li class="page-item" <?php if ($page_no >= $numero_totales_paginas) {
                            echo "class='disabled'";
                        } ?>>
                            <a class="page-link" <?php if ($page_no < $numero_totales_paginas) {
                                echo "href='?page_no=$pagina_siguente'";
                            } ?>>Siguente</a>
                        </li>
                        <?php if ($page_no < $numero_totales_paginas) {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$numero_totales_paginas'>Ultima</a></li>";
                        } ?>
                    </ul>
                </nav>
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

    <!-- JS para hacer el buscador -->
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                let valor = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1)
                })
            })
        })
    </script>
</body>

</html>