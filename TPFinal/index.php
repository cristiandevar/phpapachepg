<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inicio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <div class="card position-absolute top-50 start-50 translate-middle">
        <h5 class="card-header">TPFinal PADB 2023</h5>
        <div class="card-body">
            <h5 class="card-title">Inicio</h5>
            <p class="card-text">Elija la base de datos con la que quiera interactuar.</p>
            <form action="#" method="get">
                <div class="mb-5">    
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Base de Datos...</option>
                        <?php
                            $conn_string = "host=postgres port=5432 user=postgres password=postgres";
                            $conn = pg_connect($conn_string);
                            if(!$conn) {
                                echo '<div class="alert alert-danger"><p>No se pudo conectar a la BD Postgres</p></div>';
                                exit;
                            }
                            $query = 'select datname from pg_database';
                            $result = pg_query($conn, $query);
                            if ( !$result ) {
                                echo '<div class="alert alert-danger"><p>No se pudo consultar las BDs</p></div>';
                                exit;
                            }
                            while ($row = pg_fetch_row($result)) {
                                echo "<option value='$row[0]'>$row[0]</option>";
                            }
                            pg_close($conn);
                        ?>
                    </select>
                    <hr>
                    <label>Base de datos elegida:</label>
                </div>
                <div class="row mb-3">
                    <button type='submit' class="btn btn-primary col-12 col-sm-5 m-1">Ver Tablas</button>
                    <button type='submit' class="btn btn-primary col-12 col-sm-5 m-1">Ver Sesiones</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>