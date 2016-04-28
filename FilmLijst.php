<?php
//FilmLijst.php
require_once ("Film.php");

class FilmLijst {
    
    private $dbConn;
    private $dbUsername;
    private $dbPassword;
    
    public function __construct(){
        $this->dbConn = "mysql:host=127.0.0.1;dbname=cursusphp;charset=utf8";
        $this->dbUsername = "cursusgebruiker";
        $this->dbPassword = "cursuspwd";
    }

    public function getLijst() {
        $sql = "select id, titel, duurtijd from films order by titel";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $resultSet = $dbh->query($sql);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $film = new Film($rij["id"], $rij["titel"], $rij["duurtijd"]);
            array_push($lijst, $film);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getFilmById($id){
        $sql = "select titel, duurtijd from films where id = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $film = new Film($id, $rij["titel"], $rij["duurtijd"]);
        $dbh = null;
        return $film;
    }

    public function deleteFilm($id){
        $sql = "delete from films where id = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }

    public function createFilm($titel, $duurtijd) {
        if (is_numeric($duurtijd) && $duurtijd > 0 && !empty($titel)) {

            $sql = "insert into films (titel, duurtijd) values (:titel, :duurtijd)";
            $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':titel' => $titel,
                ':duurtijd' => $duurtijd));
            $dbh = null;
        }
    }
    public function updateFilm ($film) {
        $sql = "update films set titel = :titel, duurtijd = :duurtijd where id = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        
        $stmt = $dbh->prepare($sql);
        $resultSet = $stmt->execute(array(
            ':titel' => $film->getTitel(),
            ':duurtijd' => $film->getDuurtijd(),
            ':id' => $film->getId()));
        $dbh = null;
    }

}
