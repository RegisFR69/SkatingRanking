<?php
/* ************************************
 * ##### lib/class/class_Club.php #####
 * ************************************
 * Description of Club
 * @property-read int id Identifiant
 * @property-read string name Nom du club
 * @property-read int idRegion Identifiant dee la région
 * @property-read string url Url du club
 * @author regis
 * @version 10 février 2018
 */
require_once 'class_Regions.php';

class Club {

    private $_id; // Identifiant
    private $_name; // nom du club
    private $_idRegion; // id de la région du club
    private $_url; // url du site du club

    // Instancie le club
    public function __construct($id, $name, $codeRegion = 0, $url = '') {
        $this->setId($id);
        $this->setName($name);
        $this->setRegion($codeRegion);
        $this->setUrl($url);
    }

    /** Accesseurs ( Getters )
     * @access public
     */
    public function id() {return $this->_id; }
    public function name() { return $this->_name; }
    public function idRegion() { return $this->_idRegion; }
    public function url() { return $this->_url; }

    /** Mutateurs ( Setters )
     * @access private
     */
    private function setId($id) { $this->id = $id; }
    private function setName($name) {
        $this->_name = preg_replace('/NL - /', '' , $name);
        //preg_match("/(NL - )?(.+)/", $name, $matches);
        //$this->_name = $matches[2];
    }

    private function setRegion($codeRegion) {
        $regions = new Regions;
        $this->_idRegion = $regions->id($codeRegion);
        $regions = NULL;
    }
    private function setUrl($url) { $this->_url = $url; }

}
