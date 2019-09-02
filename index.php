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
//$usuario = new Usuario();
//$usuario->login("jose", "senha12");
//echo $usuario;

//Criando um novo usuário
//$aluno = new Usuario("aluno", "@lun0");
//$aluno->insert();
//echo $aluno;

//Atualizando os dados de um usuário
//$usuario = new Usuario();
//$usuario->loadById(7);
//$usuario->update("professor", "sdccf");
//echo $usuario;

//Deletando um usuário
$usuario = new Usuario();
$usuario->loadById(6);
$usuario->delete();
echo $usuario;



?>