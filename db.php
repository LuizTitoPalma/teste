<?php

class db_util {

    const limit = 5;
    const site_key = "Alcatéia Web";

    //Para setar o proximo valor de auto incremento
    //Na implantação do DB 
    //ALTER TABLE table_name AUTO_INCREMENT = value;
    // PDO connect
    function connect() {
        $end_fisico = ($_SERVER['DOCUMENT_ROOT'] . substr($_SERVER['PHP_SELF'], 1, strpos($_SERVER['PHP_SELF'], "/", 1)));
        $end_http = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/" . substr($_SERVER['PHP_SELF'], 1, strpos($_SERVER['PHP_SELF'], "/", 1));

        //Define se a conexão é local ou remota..
        if (strpos($end_fisico, "public_html") <= 0) {
            $host = 'localhost';
            $db_name = 'sofrufru';
            $db_user = 'root';
            $db_password = '';
        } else {
            $host = 'projetoecriaca.mysql.dbaas.com.br';
            $db_name = 'projetoecriaca';
            $db_user = 'projetoecriaca';
            $db_password = 'dbx459a2a';
        }
        return new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $db_user, $db_password, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ));
    }

    // Listagem dos dados dos produto por ID (e a imagem de capa)
    function lista_id($id) {
        $pdo = $this->connect();
        $site_key = self::site_key;
        $sql = "select * from produtos where site_key = '$site_key' and id = '$id' order by id asc";
        $query = $pdo->prepare($sql);
        $query->execute();
        $pdo = null; // Desconectar..
        return $query->fetchAll();
    }

    // lista usuário do email
    function lista_user_email($email) {
        $pdo = $this->connect();
        $site_key = self::site_key;

        $protegido = 1;
        
        if ($protegido == 0) {
            $sql = "select * from usuarios where site_key = '$site_key' and email = '$email' order by email asc";
            $query = $pdo->prepare($sql);
        } else {
            $sql = 'select * from usuarios where site_key = :site_key and email = :email order by email asc';
            $query = $pdo->prepare($sql);
            $query->bindValue(':site_key', $site_key);
            $query->bindValue(':email', $email);
        }

        printf($sql);
        
        $query->execute();
        $pdo = null; // Desconectar..
        return $query->fetchAll();
    }

}

?>