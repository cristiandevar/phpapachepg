                <?php
                    // Importamos header
                    require __DIR__.'/header.php';

                    // Corroboramos que la variable db se haya pasado en la URL
                    if(isset($_GET['db'])){
                        echo "<h5 class='card-title'>Tablas de ".htmlspecialchars($_GET['db'])."</h5>";
                    }
                    else{
                        echo "<h5 class='card-title'>No se pueden mostrar las tablas</h5>";
                    }

                ?>
                <div  style=' height: 30em;overflow-y: auto;'>
                    <table class="table table-hover table-bordered table-striped ">
                        <thead style='position: sticky; top: 0;'>
                            <tr>
                            <th scope="col">Esquema</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Filas</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-table">	
                            <?php 
                                // Importamos los archivos necesarios para crear una conexión
                                require_once __DIR__."/inc/bootstrap.php";
                                
                                //Controlamos nuevamente si db fue enviada por la URL
                                if(isset($_GET['db'])){
                                    
                                    $db = htmlspecialchars($_GET['db']);
                                    $conn = new DataBase();
                                    $query = "
                                    SELECT 
                                        pg_tables.schemaname AS table_schema,
                                        pg_tables.tablename AS table_name, 
                                        pg_roles.rolname AS table_owner
                                    FROM 
                                        pg_tables 
                                    INNER JOIN 
                                        pg_roles ON rolname = tableowner
                                    WHERE pg_tables.schemaname = 'public'
                                    ;"
                                    ;
                                        
                                    $result = $conn->exec_query_db($query, $db);
                                    // Corroboramos si se genero un error
                                    if ($result) {
                                        // Cargamos las filas con la informacion de las tablas de la BD seleccionada anteriormente
                                        while ($table = pg_fetch_assoc($result)) {
                                            // Contamos la cantidad de filas de cada tabla
                                            $query = "select count(0) as qty from ".$table['table_name'].";";
                                            
                                            $rows = pg_fetch_assoc($conn->exec_query_db($query, $db));
                                            
                                            echo "<tr id='{$db}-{$table['table_name']}'>";
                                            echo "<td>{$table['table_schema']}</td>";
                                            echo "<td>{$table['table_name']}</td>";
                                            echo "<td>{$table['table_owner']}</td>";
                                            echo "<td>{$rows['qty']}</td>";
                                            // Agregamos un link para ver las filas de cada tabla
                                            echo "<td><a href='#'>Ver</a></td>";
                                            echo "</tr>";
                                            
                                        }
                                    }
                                    else{
                                        echo "
                                            <div class='alert alert-danger' style='heigth:5em;'>
                                                <p>
                                                    Ocurrio un error al conectarse a la BD
                                                </p>
                                            </div>";
                                    }
                                
                                }
                                else{
                                    echo "
                                    <div class='alert alert-danger' style='heigth:5em;'>
                                        <p>
                                            Debe volver al Inicio y seleccionar una BD
                                        </p>
                                    </div>";
                                }
                            ?>
                        </tbody>
                    </table> 
                </div>
                <div class="row mb-3">
                    <!-- Agregamos link para regresar a la pagina anterior -->
                    <a href="index.php" class="btn btn-primary col-12 col-sm-5 m-1">Volver</a>
                </div>

            </div>
        </div>
        <script src="./js/script-tables.js"></script>
<?php
    require __DIR__.'/footer.php'
?>