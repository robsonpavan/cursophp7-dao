<?php

class Sql extends PDO{
    
    private $conn;
    
    //Conectando-se ao banco de dados
    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","robsonp","sdckk9y");
    }
    
    //Metodo para associar os parâetros
    private function setParams($statement, $parameters = array()){
        
        //Varrendo o array com a lista de parâmetros passados para utilização no comando sql
        foreach($parameters as $key => $value){        
            $this->setParam($statement,$key, $value);
        } 
    }
    
    //Metodo para setoar os parâmetros
    private function setParam($statement, $key, $value){
        //Realizando o bind dos parâmetros
        $statement->bindParam($key, $value);
    }  
    
    //Preparando o comando sql para ser executado
    //$rawQuery = comando SQL que será tratado (receberá as váriávies no lugar das ???
    //$parms = parametros a serem substituídos no comando SQL
    public function query($rawQuery, $params = array()){
        
        //Declarando que o comando SQL será tratado
        $stmt = $this->conn->prepare($rawQuery);
        
        //Associando os parâmetros ao comando SQL, chamando o metodo setParms para subtituir a "variável" do comando sql pelo valor a ser utilizado
        $this->setParams($stmt, $params);
        
        //Executando o comando SQL
        $stmt->execute();
        
        //Retornando o objeto com resultados
        return $stmt;
    }
     
    //Metodo para realizar Select
    public function select($rawQuery, $params = array()):array {
        //Utilizando o metodo "query" para prepara o Select e receber o retorno da excução do comando SQL
        $stmt = $this->query($rawQuery, $params);
        //Devolvendo o array com o valores trazidos pelo Select
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }    
}

?>