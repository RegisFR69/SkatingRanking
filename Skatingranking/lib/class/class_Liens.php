<?php
/** # lib/class_Liens.php #
 * Description of Liens
 * @requires object Lien
 * @property array Liens Tableau d'object Lien
 * @method string name(int) Retourne le nom du lien
 * @method string url(int) Retourne l'url du lien
 * @author regis
 * @version 10 février 2018
 */
require_once 'class_Lien.php';

class Liens {

    private $_liens;

    public function __construct($url) { // url de la page des classements
        $this->_liens = [];
        $tabRegex = ["French Ranking.+?", "French Ranking.+?Clubs", "Sélectionnables.+?"];
        $page_classements = file_get_contents($url); // enregistre le contenue de la page
        foreach ($tabRegex as &$regex){
            $regex = '/('.$regex.')<.+<a href="(.+?)"/'; // complète les regexs du tableau
            preg_match($regex, $page_classements, $matches);
                $this->setLiens( new Lien($matches[1], $matches[2]) );
        }
    }

    // retourn le nom du lien
    public function name($id) {
        if (key_exists($id, $this->_liens)) { return $this->_liens[$id]->name(); }
    }

    // retourne l'url du lien
    public function url($id) {
        if (key_exists($id, $this->_liens)) { return $this->_liens[$id]->url(); }
    }

    private function setLiens($lien) { array_push($this->_liens, $lien); }

    // Retourne un select html des régions
    function affichageSelect($s = 0) {
        $returnValue = '<select id="links">';
        foreach ($this->_liens as $key => $lien) {
            $returnValue = $returnValue.'<option value="'.$key.'"';
            if ($key == $s) { $returnValue = $returnValue.' selected'; }
            $returnValue = $returnValue.'>'.$lien->name().'</option>';
        }
        $returnValue = $returnValue.'</select>';

        return $returnValue;
    }

}
