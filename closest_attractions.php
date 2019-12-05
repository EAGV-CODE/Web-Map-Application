<?php
	if (isset($_POST['latitude'])  && is_numeric($_POST['latitude'])) {
		$latitude=$_POST['latitude'];
	} else {
		$latitude="-90";
	}
	if (isset($_POST['longitude'])  && is_numeric($_POST['longitude'])) {
		$longitude=$_POST['longitude'];
	} else {
		$longitude="-90";
	}

$db = new PDO('pgsql:host=localhost;port=5433;dbname=webmap;','postgres','19CHIle75');
	$sql = $db->prepare("SELECT st_distancesphere(ST_SetSRID(ST_MakePoint(:lng, :lat), 4326), geom)/1000 as dist, name, category, image FROM cdmex_attractions ORDER BY dist LIMIT 5");

	$params = ["lng"=>$longitude, "lat"=>$latitude];
	$sql->execute($params);

	echo "<table class='table table-striped'>";
	echo "	<tr><th>Distance (km)</th><th>Name</th><th>Category</th><th>Image</th></tr>";

	 while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $field=>$value) {
            if ($field=="image"){
                echo "<td><img src='img/{$value}' width='100px'></td>";
            } elseif($field=="dist") {
                echo "<td>".number_format($value, 3)."</td>";
            } else {
                echo "<td>{$value}</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
?>


