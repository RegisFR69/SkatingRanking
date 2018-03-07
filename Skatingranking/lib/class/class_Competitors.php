<?php
/** # lib/class_Competitors.php #
 * Description of Competitors
 * @requires object Competitor
 * @property array competitors Tableau de la classe Competitor
 * @method int ranking(int) Retourne le classement général du compétituer
 * @method string lastName(int) Retourne le nom
 * @method string firstName(int) Retourne le prénom
 * @method int idClub(int) Retourne l'identifiant du club
 * @method int birthDate(string) Retourne la date de naissance
 * @method string sex(int) Retourne la catégorie sex
 * @method int licenseNumber(int) Retourne le numéro de licence
 * @method int idLevel(int) Retourne l'identifiant du niveau national ou régional
 * @method int idCategory(int) Retourn l'identifiant de la catégorie d'âge
 * @method int idMedal(int) Retournl'identifiant de la dernière medaille obtenue
 * @method float scorePreviousYear(int) Retourne le meilleur score de l'année N-1
 * @method string idCompetition(int) Retourne l'identifiant de la compétition où à été obtenu 'bestScoreThisYear'
 * @method float bestScoreThisYear(int) Retourne le meilleur score de l'année N
 * @author regis
 * @version 10 février 2018
 */
require_once 'class_Competitor.php';

class Competitors {
    private $_competitors;

    // Instancie un tableau des competiteurs
    public function __construct() { $this->_competitors = [ new Competitor(0,0,'','',0,'','','','','',0,0,0)]; }

    // Retourne le classement par sex à partir de l'id du competiteur
    public function ranking($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->generalRanking(); }
        else { return $this->_competitors[0]->generalRanking(); }
    }

    // Retourne le nom du competiteur
    public function lastName($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->lastName(); }
        else { return $this->_competitors[0]->lastName(); }
    }

    // Retourne le prenom du competiteur
    public function firstName($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->firstName(); }
        else { return $this->_competitors[0]->firstName(); }
    }

    // Retourne de l'id du club du competiteur
    public function idClub($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->idClub(); }
        else { return $this->_competitors[0]->idClub(); }
    }

    // Retourne la date de naissance du competiteur
    public function birthDate($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->birthDate(); }
        else { return $this->_competitors[0]->birthDate(); }
    }

    // Retourne la catégorie homme, dame ou couple
    public function sex($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->sex(); }
        else { return $this->_competitors[0]->sex(); }
    }

    // Retourne le numero de licence
    public function licenseNumber($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->licenseNumber(); }
        else { return $this->_competitors[0]->licenseNumber(); }
    }

    // Retourne l'id categorie du competiteur
    public function idCategory($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->idCategory(); }
        else { return $this->_competitors[0]->idCategory(); }
    }

    // Retourne l'id categorie du competiteur
    public function idLevel($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->idLevel(); }
        else { return $this->_competitors[0]->idLevel(); }
    }

    // Retourne l'id medaille du competiteur
    public function idMedal($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->idMedal(); }
        else { return $this->_competitors[0]->idMedal(); }
    }

    // Retourne l'id medaille du competiteur
    public function scorePreviousYear($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->scorePreviousYear(); }
        else { return $this->_competitors[0]->scorePreviousYear(); }
    }

    // Retourne l'id competition du competiteur
    public function idCompetition($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->idCompetition(); }
        else { return $this->_competitors[0]->idCompetition(); }
    }

    // Retourne le score du competiteur
    public function bestScoreThisYear($id) {
        if (key_exists($id, $this->_competitors)) { return $this->_competitors[$id]->bestScoreThisYear(); }
        else { return $this->_competitors[0]->bestScoreThisYear(); }
    }

    // Alias de exist()
    public function id($lastName, $firstName, $licenseNumber) { return $this->exist($lastName, $firstName, $licenseNumber); }

    // Ajoute un competiteur
    public function add($idCompetitor, $ranking, $lastName, $firstName, $idClub, $birthDate, $sex,
            $licenseNumber, $Category, $medal ,$scorePreviousYear,  $idCompetition, $competitionScore) {
        $id = count($this->_competitors);
        array_push($this->_competitors, new Competitor($id, $ranking, $lastName, $firstName, $idClub, $birthDate, $sex,
            $licenseNumber, $Category, $medal ,$scorePreviousYear, $idCompetition, $competitionScore));
        return $id;
    }

    // Vérifie l'existence d'un competiteur à partir de son nom, prenom et numero de licence et renvoie son id (-1 if not exists)
    public function exist($lastName, $firstName, $licenseNumber) {
        foreach ($this->_competitors as $key => $competitor) {
            if ( $competitor->lastName() == $lastName && $competitor->firstName() == $firstName && $competitor->licenseNumber() == $licenseNumber) {
                return $key; }
        }
        return -1;
    }
    
    public function count() {
        return count($this->_competitors);
    }
}
