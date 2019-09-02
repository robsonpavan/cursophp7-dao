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

    public function loadById($id){
        $sql = new Sql();
        
        $result = $sql->select("SELECT * FROM tb_usuario WHERE idUsuario = :ID", array(
            ":ID" => $id
        ));
        
        if (isset($result[0])){
            $row = $result[0];
            
            $this->setIdusuario($row['idUsuario']);
            $this->setDeslogin($row['desLogin']);
            $this->setDessenha($row['desSenha']);
            $this->setDtcadastro(new DateTime($row['dtCadastro']));
        
        }
        
    }
    
    public function __toString() {
        return json_encode(array(
            "idUsuario" => $this->getIdusuario(),
            "desLogin" => $this->getDeslogin(),
            "desSenha" => $this->getDessenha(),
            "dtCadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
    
}



?>