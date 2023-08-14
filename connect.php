<?php
class Connect{
    public $server;
    public $dbname;
    public$uname;
    public $pass;

    public function __construct(){
        $this->server = "localhost";
        $this->dbname = "shop_gcc200209";
        $this->uname = "root";
        $this->pass = "";
    }


    // option1 : mysqli => Select 
    // dễ bị SQL injection 

    function connectToMySQL():mysqli{
        $conn = new mysqli($this->server,$this->uname,$this->pass,$this->dbname);

        if($conn->connect_error){
            die("Failed ".$conn->connect_error);
        }else{
        }
        return $conn;
    }

    //option 2 : PDO
    function connectToPDO():PDO{
        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->dbname",$this->uname,
            $this->pass);
        }catch(PDOException $e){
            die("Failed ".$e);
        }
        return $conn;
    }

    //option2 : PDO => 

}


$c = new Connect;
$c->connectToMySQL();
echo "<br>";
$c->connectToPDO();

?>