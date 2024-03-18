<?php
class Dbh {
    public function connect() {
        try {
            $username = 'root';
            $password = '';
            $dbh = new PDO('mysql:host=localhost;dbname=clients_edu_agency', $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getLastInsertId(PDO $dbh) {
        return $dbh->lastInsertId();
    }
}