<?php

class db {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $port = 3307;
    private $dbname ="db_pweb1_2024_2_blog";

    public function __construct(){
        $this->conn();
    }

    public function conn(){

        try{
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND =>" SET NAMES utf8"
                ]
            );

            return $conn;

        } catch(PDOException $e){
            echo "Erro: ". $e->getMessage();
        }
    }

    public function insert($dados){

        $conn = $this->conn();

        $sql = "INSERT INTO categoria (nome) VALUES (?)";

        $st = $conn->prepare($sql);

        $st->execute([ $dados['nome'] ]);

    }

    public function all(){

        $conn = $this->conn();

        $sql = "SELECT * FROM categoria";

        $st = $conn->prepare($sql);

        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);

    }

    public function destroy($id){

        $conn = $this->conn();

        $sql = "DELETE FROM categoria WHERE id = ?";

        $st = $conn->prepare($sql);

        $st->execute([$id]);

    }

    public function search($dados){

        $campo = $dados['tipo'];
        $valor = $dados['valor'];

        //var_dump($dados);
        //  exit;

        $conn = $this->conn();

        $sql = "SELECT * FROM categoria WHERE $campo LIKE ?";

        $st = $conn->prepare($sql);

        $st->execute(["%$valor%"]);

        return $st->fetchAll(PDO::FETCH_CLASS);

    }


}