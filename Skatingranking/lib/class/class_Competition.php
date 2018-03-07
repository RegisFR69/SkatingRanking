<?php
/** # lib/class_Competition.php #
 * Description of Competition
 * @property-read int id Identifiant
 * @property-read string name Nom (\w{6,7})
 * @property-read date minAge Age minimum
 * @property-read date minAgeN1 Age minimum catégorie N1
 * @property-read date maxAge Age maximum
 * @author regis
 * @version 10 février 2018
 */
class Competition {
    private $_id; // Identifiant
    private $_name; // Nom de la competition
    private $_coefficient; // coefficient multiplicateur pour le calcul des points annuels

    // Instancie une competition
    public function __construct($id, $name, $coefficient) {
        $this->setId($id);
        $this->setName($name);
        $this->setCoefficient($coefficient);
    }

    /** Accesseurs ( Gettters )
     * @access public
     */
    public function id() {return $this->_id; }
    public function name() { return $this->_name; }
    public function coefficient() { return $this->_coefficient; }

    /** Mutateurs ( Setters )
     * @access private
     */
    private function setId($id) { $this->_id = $id; }
    private function setName($name) { $this->_name = $name; }
    private function setCoefficient($coefficient) { $this->_coefficient = $coefficient; }

}
