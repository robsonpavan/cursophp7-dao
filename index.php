<?php


require_once ("config.php");

$sql = new Sql();

$usuario = new Usuario();

$usuario->loadById('2');

echo $usuario;

?>