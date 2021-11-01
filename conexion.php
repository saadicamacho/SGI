<?php

$clave = "12345678";

$link = mysqli_connect("localhost", "root", $clave,"sgi");

if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}




?>
