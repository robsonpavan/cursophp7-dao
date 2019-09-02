<?php

class Usuario{
    
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
    public function loadById($id){
        $sql = new Sql();
        
        //Chamando metodo "select" da classe SQL passando os paramêtros: comando sql e array para preparação do comando sql
        $result = $sql->select("SELECT * FROM tb_usuario WHERE idUsuario = :ID", array(
            ":ID" => $id
        ));
        
        //Testando se a contulta não retornou vazio e atribuindo o resultado ao objeto usuário
        if (isset($result[0])){
            $row = $result[0];
            
            $this->setIdusuario($row['idUsuario']);
            $this->setDeslogin($row['desLogin']);
            $this->setDessenha($row['desSenha']);
            $this->setDtcadastro(new DateTime($row['dtCadastro']));
        
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
    public function getList(){
        
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin;");
        
    }
    
    //Meotodo para buscar usuários pelo Login ou opor parte do login
    public function search($login){
        
        $sql = new Sql();
        
        //Utilizando comando SQL com LIKE para buscar qualquer registro que contenha no login o conteúdo infomeado pela variável login
        return $sql->select("SELECT * FROM tb_usuario WHERE desLogin LIKE :SEARCH ORDER BY desLogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }
    
    //Metodo para retornar as informações do usuário após validar seu login e sua senha
    public function login($login, $password){
        
         $sql = new Sql();
        
        //Chamando metodo "select" da classe SQL passando os paramêtros: comando sql e array para preparação do comando sql
        $result = $sql->select("SELECT * FROM tb_usuario WHERE desLogin = :LOGIN AND desSenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $password
        ));
        
        //Testando se a contulta não retornou vazio e atribuindo o resultado ao objeto usuário
        if (isset($result[0])){
            $row = $result[0];
            
            $this->setIdusuario($row['idUsuario']);
            $this->setDeslogin($row['desLogin']);
            $this->setDessenha($row['desSenha']);
            $this->setDtcadastro(new DateTime($row['dtCadastro']));
        
        } else{
            throw new Exception("Login e/ou senha inválidos");
        }
        
        
    }
    
    
}



?>