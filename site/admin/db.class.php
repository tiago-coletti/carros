<?php

class db
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '#Tiago0424'; 
    private $port = '3306';
    private $dbname = 'db_carros'; 
    private $table_name;

    public function __construct($table_name)
    {
        $this->table_name = $table_name;
    }

    function conn()
    {
        try {
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                ]
            );

            return $conn;
        } catch (PDOException $e) {
            echo 'Erro de Conexão: ' . $e->getMessage();
            die();
        }
    }

    public function store($dados)
    {
        $conn = $this->conn();
        $flag = 0;
        $arrayDados = [];

        $sql = "INSERT INTO $this->table_name (";

        foreach ($dados as $campo => $valor) {
            if ($flag == 0) {
                $sql .= "$campo ";
            } else {
                $sql .= ", $campo ";
            }
            $flag = 1;
        }

        $sql .= ') VALUES (';

        $flag = 0;
        foreach ($dados as $campo => $valor) {
            if ($flag == 0) {
                $sql .= '?';
            } else {
                $sql .= ', ?';
            }
            $flag = 1;
            $arrayDados[] = $valor;
        }

        $sql .= ');';

        $st = $conn->prepare($sql);
        $st->execute($arrayDados);
    }

    public function update($dados)
    {
        if(!isset($dados['id'])) { return; }
        
        $id = $dados['id'];
        $conn = $this->conn();
        $flag = 0;
        $arrayDados = [];

        $sql = "UPDATE $this->table_name SET ";

        foreach ($dados as $campo => $valor) {
            if ($campo == 'id') continue; 

            if ($flag == 0) {
                $sql .= "$campo = ? ";
            } else {
                $sql .= ", $campo = ? ";
            }
            $flag = 1;
            $arrayDados[] = $valor;
        }

        $sql .= " WHERE id = ?";
        $arrayDados[] = $id;

        $st = $conn->prepare($sql);
        $st->execute($arrayDados);
    }

    public function find($id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $this->table_name WHERE id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
        return $st->fetchObject();
    }

    public function all()
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $this->table_name";
        $st = $conn->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function destroy($id)
    {
        $conn = $this->conn();
        $sql = "DELETE FROM $this->table_name WHERE id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }

    public function search($dados)
    {
        $campo = preg_replace('/[^a-zA-Z0-9_]/', '', $dados['tipo']);
        $valor = $dados['valor'];

        $conn = $this->conn();
        $sql = "SELECT * FROM $this->table_name WHERE $campo LIKE ?";
        $st = $conn->prepare($sql);
        $st->execute(["%$valor%"]);

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function login($dados)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $this->table_name WHERE login = ?";
        $st = $conn->prepare($sql);
        $st->execute([$dados['login']]);

        $result = $st->fetchObject();

        if ($result && password_verify($dados['senha'], $result->senha)) {
            return $result;
        } else {
            return 'error';
        }
    }

    function checkLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['login'])) {
            session_destroy();
            header('Location: ../login.php?error=Sessao Expirada!');
            exit;
        }
    }
}