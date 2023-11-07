<?php
// phpinfo();
// exit;
echo "<h1>Título del ejemplo modificado hoy</h1>";
$conn_string = "host=postgres port=5432 dbname=dellstore user=postgres password=postgres";
$db = pg_connect($conn_string) or die("No se pudo realizar la conexión");
$result = pg_query($db, "SELECT * FROM products where 1=2;");
if (!$result) {
  echo "Ocurrió un error.\n";
  exit;
}
$r_affected = pg_affected_rows($result);
echo "<p>Nro de filas obtenidas: $r_affected </p>";
echo pg_connection_status($db);
// while ($row = pg_fetch_row($result)) {
//   echo "id: $row[0]  descrip: $row[1]";
//   echo "<br />\n";
// }
// while ($row = pg_fetch_assoc($result)) {
//   echo "id: $row[0]  descrip: $row[1]";
//   echo "<br />\n";
// }
?>