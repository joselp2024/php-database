<?php

namespace App\Controllers;  
use Database\PDO\Connection;

class IncomesController{

    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance()->get_database_instance();
    }



    public function index(){
    
        $stmt = $this->connection->prepare("SELECT * FROM incomes");
        $stmt->execute();

        $results = $stmt->fetchAll();

        require("../resources/views/incomes/index.php");

        //con el bindColumn
        // while($stmt->fetch()){ //mientras hay una fila fetch nos devolvera esa fila haciendo un ciclo
        //     echo "Ganaste ".$amount." USD en: ". $description."\n";
        // }
        //aunque da error, bindCoumn asigna el valor a la variable interna.
    
        

        //sin el bindColumn
        // while($row=$stmt->fetch()){ //mientras hay una fila fetch nos devolvera esa fila haciendo un ciclo
          //  echo "Ganaste ".$row["amount"]." USD en: ". $row["description"]."\n";
       // }

    }

    public function create(){

        require("../resources/views/incomes/create.php");
    }
    public function store($data){

        $stmt = $this->connection->prepare("INSERT INTO incomes (payment_method,type,date, amount, description) 
        VALUES(:payment_method,:type,:date, :amount, :description);");
    
        $stmt->bindValue(":payment_method", $data["payment_method"]);
        $stmt->bindValue(":type", $data["type"]);
        $stmt->bindValue(":date", $data["date"]);
        $stmt->bindValue(":amount", $data["amount"]);
        $stmt->bindValue(":description", $data["description"]);
        
        $stmt->execute();

        header("location: incomes");
        
    }
    public function show($id){

        $stmt = $this->connection->prepare("SELECT * FROM incomes WHERE id =:id ");
        $stmt->execute([
            ":id"=> $id
        ]);

        

    }
    public function edit(){
    }
    public function update($data , $id){

        $stms= $this->connection->prepare("UPDATE incomes SET
            payment_method = :payment_method,
            type = :type,
            time = :time,
            amount = :amount,
            description = :description
            WHERE id= :id");


        $stms->execute([
            ":id"=>$id,
            ":payment_method" => $data["payment_method"],
            ":type" => $data["type"],
            ":time" => $data["time"],
            ":amount" => $data["amount"],
            ":description" => $data["description"]
        ]);


    }
    public function destroy($id){

        

        $stmt = $this->connection->prepare("DELETE  FROM incomes WHERE id = :id");
        $stmt->execute([
            ":id"=>$id
        ]);

        
    }
}

