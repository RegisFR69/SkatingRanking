<?php
/** # lib/class/class_Sex.php #
 * Description of Sex
 * @property array sex Tableau de string
 * @method string name(int) Retourne le nom de la catégorie
 * @method int id(string) Retourne l'id d'une catégorie
 * @author regis COQUELET
 * @version 17 février 2018
 */
class Sex {

    private $_sex;

    public function __construct() {
        $this->_sex = [
            0 => 'Unknow',
            1 => 'Femme',
            2 => 'Homme',
            3 => 'Couple',
        ];
    }

    public function name($id) {
        if ( key_exists($id,$this->_sex) ) { return $this->_sex[$id]; }
        else { return $this->_sex[0]; }
    }

    public function Id($sex) {
        return intval(array_search($sex, $this->_sex));
    }

    // Retourne un select html de la catégorie sex
    function affichageSelect() {
        $returnValue = '<select id="sex">';
        foreach ($this->_sex as $key => $name) {
            $returnValue = $returnValue.'<option value="'.$key.'">';
            $name = ( $key == 0 ) ? 'Général' : $name;
            $returnValue = $returnValue.$name.'</option>';
        }
        $returnValue = $returnValue.'</select>';

        return $returnValue;
    }
}