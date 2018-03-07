<?php
/* *************************************
 * ##### lib/class/class_Clubs.php #####
 * *************************************
 * Description of Clubs
 * @requires object Clubs
 * @property array Clubs Tableau d'object Club
 * @method int id(string) Retourne l'id d'un club
 * @method string name(int) Retourne le nom du club
 * @method string idRegion(int) Retourne l'id de la region
 * @method string url(int) Retourne l'url du club
 * @method int add() Ajoute un nouveau club et retourne son id
 * @methode int exist(string) Retourne l'id d'un club
 * @method string affichageSelect() Retourne le code html d'un select avec les clubs
 * @author regis COQUELET
 * @version 17 février 2018
 */

require_once 'class_Club.php';

class Clubs {

    private $_clubs;

    // instancie un tableau de clubs
    public function __construct() { $this->_clubs = [new Club(0, 'unknow')]; }

    // retourn le nom du club à partir de l'id du club
    public function name($id) {
        if (key_exists($id,$this->_clubs)) { return $this->_clubs[$id]->name(); }
    }

    // retourn l'id de la région à partir de l'id du club
    public function idRegion($id) {
        if (key_exists($id,$this->_clubs)) { return $this->_clubs[$id]->idRegion(); }
    }

    // retourn l'url du site du club à partir de l'id du club
    public function url($id) {
        if (key_exists($id,$this->_clubs)) { return $this->_clubs[$id]->url(); }
    }

    // Alias de exist()
    public function id($name) { return $this->exist($name); }

    // ajoute un club
    public function add($name, $codeRegion = 0, $url = '') {
        $name = preg_replace('/NL - /', '', $name);
//echo ' nom: '.$name.' region: '.$codeRegion.'<br>';
        $id = $this->exist($name); // vérifie si le club existe déjà
        if ( $id == -1 ) { // si non le rajouter et renvoie l'id
            $id = count($this->_clubs);
            array_push($this->_clubs, new Club($id, $name, $codeRegion, $url));
        }
        return $id;
    }

    // Vérifie l'existence d'un club à partir de son nom et renvoie son id (-1 if not exists)
    public function exist($name) {
        foreach ($this->_clubs as $key => $club) {
            if ( $club->name() == $name ) { return $key; }
        }
        return -1;
    }

    // Retourne un select html des clubs
    function affichageSelect() {
        $returnValue = '<select id="club">';
        foreach ($this->_clubs as $key => $club) {
            $returnValue = $returnValue.'<option value="'.$key.'" region="'.$club->idRegion().'">';
            $name = ( $key == 0 ) ? 'tous les clubs' : $club->name();
            $returnValue = $returnValue.$name.'</option>';
        }
        $returnValue = $returnValue.'</select>';

        return $returnValue;
    }

}
