<?php
/** ##### lib/functions/rowExtract.php #####
 * Description of rowExtract
 * @requires object Categories
 * @requires object Medals
 * @requires object Levels
 * @requires object Regions
 * @attribut string value chaine html contenue dans un <tr>
 * @attribut object clubs (par référence)
 * @attribut object competitions (par référence)
 * @attribut object competitors (par référence)
 * @return int id identifiant du nouveau competitor
 * @author regis
 * @version 18 février 2018
 */
require_once 'lib/class/class_Categories.php';
require_once 'lib/class/class_Medals.php';
require_once 'lib/class/class_Levels.php';
require_once 'lib/class/class_Regions.php';

function rowExtract($value, &$clubs, &$competitions, &$competitors) {
    static $ranking = 0;
    static $idCompetitor = 0;
    $levels = new Levels();
    $categories = new Categories();
    $medals = new Medals();
    $lastName = 'Nom'; $firstName = 'Prénom';
    $club = 'Club'; $region = 'Région';
    $birthDate = 'JJ/MM/AAAA'; $sex = 'Sexe'; $licenseNumber = 'Licence';
    $category = 'UNK Unknow'; $medal = 'Médaille';
    $scorePreviousYear = 0; $competition = 'Compétition'; $competitionScore = 0; $coefficient = 0;
    $regex = '/<td.*?>(.*?)<\/td>/'; // Selection de chaque cellules
    preg_match_all($regex, $value, $informations);
    $i = 0;
    foreach ($informations[1] as $info){
        $info = ( preg_match('/<div.*>(.*?)<\/div>/',$info, $infos) == 1 ) ? $infos[1] : $info ;
        switch ($i) {
            case 0 : // classement général
                if (is_numeric($info) && $info == ($ranking + 1)){ $ranking = $info; }
                else { return FALSE; }
                break;
            case 1 : // Classement Homme
            case 2 : // Classement Femme
            case 3 : // Classement Couple
                if ( !is_numeric($info) ) { return FALSE; }
                break;
            case 4 : // Nom
                $lastName = $info;
                break;
            case 5 : // Prénom
                $firstName = $info;
                break;
            // 6- Séparation
            case 7 : // Club
                $club = $info;
                break;
            case 8 : // Région
                $region = $info;
                break;
            case 9 : // Naissance
                $birthDate = $info;
                break;
            case 10 : // Sexe
                $sex = $info;
                break;
            case 11 : // Licence
                $licenseNumber = $info;
                break;
            case 12 : // Catégorie
                $category = $info;
                break;
            case 13 : // Médaille
                $medal = $info;
                break;
            // 14-Score final, 15-Pts N
            case 16 : // Pts N-1
                $scorePreviousYear = $info;
                break;
            case 17 : // Type de compétition
                $competition = $info;
                break;
            case 18 : // Score compétition
                $competitionScore = $info;
                break;
            // 19-Url résultat
            case 20 : // Coéficient
                $coefficient = $info;
                break;
        }
        $i++;
    }
    $idCompetition = $competitions->add($competition, $coefficient);
    if ($sex == "Couple") {
        $lastNameCouple = preg_split('/\//', $lastName);
        $firstNameCouple = preg_split('/\//', $firstName);
        $clubCouple = preg_split('/\//', $club);
        $regionCouple = preg_split('/\//', $region);
        $licenseNumberCouple = preg_split('/\//', $licenseNumber);
        $lastName = $lastNameCouple[0];
        $firstName = $firstNameCouple[0];
        $idClub = $clubs->add($clubCouple[0], $regionCouple[0]);
        $licenseNumber = $licenseNumberCouple[0];
        $competitors->add($idCompetitor, $ranking, $lastName, $firstName, $idClub, $birthDate, $sex,
                 $licenseNumber, $category, $medal, $scorePreviousYear, $idCompetition, $competitionScore);
        $idCompetitor++;
        $lastName = $lastNameCouple[1];
        $firstName = $firstNameCouple[1];
        $club = ( count($clubCouple) == 2 ) ? $clubCouple[1] : $clubCouple[0];
        $region = ( count($regionCouple) == 2) ? $regionCouple[1] : $regionCouple[0];
        $licenseNumber = ( count($licenseNumberCouple) == 2 ) ? $licenseNumberCouple[1] : $licenseNumberCouple[0];
    }
    $idClub = $clubs->add($club, $region);
    $competitors->add($idCompetitor, $ranking, $lastName, $firstName, $idClub, $birthDate, $sex,
            $licenseNumber, $category, $medal, $scorePreviousYear, $idCompetition, $competitionScore);
    return $idCompetitor++;
}