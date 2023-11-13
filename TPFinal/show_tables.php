<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tablas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div class="card position-absolute top-50 start-50 translate-middle">
            <h5 class="card-header">TPFinal PADB 2023</h5>
            <div class="card-body">
                <h5 class="card-title">Tablas de  <?php echo $_GET['db'] ?></h5>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Esquema</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Filas</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>	
                        <?php 
                            require_once __DIR__."/Model/DataBase.php";
                            $db = new DataBase();
                            $query = "
                                select table_schema,table_name 
                                from information_schema.tables
                                where table_type = 'BASE TABLE';"
                            ;
                            $result = $db->ejecutar_consulta_db($query, htmlspecialchars($_GET['db']));
                           
                            while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['table_schema']}</td>";
                            echo "<td>{$row['table_name']}</td>";
                            echo "<td>{$row['firstname']}</td>";
                            echo "<td>{$row['city']}</td>";
                            echo "</tr>";
                            }
                        ?>
                    </tbody>
                    </table> 
            
            
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>