<?php


require_once ("config.php");


//Carregs 1 usuário
//$usuario = new Usuario();
//$usuario->loadById('2');
//echo $usuario;

//Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("jo");
//echo json_encode($search);

//Consultar dados do usuário confirmando login e senha
$usuario = new Usuario();
$usuario->login("jose", "senha12");

echo $usuario;

?>