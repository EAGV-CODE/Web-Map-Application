<?php
	if(isset($_POST['id'])  && is_numeric($_POST['id'])) {
		$id=$_POST['id'];
	} else {
		$id="-9999";
	}

$db = new PDO('pgsql:host=localhost;port=5433;dbname=webmap;','postgres','19CHIle75');
	$sql = $db->prepare("DELETE FROM cdmex_attractions WHERE id=:id");
	$params = ["id"=>$id];
	if ($sql->execute($params)) {
		echo "Attraction succesfully deleted";
	} else {
		echo var_dump($sql->errorInfo());
	}
?>