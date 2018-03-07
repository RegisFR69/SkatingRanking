<?php
/** # lib/class/class_Regions.php #
 * Description of Regions
 * @requires object Region
 * @property array Regions Tableau d'object Region
 * @method string code(int) Retourne le code de la region
 * @method string name(int) Retourne le nom de la region
 * @method string url(int) Retourne l'url de la ligue régionale
 * @method int id(string) Retourne l'id d'un level
 * @method string affichageSelect() Retourne le code html d'un select avec les régions
 * @author regis COQUELET
 * @version 17 février 2018
 */

require_once 'class_Region.php';

class Regions {

    private $_regions;

    // Instancie un tableau des régions
    function __construct() { // région GES : Grand Est, éclatée (01, 11, 07)
        $this->_regions = [
            new Region("00-UNK","Unknow"),
            new Region("01-ALS", "Alsace", "http://www.alsace.ffsg.org/les_disciplines_proposees/patinage_artistique"),
            new Region("02-NAQ", "Nouvelle-Aquitaine", "http://www.aquitaine.ffsg.org/les-disciplines-proposees/patinage-artistique.html"),
            new Region("03-ARA", "Auvergne-Rhône-Alpes", "https://sites.google.com/site/liguedesalpespatinage/home"),
            new Region("04-BFC","Bourgogne Franche-Comté"),
            new Region('05-BRE','Bretagne'),
            new Region('06-CVL','Centre-Val de Loire'),
            new Region("07-CAR",'Champagne-Ardenne'),
            new Region('08-'),
            new Region("09-IDF","île-de-France"),
            new Region("10-OCC","Occitanie"),
            new Region('11-LOR','Lorraine'),
            new Region('12-HDF','Hauts-de-France'),
            new Region("13-NOR","Normandie"),
            new Region("14-PAC","Provence-Alpes-Côte d'Azur"),
            new Region("15-PDL","Pays de la Loire")
        ];
    }

    // Retourne le code à partir de l'id
    function code($id) { return $this->_regions[$id]->code(); }

    // Retourne le nom de la région à partir du code ou de l'id
    function name($value) {
        $id = intval($value);
        return $this->_regions[$id]->name();
    }

    // Retourne l'url de la ligue à partir du code ou de l'id
    function url($value) {
        $id = intval($value);
        return $this->_regions[$id]->url();
    }

    // Retourne l'id à partir du code
    function id($code) { return intval($code); }

    // Retourne un select html des régions
    function affichageSelect() {
        $returnValue = '<select id="region">';
        foreach ($this->_regions as $key => $region) {
            $returnValue = $returnValue.'<option value="'.$key.'">';
            $name = ( $key == 0 ) ? 'toutes régions' : $region->name();
            $returnValue = $returnValue.$name.'</option>';
        }
        $returnValue = $returnValue.'</select>';

        return $returnValue;

    }
}

