<?php
/** # lib/class/class_Competitor.php #
 * Description of Competitor
 * @requires object Levels
 * @requires object Categories
 * @requires object Medals
 * @requires object Sex
 * @property-read int id Identifiant
 * @property-read string lastName Nom
 * @property-read string firstName Prénom
 * @property-read date birthDate Date de naissance
 * @property-read string licenseNumber Numero de licence
 * @property-read string sex Catégorie Homme, Femme ou Couple
 * @property int generalRanking Classement général
 * @property int idClub Identifiant du club
 * @property int idLevel Identifiant du niveau national ou régional
 * @property int idCategory Identifiant de la catégorie d'âge
 * @property int idMedal Identifiant de la dernière medaille obtenue
 * @property float scorePreviousYear Meilleur score de l'année N-1
 * @property string idCompetition Identifiant de la compétition où à été obtenu 'bestScoreThisYear'
 * @property float bestScoreThisYear Meilleur score de l'année N
 * @author regis COQUELET
 * @version 17 février 2018
 */
require_once 'class_Levels.php';
require_once 'class_Categories.php';
require_once 'class_Medals.php';
require_once 'class_Sex.php';

class Competitor {
    private $_id;
    private $_generalRanking;
    private $_lastName;
    private $_firstName;
    private $_idClub;
    private $_birthDate;
    private $_sex;
    private $_licenseNumber;
    private $_idLevel;
    private $_idCategory;
    private $_idMedal;
    private $_scorePreviousYear;
    private $_idCompetition;
    private $_bestScoreThisYear;

    public function __construct($id, $ranking, $lastName, $firstName, $idClub, $birthDate, $sex,
            $licenseNumber, $category, $medal, $scorePreviousYear, $idCompetition, $competitionScore) {
        $this->setGeneralRanking($ranking);
        $this->setId($id);
        $this->setLastName($lastName);
        $this->setFirstName($firstName);
        $this->setBirthDate($birthDate);
        $this->setLicenseNumber($licenseNumber);
        $this->setSex($sex);
        $this->setCategory($category);
        $this->setIdMedal($medal);
        $this->setScorePreviousYear($scorePreviousYear);
        $this->setBestScoreThisYear($competitionScore);
        $this->setIdCompetition($idCompetition);
        $this->setIdClub($idClub);
    }

    /** Accesseurs ( Gettters )
     * @access public
     */
    public function id() { return $this->_id; }
    public function generalRanking() { return $this->_generalRanking; }
    public function lastName() { return $this->_lastName; }
    public function firstName() { return $this->_firstName; }
    public function idClub() { return $this->_idClub; }
    public function birthDate() {
        if (is_a($this->_birthDate,'DateTime')) { return date_format($this->_birthDate,'d/m/Y'); }
        else { return ''; }
    }
    public function sex() { return $this->_sex; }
    public function licenseNumber() { return $this->_licenseNumber; }
    public function idLevel() { return $this->_idLevel; }
    public function idCategory() { return $this->_idCategory; }
    public function idMedal() { return $this->_idMedal; }
    public function scorePreviousYear() { return $this->_scorePreviousYear; }
    public function idCompetition() { return $this->_idCompetition; }
    public function bestScoreThisYear() { return $this->_bestScoreThisYear; }

    /** Mutateurs ( Setters )
     * @access private
     */
    private function setId($id) { $this->_id = $id; }
    private function setLastName($lastName) { $this->_lastName = $lastName; }
    private function setFirstName($firstName) { $this->_firstName = $firstName; }
    private function setBirthDate($birthDate) {
        $date = DateTime::createFromFormat('j/m/Y',$birthDate);
        $this->_birthDate = $date;
    }
    private function setLicenseNumber($licenseNumber) { $this->_licenseNumber = $licenseNumber; }
    private function setSex($sex) {
        $Sex = new Sex();
        $this->_sex = $Sex->Id($sex);
        $Sex = NULL;
    }

    /** Mutateurs ( Setters )
     * @access public
     */
    public function setGeneralRanking($generalRanking) { $this->_generalRanking = $generalRanking; }
    public function setIdClub($idClub) { $this->_idClub = $idClub; }
    public function setCategory($category) {
        if ( preg_match('/([N|R][1-3]e?) (\w{6,7})/', $category, $matches) == 1 ) {
            $levels = new Levels();
            $this->_idLevel = $levels->id($matches[1]); // recupère l'id du level à partir du code
            $levels = NULL;
            $categories = new Categories();
            $this->_idCategory = $categories->id($matches[2]); // récupère l'id de la categorie à partir du nom
            $categories = NULL;
        } else {
            $this->_idLevel = 0;
            $this->_idCategory = 0;
        }
    }
    public function setIdMedal($medal) {
        $medals = new Medals();
        $this->_idMedal = $medals->id($medal); // récupère l'id de la medaille à partir du nom
        $medals = NULL;
    }
    public function setScorePreviousYear($scorePreviousYear) { $this->_scorePreviousYear = $scorePreviousYear; }
    public function setIdCompetition($idCompetition) { $this->_idCompetition = $idCompetition; }
    public function setBestScoreThisYear($bestScoreThisYear) { $this->_bestScoreThisYear = $bestScoreThisYear; }

}
