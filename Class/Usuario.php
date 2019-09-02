<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    //Gets e Sets
    function getIdusuario() {
        return $this->idusuario;
    }

    function getDeslogin() {
        return $this->deslogin;
    }

    function getDessenha() {
        return $this->dessenha;
    }

    function getDtcadastro() {
        return $this->dtcadastro;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setDeslogin($deslogin) {
        $this->deslogin = $deslogin;
    }

    function setDessenha($dessenha) {
        $this->dessenha = $dessenha;
    }

    function setDtcadastro($dtcadastro) {
        $this->dtcadastro = $dtcadastro;
    }

    //Função para realizar um select no BD buscando um usuário por ID
    public function loadById($id) {
        $sql = new Sql();

        //Chamando metodo "select" da classe SQL passando os paramêtros: comando sql e array para preparação do comando sql
        $result = $sql->select("SELECT * FROM tb_usuario WHERE idUsuario = :ID", array(
            ":ID" => $id
        ));

        //Testando se a contulta não retornou vazio e atribuindo o resultado ao objeto usuário
        if (isset($result[0])) {
             $this->setData($result[0]);
        }
    }

    //Metodo para permitir a escrita do objeto
    public function __toString() {
        //Configurando a escrita do objeto usuário no formato json
        return json_encode(array(
            "idUsuario" => $this->getIdusuario(),
            "desLogin" => $this->getDeslogin(),
            "desSenha" => $this->getDessenha(),
            "dtCadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

    //Metodo para buscar todos os usuários do BD
    public function getList() {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin;");
    }

    //Meotodo para buscar usuários pelo Login ou opor parte do login
    public function search($login) {

        $sql = new Sql();

        //Utilizando comando SQL com LIKE para buscar qualquer registro que contenha no login o conteúdo infomeado pela variável login
        return $sql->select("SELECT * FROM tb_usuario WHERE desLogin LIKE :SEARCH ORDER BY desLogin", array(
                    ':SEARCH' => "%" . $login . "%"
        ));
    }

    //Metodo para retornar as informações do usuário após validar seu login e sua senha
    public function login($login, $password) {

        $sql = new Sql();

        //Chamando metodo "select" da classe SQL passando os paramêtros: comando sql e array para preparação do comando sql
        $result = $sql->select("SELECT * FROM tb_usuario WHERE desLogin = :LOGIN AND desSenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $password
        ));

        //Testando se a contulta não retornou vazio e atribuindo o resultado ao objeto usuário
        if (isset($result[0])) {
            $this->setData($result[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos");
        }
    }

    //Metodo para setar os argumento (variáveis) da classe Usuários
    public function setData($data) {

        $this->setIdusuario($data['idUsuario']);
        $this->setDeslogin($data['desLogin']);
        $this->setDessenha($data['desSenha']);
        $this->setDtcadastro(new DateTime($data['dtCadastro']));
        
    }

    //Metodo para inserir usuário via storeprocedure retornando os dados recem inseridos
    public function insert() {

        $sql = new Sql();

        //Chamando a store procedure para inserção do usuário
	$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }
    
    //Metodo para fazer update do login e senha do usuário
    public function update($login, $password){
        
        $this->setDeslogin($login);
        $this->setDessenha($password);
        
        $sql = new Sql();
        
        $sql->query("UPDATE tb_usuario SET desLogin = :LOGIN, desSenha = :PASSWORD WHERE idUsuario = :ID", array(
            ":LOGIN"=> $this->getDeslogin(),
            ":PASSWORD"=> $this->getDessenha(),
            ":ID"=> $this->getIdusuario()
        ));       
        
    }

        //Metodo construtor para preenchimento do login e senha diretamente no instanciamento do objeto
    public function __construct($login = "", $password = "") {

        $this->setDeslogin($login);
        $this->setDessenha($password);
        
    }

}

?>