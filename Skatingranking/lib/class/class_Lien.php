<?php
/** # lib/class_Lien.php #
 * Description of Lien
 * @property int id Identifiant
 * @property-read string name Nom du club
 * @property-read int idRegion Identifiant dee la région
 * @property-read string url Url du club
 * @author regis
 * @version 10 février 2018
 */
class Lien {

    private $_name;
    private $_url;

    // Instancie le lien
    public function __construct($name = "", $url = "") {
        $this->setName($name);
        $this->setUrl($url);
    }

    /** Accesseurs ( Getters )
     * @access public
     */
    public function name() { return $this->_name; }
    public function url() { return $this->_url; }

    /** Mutateurs ( Setters )
     * @access private
     */
    public function setName($name) { $this->_name = $name; }
    public function setUrl($url) { $this->_url = $url; }

}
