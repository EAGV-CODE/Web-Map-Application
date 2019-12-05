<?php 
	if (isset($_POST['name'])) {
		$name=$_POST['name'];
	} else {
		$name="NA";
	}
	if (isset($_POST['image'])) {
			$image=$_POST['image'];
		} else {
			$image="NA";
		}
	if (isset($_POST['web'])) {
			$web=$_POST['web'];
		} else {
			$web="NA";
		}
	if (isset($_POST['category'])) {
			$category=$_POST['category'];
		} else {
			$category="NA";
		}
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
	if (isset($_POST['id'])  && is_numeric($_POST['id'])) {
			$id=$_POST['id'];
		} else {
			$id="-9999";
		}


	$db = new PDO('pgsql:host=localhost;port=5433;dbname=webmap;','postgres','19CHIle75');
	$sql = $db->prepare("UPDATE cdmex_attractions SET name=:nm, image=:im, web=:wb, category=:ct, geom=ST_SetSRID(ST_MakePoint(:lng, :lat), 4326) WHERE id=:id");
	$params = ["nm"=>$name, "im"=>$image, "wb"=>$web, "ct"=>$category, "lng"=>$longitude, "lat"=>$latitude, "id"=>$id];
	if ($sql->execute($params)) {
		echo "{$name} succesfully updated";
	} else {
		echo var_dump($sql->errorInfo());
	}

?>
