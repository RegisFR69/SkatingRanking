<?php
/** # lib/class/class_Medals.php #
 * Description of Medals
 * @property array medals Tableau de string
 * @method string name(int) Retourne le nom de la medaille
 * @method int id(string) Retourne l'id d'une medaille
 * @author regis
 * @version 17 février 2018
 */
class Medals {

    private $_medals;

    public function __construct() {
        $this->_medals = [
            0 => 'Médaille inconnue',
            1 => 'Préliminaire',
            2 => 'Préparatoire',
            3 => 'Pré-Bronze',
            4 => 'Bronze',
            5 => 'Argent',
            6 => 'Vermeil',
            7 => 'Or',
            8 => 'Grande Or',
            9 => 'Platine'
        ];
    }

    public function name($id) {
        if ( key_exists($id,$this->_medals) ) { return $this->_medals[$id]; }
        else { return $this->_medals[0]; }
    }

    public function Id($name) {
        return intval(array_search($name, $this->_medals));
    }

}
