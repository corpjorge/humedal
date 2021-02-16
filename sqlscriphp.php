<?php
function conectar_bd(){}
  
$con=mysqli_connect("localhost:3307","root","admin","fyclsing_modulos");
if (!$con) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuraci�n: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuraci�n: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//$con=mysqli_connect("localhost","root","","pqrs");
  
?>