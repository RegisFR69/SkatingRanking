<?php
/** # lib/class_Level.php #
 * Description of Level
 * @property-read int id Identifiant
 * @property-read string code Code ([N|R][1-3]e?)
 * @property-read string name Nom long
 * @author regis
 * @version 10 février 2018
 */
class Level {

    private $_id;
    private $_code;
    private $_name;

    public function __construct($id, $code, $name) {
        $this->setId($id);
        $this->setCode($code);
        $this->setName($name);
    }

    /** Accesseurs ( Gettters )
     * @access public
     */
    public function id() { return $this->_id; }
    public function code() { return $this->_code; }
    public function name() { return $this->_name; }

    /** Mutateurs ( Setters )
     * @access private
     */
    private function setId($id) { $this->_id = $id; }
    private function setCode($code) { $this->_code = $code; }
    private function setName($name) { $this->_name = $name; }

}
