<?php
/* ****************************************
 * ##### lib/class/class_Category.php #####
 * ****************************************
 * Description of Category
 * @property-read int id Identifiant
 * @property-read string name Nom (\w{6,7})
 * @property-read date minAge Age minimum
 * @property-read date minAgeN1 Age minimum catégorie N1
 * @property-read date maxAge Age maximum
 * @author regis COQUELET
 * @version 17 février 2018
 */
class Category {

    private $_id;
    private $_name;
    private $_minAge;
    private $_minAgeN1;
    private $_maxAge;

    function __construct($id, $name, $minAge = 0, $minAgeN1 = 0, $maxAge = 100) {
        $this->setId($id);
        $this->setName($name);
        $this->setMinAge($minAge);
        $this->setMinAgeN1($minAgeN1);
        $this->setMaxAge($maxAge);
    }

    /** Accesseurs ( Gettters )
     * @access public
     */
    public function id() { return $this->_id; }
    public function name() { return $this->_name; }
    public function minAge() { return $this->_minAge; }
    public function minAgeN1() { return $this->_minAgeN1; }
    public function maxAge() { return $this->_maxAge; }

    /** Mutateurs ( Setters )
     * @access private
     */
    private function setId($id) { $this->_id = $id; }
    private function setName($name) { $this->_name = $name; }

    /** Mutateurs ( Setters )
     * @access public
     */
    public function setMinAge($minAge) { $this->_minAge = $minAge; }
    public function setMinAgeN1($minAgeN1) { $this->_minAge = $minAgeN1; }
    public function setMaxAge($maxAge) { $this->_maxAge = $maxAge; }

}
