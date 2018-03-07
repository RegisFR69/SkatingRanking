<?php
/* ************************************
 *  ##### lib/get_listes_plus.php #####
 * ************************************
 * @author regis COQUELET
 * @version 17 février 2018
 */
require_once 'class_Regions.php';
$regions = new Regions;

require_once 'class_Clubs.php';
$clubs = new Clubs;

require_once 'class_Categories.php';
require_once 'class_Medals.php';
require_once 'CompetitionsClass.php';
require_once 'class_Competitors.php';
require_once 'class_Levels.php';

function get_competiteur_liste($liens){

    $clubs = new Clubs;
    $categories = new Categories;
    $medals = new Medals;
    $competitions = new Competitions;
    $competitors = new Competitors;
    $level = new Levels;

    $page = file_get_contents($liens[0]->url); // Copie la page
    $regex = '/<tr.+?><td.+?>(\d+<\/td>.+?)<\/tr>/'; // Selection des lignes du tableau
    preg_match_all($regex, $page, $matches);
    foreach ($matches[1] as $value) {
        $regex = '/^(\d+)/'; // Commencer à la ligne numérotée
        preg_match($regex, $value, $id);
        if ($id[0] > count($competitors)){
            $regex = '/<td.+?>(.+?)<\/td>/'; // Selection de chaque cellules
            preg_match_all($regex, $value, $informations);
            // tableau du nom des champs
            $tabKeys = ['classementGeneral','classementHomme','classementDame','classementCouple','nom','prenom',
                'club','region','date','sexe','licence','categorie','medaille','scoreFinal','pointsN','pointsAcquis',
                'typeCompetition','scoreCompetition','urlResultat','coefficientCompetition'];
            $i = 0;
            $tabInfos[$tabKeys[$i++]] = $id[0];
            // Suppression des div dans les cellules
                foreach ($informations[1] as $info){
                    if ( preg_match('/<div.+>(.+?)<\/div>/',$info, $infos) == 1 ) {
                        $tabInfos[$tabKeys[$i]] = $infos[1];
                    } else {
                        $tabInfos[$tabKeys[$i]] = $info;
                    }
                    $i++;
                }
            // Refactorisation des données si décalage
                if ( !in_array($tabInfos['sexe'],array('Femme','Homme','Couple')) ){
                    $tabInfos['coefficientCompetition'] = $tabInfos['urlResultat'];
                    $tabInfos['scoreCompetition'] = $tabInfos['typeCompetition'];
                    $tabInfos['typeCompetition'] = $tabInfos['pointsAcquis'];
                    $tabInfos['pointsAcquis'] = $tabInfos['pointsN'];
                    $tabInfos['medaille'] = $tabInfos['categorie'];
                    $tabInfos['categorie'] = $tabInfos['licence'];
                    $tabInfos['licence'] = $tabInfos['sexe'];
                    $tabInfos['sexe'] = $tabInfos['date'];
                    $tabInfos['date'] = $tabInfos['region'];
                }
            // Création des variables pour la création d'un nouveau compétiteur
                $idCompetitor = $tabInfos['classementGeneral'];
                switch ($tabInfos['sexe']) {
                    case 'Femme':
                        $ranking = $tabInfos['classementDame'];
                        break;
                    case 'Homme':
                        $ranking = $tabInfos['classementHomme'];
                        break;
                    case 'Couple':
                        $ranking = $tabInfos['classementCouple'];
                        break;
                }
                $lastName = $tabInfos['nom'];
                $firstName = $tabInfos['prenom'];
                $idClub = $clubs->add($tabInfos['club'],$tabInfos['region']);
                $birthDate = $tabInfos['date'];
                $sex = $tabInfos['sexe'];
                $licenseNumber = $tabInfos['licence'];
                $idLevel = $level->id($tabInfos['categorie']);
                $idCategory = $categories->id($tabInfos['categorie']);
                $idMedal = $medals->id($tabInfos['medaille']);
                $scorePreviousYear = $tabInfos['pointsAcquis'];
                $idCompetition =  $competitions->add($tabInfos['typeCompetition'], $tabInfos['coefficientCompetition']);
                $competitionScore = $tabInfos['scoreCompetition'];
            // Création du nouveau compétiteur
                $competitors->add($idCompetitor, $ranking, $lastName, $firstName, $idClub, $birthDate,
             $sex, $licenseNumber, $idCategory, $idMedal, $scorePreviousYear, $idCompetition, $competitionScore);
        }
    }
    return $competitors;
}

