<?php

header('Content-type: application/x-www-form-urlencoded');
$obj = json_decode($_POST["obj"]);
echo $obj->nombre;
