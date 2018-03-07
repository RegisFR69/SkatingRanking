<?php
/* *******************************************
 *  ##### lib/class/class_Categories.php #####
 * *******************************************
 * Description of Levels
 * @requires object Category
 * @property array categories Tableau de la classe Category
 * @method string name(int) Retourne le nom de la catégorie
 * @method int minAge(int) Retourne l'age minimum
 * @method int minAgeN1(int) Retourne l'age minimum en N1
 * @method int maxAge(int) Retourne l'age maximum
 * @method int id(string) Retourne l'id d'une catégorie
 * @method string affichageSelect() Retourne le code html d'un select avec les catégories
 * @author regis COQUELET
 * @version 17 février 2018
 */
require_once 'class_Category.php';

class Categories {

    private $_categories;

    public function __construct() {
        $this->_categories = [
            new Category(0, 'Unknow'),
            new Category(1, 'Poussin', 0, 0, 8),
            new Category(2, 'Avenir', 8, 0, 10),
            new Category(3, 'Minime', 10, 0, 13),
            new Category(4, 'Novice', 13, 0, 15),
            new Category(5, 'Junior', 15, 13, 19),
            new Category(6, 'Senior', 19, 15, 100),
            new Category(7, 'Adulte', 19, 19, 100)
        ];
    }
    /** Accesseurs ( Getters )
     * @access public
     */
    // Retourne le nom de la catégorie à partir de son id
    public function name($id) {
        if (key_exists($id,$this->_categories)) { return $this->_categories[$id]->name(); }
    }

    // Retourne le nom de la catégorie à partir de son id
    public function minAge($id) {
        if (key_exists($id,$this->_categories)) { return $this->_categories[$id]->minAge(); }
    }

    public function minAgeN1($id) {
        if (key_exists($id,$this->_categories)) { return $this->_categories[$id]->minAgeN1(); }
    }

    public function maxAge($id) {
        if (key_exists($id,$this->_categories)) { return $this->_categories[$id]->maxAge(); }
    }

    // Retourn l'id d'une catégorie à partir d'une valeur (\w{6,7})
    public function id($value) {
        $name = ( preg_match('/(\w{6,7})/', $value, $matches) == 1 ) ? $code = $matches[1] : "Unknow" ;
        foreach ($this->_categories as $key => $category) {
            if ( $category->name() == $name ) { return $key; }
        }
        return 0;
    }

    // Retourne un select html des categories
    function affichageSelect() {
        $returnValue = '<select id="cat">';
        foreach ($this->_categories as $key => $category) {
            $returnValue = $returnValue.'<option value="'.$key.'">';
            $name = ( $key == 0 ) ? 'toutes catégories' : $category->name();
            $returnValue = $returnValue.$name.'</option>';
        }
        $returnValue = $returnValue.'</select>';

        return $returnValue;
    }
}

