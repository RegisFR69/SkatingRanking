<?php
/* *******************************************
 *  ##### lib/firstPage.php #####
 * *******************************************
 * Description of firstPage
 * @deprecate
 * @author regis COQUELET
 * @version 18 février 2018
 */
function firstPage(){
    $defaultUrl = "https://sites.google.com/site/csnpatinage/saison-2017-2018/classements";
    $returnValue = '<form action="index.php" method="post">';
    $returnValue = $returnValue."Adresse de la page des classements de la csnpa : ";
    $returnValue = $returnValue.'<input type="url" name="url" value = "'.$defaultUrl.'" size = "60" />';
    $returnValue = $returnValue.'<input type="submit" >';
    $returnValue = $returnValue.'</form>';
    return $returnValue;
}

