<?php

    class Model{
        private $driver = 'mysql';

        private $host = 'localhost';

        private $dbname = 'sistemat';

        private $port = '3306';

        private $user = 'root';

        private $password = null;

        protected $table;

        protected $conex;


        public function __construct(){
            //descobre o nome da tabela
            $tbl = strtolower(get_class($this));
            $tbl .= 's';
            $this->table = $tbl;

            $this->conex = new PDO("{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->user, $this->password);


        }

        public function getAll(){
                $sql=$this->conex->query("SELECT * FROM {$this->table}");

                return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getById($id){
            $sql=$this->conex->prepare("SELECT * FROM {$this->table} where id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            return $sql->fetch(PDO::FETCH_ASSOC);
    }
    }
    //query() = executa a consulta direto
    //prepare() = aguarda os binds e só executa depois do execute()
    //fetchAll pega todos os valores
    //fetch pega só um 