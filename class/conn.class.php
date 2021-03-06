<?php
class Conn{
    public $dbhost;
    public $dbuser;
    public $dbpwd;
    public $dbname;
    public $dsn;
    public $conn;

    public function __construct(){}
    protected function connect(){
        $this->dbhost = getenv('VCAH');
        $this->dbuser = getenv('VCAU');
        $this->dbpwd = getenv('VCAPW');
        $this->dbname = getenv('VCAD');
        $this->dbport = getenv('VCAPT');
        $this->dsn = "pgsql:host=".$this->dbhost." user=".$this->dbuser." password=".$this->dbpwd." port=".$this->dbport." dbname=".$this->dbname;
        $this->conn = new PDO($this->dsn);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function pdo(){
      if (!$this->conn){ $this->connect();}
      return $this->conn;
    }
    public function __destruct(){ if ($this->conn){ $this->conn = null; } }
}

?>
