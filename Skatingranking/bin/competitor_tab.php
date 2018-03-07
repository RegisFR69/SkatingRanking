<?php
/* **********************************
 * ##### lib/competitor_tab.php #####
 * **********************************
 * @deprecate
 */
require_once 'class_Clubs.php';
require_once 'class_Categories.php';
require_once 'class_Medals.php';
require_once 'class_Competitions.php';
require_once 'class_Competitors.php';
require_once 'class_Levels.php';

function competitor_tab($liens){

    $clubs = new Clubs;
    $competitions = new Competitions;
    $competitors = new Competitors;

    $page = file_get_contents($liens->url(0)); // Copie la page

    $regex = '/<tr.+?><td.+?>(\d+<\/td>.+?)<\/tr>/'; // Selection des lignes du tableau
    $regex = '/<tr.*?>(.*?)<\/tr>/';
    preg_match_all($regex, $page, $matches);
    foreach ($matches[1] as $value) {
        // Traitement des lignes du tableau
        if ( $id = rowExtract($value, $clubs, $competitions, $competitors) ) {
            AffichageCompetitor($id, $competitors, $competitions, $clubs);
        }
    }
    $i = 0;
    echo $competitors->count();
    /*while ( $competitors->exist($i) != -1 ) {
        AffichageCompetitor($i, $competitors, $competitions, $clubs);
    }*/
}

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

function AffichageCompetitor($id, $competitors, $competitions, $clubs) {
    $levels = new Levels();
    $categories = new Categories();
    $medals = new Medals();
    $regions = new Regions();
    $bestScoreThisYear = stringToFloat($competitors->bestScoreThisYear($id));
    $pointPreviousYear = stringToFloat($competitors->scorePreviousYear($id));
    $coefficient = $competitions->coefficient($competitors->idCompetition($id));
    $pointThisYear = $bestScoreThisYear * $coefficient;
    $scoreFinal = $pointThisYear + $pointPreviousYear/2;
    echo '<tr id="comp'.$id.'" class = "'.
            $competitors->sex($id).' '.
            $levels->code($competitors->idLevel($id)).' '.
            $regions->code($clubs->idRegion($competitors->idClub($id))).
            '"><td>'.$competitors->ranking($id).'</td>';
    echo '<td>'.$competitors->lastName($id).'</td>';
    echo '<td>'.$competitors->firstName($id).'</td>';
    echo '<td>'.$clubs->name($competitors->idClub($id)).'</td>';
    echo '<td>'.$competitors->birthDate($id).'</td>';
    echo '<td>'.$competitors->sex($id).'</td>';
    echo '<td>'.$competitors->licenseNumber($id).'</td>';
    echo '<td>'.$levels->code($competitors->idLevel($id)).' '.
                $categories->name($competitors->idCategory($id)).'</td>';
    echo '<td>'.$medals->name($competitors->idMedal($id)).'</td>'; // Médaille
    echo '<td>'.number_format($scoreFinal, 2, ',', '').'</td>';
    echo '<td>'.number_format($pointThisYear, 2, ',', '').'</td>'; // Pts N
    echo '<td>'.number_format($pointPreviousYear, 2, ',', '').'</td>'; // Pts N-1
    echo '<td>'.number_format($bestScoreThisYear, 2, ',', '').'</td>'; // bestScoreThisYear
    echo '</tr>';

}

function stringToFloat($strValue, $decimal = 2, $dec_point = ',', $thousand_sep = ' ') {
    $pattern = array('/\D{2}/', '/,/');
    $replacement = array('', '.');
    $returnValue = preg_replace($pattern, $replacement, $strValue);
    $returnValue = floatval($returnValue);
    return $returnValue;
}
