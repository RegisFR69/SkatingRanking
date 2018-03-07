<?php
/** # lib/class_Levels.php #
 * Description of Levels
 * @requires object Level
 * @property array levels Tableau de la classe Level
 * @method string code(int) Retourne le code du level
 * @method string name(int) Retourne le nom long du level
 * @method int id(string) Retourne l'id d'un level
 * @method string affichageSelect() Retourne le code html d'un select avec les niveaux
 * @author regis
 * @version 10 février 2018
 */
require_once 'class_Level.php';

class Levels {

    private $_levels;

    public function __construct() {
        $this->_levels = [
            new Level(0, "UNK","Unknow"),
            new Level(1, "N1e","National 1 élite"),
            new Level(2, "N1", "National 1"),
            new Level(3, "N2", "National 2"),
            new Level(4, "N3", "National 3"),
            new Level(5, "R1", "Régional 1"),
            new Level(6, "R2", "Régional 2"),
            new Level(7, "R3", "Régional 3"),
        ];
    }

    /** Accesseurs ( Getters )
     * @access public
     */
    // Retourne le code du level à partir de son id
    public function code($id) {
        if (key_exists($id,$this->_levels)) { return $this->_levels[$id]->code(); }
    }

    // Retourne le nom long du level à partir de son id
    public function name($id) {
        if (key_exists($id,$this->_levels)) { return $this->_levels[$id]->name(); }
    }

    // Retourn l'id d'un level à partir d'une valeur ([N|R][1-3]e?)
    public function id($value) {
        $code = ( preg_match('/([N|R][1-3]e?)/', $value, $matches) == 1 ) ? $code = $matches[1] : "UNK" ;
        foreach ($this->_levels as $key => $level) {
            if ( $level->code() == $code ) { return $key; }
        }
        return 0;
    }

    // Retourne un select html des levels
    function affichageSelect() {
        $returnValue = '<select id="level">';
        foreach ($this->_levels as $key => $level) {
            $returnValue = $returnValue.'<option value="'.$key.'">';
            $name = ( $key == 0 ) ? 'tous niveaux' : $level->name();
            $returnValue = $returnValue.$name.'</option>';
        }

        $returnValue = $returnValue.'</select>';

        return $returnValue;
    }
}
