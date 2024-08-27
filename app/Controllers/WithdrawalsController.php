<?php

namespace App\Controllers;

use Database\PDO\Connection;

class WithdrawalsController{

    private $connection;

    public function __construct(){
        $this->connection = Connection::getInstance()->get_database_instance();
    }

    public function index(){
        // $stmt = $this->connection->prepare("SELECT * FROM withdrawals");
        // $stmt->execute();

        // $results = $stmt->fetchAll(); //fetchAll devuelve en forma de arreglo todas las filas que existen segun e query
        // var_dump( $results);    

        // foreach( $results as $result ){
        //     echo"gastaste ".$result["amount"]." USD em: ".$result["description"]."\n";




        //esto es usando FetchColumn
        $stmt = $this->connection->prepare("SELECT amount,description FROM withdrawals");
        $stmt->execute();

        $results = $stmt->fetchAll(\PDO::FETCH_COLUMN,0);

        foreach($results as $result){

            echo "gastaste $result USD \n";
        }
    
        
    }
    public function create(){


    }
    public function store($data){


        $stmt = $this->connection->prepare("INSERT INTO withdrawals(payment_method,type,time,amount,description) 
        VALUES (:payment_method,:type,:time,:amount,:description)");

        $stmt->bindValue(":payment_method", $data["payment_method"]);
        $stmt->bindValue(":type", $data["type"]);
        $stmt->bindValue(":time", $data["time"]);
        $stmt->bindValue(":amount", $data["amount"]);
        $stmt->bindValue(":description", $data["description"]);



        $stmt->execute();

    }
    public function show($id){

        $stmt = $this->connection->prepare("SELECT * FROM withdrawals WHERE id =:id ");
        $stmt->execute([
            ":id"=> $id
        ]);


    }

    public function edit(){

    }
    public function update($data , $id){

        $stms= $this->connection->prepare("UPDATE withdrawals SET
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

        $this->connection->beginTransaction();

        $stmt = $this->connection->prepare("DELETE  FROM withdrawals WHERE id = :id");
        $stmt->execute([
            ":id"=>$id
        ]);

        $sure = readline("Realmente quieres eliminar???");

        if($sure == "no"){
            $this->connection->rollBack(); //revierte la transaccion
        }else{
            $this->connection->commit(); //completa la transaccion
        }

    }
}

