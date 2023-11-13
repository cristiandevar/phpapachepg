<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ejemplo con bootstrap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Ejemplo con bootstrap</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php 
	// ------------------------------------------------------
	// Acceso a datos del script
	// ------------------------------------------------------
	$conn = pg_connect("host=localhost port=5432 dbname=northwind user=postgres password=postgres");
	if (!$conn) {
		echo "No fue posible conectar la BD\n";
		exit;
	}
	$result = pg_query($conn, "
		SELECT employeeid, lastname, firstname, city 
		FROM employees
		ORDER BY 2,3
		LIMIT 10;");
	if (!$result) {
		echo "Error al acceder a tabla de empleados.\n";
		exit;
	}
	$paises = pg_query($conn, "
		SELECT descripcountry, country 
		FROM countries
		ORDER BY descripcountry;");
	if (!$paises) {
		echo "Error al acceder a tabla de paises.\n";
		exit;
	}

?>
<body>
  
<div class="container">
	<h1>Mi primera página con Bootstrap</h1>
	<p>
	Esta página hace uso de html, bootstrap y conexión a datos de una base de datos postgres, por cada acceso a los datos verifica que no se haya producido error.
	</p>
	<hr/>	
	<div class="container" style="max-width: 15cm;">
		<form class="row g-2">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email address</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
		    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="exampleCheck1">
		    <label class="form-check-label" for="exampleCheck1">Check me out</label>
		  </div>
		  <div class="form-group">
			<select class="form-select">
			  <option selected>Seleccione un país</option>
			  <?php
					while ($row = pg_fetch_assoc($paises)) {
					    echo "<option value='{$row['country']}'>{$row['descripcountry']}</option>";
					}
			  ?>	  
			</select>	  
		  </div>	  
		  <div class="form-group">
		  	<button type="submit" class="btn btn-primary me-1">Submit</button>
		  </div>
		</form> 
	</div>
	<hr />
	<h3>Empleados</h3>	
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">First</th>
	      <th scope="col">Last</th>
	      <th scope="col">City</th>
	    </tr>
	  </thead>
	  <tbody>	
		<?php 
			while ($row = pg_fetch_assoc($result)) {
			 echo "<tr>";
			 echo "<td>{$row['employeeid']}</td>";
			 echo "<td>{$row['lastname']}</td>";
			 echo "<td>{$row['firstname']}</td>";
			 echo "<td>{$row['city']}</td>";
			 echo "</tr>";
			}
		?>
	  </tbody>
	</table>          
</div>

</body>
</html>



