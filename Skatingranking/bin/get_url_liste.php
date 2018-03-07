<?php
/* *********************************
 * ##### lib/ger_url_liste.php #####
 * *********************************
 */
// retourne un tableau avec les trois listes :
// $titre : 'French Ranking 20XX/20XX' ou 'French Ranking 20XX/20XX Club' ou 'Selectionnables France 20XX/20XX'
// $url : le lien vers la liste
function get_url_liste($url_classement){

    class lien
    {
        public $titre;
        public $url;
    }
    $returnValue = [];
    $FrenchRanking = "French Ranking.+?";
    $FrenchRankingClub = "French Ranking.+?Clubs";
    $Selectionnables = "Sélectionnables.+?";
    $tabRegex = [$FrenchRanking, $FrenchRankingClub, $Selectionnables];
    $page_classements = file_get_contents($url_classement);
    $matches = [];
    foreach ($tabRegex as &$regex){
        $regex = '/('.$regex.')<.+<a href="(.+?)"/';
        preg_match($regex, $page_classements, $matches);
        $lien = new lien;
        $lien->titre = $matches[1];
        $lien->url = $matches[2];
        array_push($returnValue, $lien); 
    }
    return $returnValue;   
}
