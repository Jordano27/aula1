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

        public function create($date){
           //inicia a construção do sql
            $sql = "INSERT INTO  {$this->table} ";


        //Prepara os campos e placeholders

        

        //MONTA A CONSULTA
            $sql_fields = $this->sql_fields($date);
        $sql .= " SET {$sql_fields}";


        $insert = $this->conex->prepare($sql);
/*//faz o bind nos valores
        foreach ($date as $field => $value){
            $insert -> bindValue(":{$field}", $value);
        }*/


        //roda a consulta

        $insert->execute($date);
        return $insert->errorInfo();
 
        }

        public function update($date, $id){


        }

        private function sql_fields($date){
            foreach(array_keys($date) as $field){
                $sql_fields[] = "{$field} = :{$field}";
            }
    
           return implode(', ', $sql_fields);
        }
    }
    //query() = executa a consulta direto
    //prepare() = aguarda os binds e só executa depois ;
    //fetchAll pega todos os valores
    //fetch pega só um 
    // $sql_fields = guarda todos os campos
    //adiciona novos valores ao arrey
    //prepare = prepara e executa dps;
    //bindParam = Aguarda execute para fazer bind
    //bindValue = Faz o bind no momento do comando
    
