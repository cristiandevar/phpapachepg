<?php

define("PROJECT_ROOT_PATH", __DIR__ . "/../");
// include main configuration file 
require_once PROJECT_ROOT_PATH . "/inc/config.php";
class Database
{
    // protected $connection = null;
    protected $host = null;
    protected $port = null;
    protected $user = null;
    protected $password = null;
    // protected $configFile = PROJECT_ROOT_PATH."/inc/config.php";
    
    public function __construct()
    { 
        // Se verifica si el archivo de configuración existe
        // if (!file_exists($this->configFile)) {
        //     die("Error: El archivo de configuración no existe.");
        // }
        // else{
            // Se lee el archivo de configuración
            // $config = parse_ini_file($this->configFile);
            // $this->host = $config['host'];
            $this->host = DB_HOST;
            // $this->port = $config['port'];
            $this->port = DB_PORT;
            // $this->user = $config['user'];
            $this->user = DB_USERNAME;
            // $this->password = $config['password'];
            $this->password = DB_PASSWORD;
        // }		
    }

    function ejecutar_consulta_db($sql, $db) {
        $conn_string = "host=$this->host port=$this->port dbname={$db} user=$this->user password=$this->password";
        $conn = pg_connect($conn_string);
        $result = pg_query($conn, $sql);
        
        if ( !$result ) {
            echo '<div class="alert alert-danger"><p>No se pudo consultar las BDs</p></div>';
            exit;
        }
        pg_close($conn);
        return $result;
    }
}

?>