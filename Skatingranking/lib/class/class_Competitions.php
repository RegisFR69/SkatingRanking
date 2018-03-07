<?php
/** # lib/class_Competitions.php #
 * Description of Competitions
 * @requires object Competition
 * @property array competitions Tableau de la classe Competition
 * @method int id(string) Retourne l'id d'une compétition
 * @method string name(int) Retourne le nom d'une compétition
 * @method int coefficient(int) Retourne le coefficient d'une competition
 * @method int add() Ajoute une nouvelle compétition et retourne son id
 * @methode int exist(string) Retourne l'id d'une compétition
 * @author regis
 * @version 10 février 2018
 */
require_once 'class_Competition.php';

class Competitions {

    private $_competitions;

    // Instancie un tableau des competitions
    public function __construct() { $this->_competitions = [new Competition(0, 'unknow', 0)]; }

    // Retourne le nom de la competition à partie de l'id
    public function name($id) {
        if (key_exists($id, $this->_competitions)) { return $this->_competitions[$id]->name(); }
        else { return $this->_competitions[0]->name(); }
    }

    // Retourne le coefficient de la competition à partir de l'id
    public function coefficient($id) {
        if (key_exists($id, $this->_competitions)) { return $this->_competitions[$id]->coefficient(); }
        else { return $this->_competitions[0]->coefficient(); }
    }

    // Alias de exist()
    public function id($name) { return $this->exist($name); }

    // Ajoute une competition
    public function add($name, $coefficient) {
        $id = $this->id($name); // Vérifie si la competition existe
        if ( $id == -1 ) { // si non la rajouter et renvoie l'id
            $id = count($this->_competitions);
            array_push($this->_competitions, new Competition($id, $name, $coefficient));
        }
        return $id;
    }

    // Vérifie l'existence d'une competition à partir de son nom et renvoie son id (-1 if not exists)
    public function exist($name) {
        foreach ($this->_competitions as $key => $competition) {
            if ( $competition->name() == $name ) { return $key; }
        }
        return -1;
    }
}
