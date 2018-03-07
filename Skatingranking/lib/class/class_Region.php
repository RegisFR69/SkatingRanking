<?php
/** # lib/class_Region.php #
 * Description of Region
 * @property-read int id Identifiant
 * @property-read string code Code (\d{2}-\w{3})
 * @property-read string name Nom de la région
 * @property-read string url Url du site de la ligue de la région
 * @author regis
 * @version 10 février 2018
 */
class Region {

    private $_id; // Identifiant
    private $_code; // code ISO 3166-2 des régions
    private $_name; // nom de la région
    private $_url; // url du site de la ligue

    // Instancie une région
    function __construct($code,$name = '',$url = ''){
        $this->setId($code);
        $this->setCode($code);
        $this->setName($name);
        $this->setUrl($url);
    }

    /** Accesseurs ( Gettters )
     * @access public
     */
    public function id() {return $this->_id; }
    public function code() { return $this->_code; }
    public function name() { return $this->_name; }
    public function url() { return $this->_url; }

    /** Mutateurs ( Setters )
     * @access private
     */
    private function setId($code) {$this->_id = intval($code); }
    private function setCode($code) { $this->_code = $code; }
    private function setName($name) { $this->_name = $name; }
    private function setUrl($url) { $this->_url = $url; }

}
