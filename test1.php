<?php
$base64 = $_POST['formFile'];
			$IMG = base64_decode($base64);
			$path = './statics/uploads/shaidan/';
			$mulu = $_POST['mulu'];
			file_put_contents($path . $mulu . '.jpg', $IMG);
?>