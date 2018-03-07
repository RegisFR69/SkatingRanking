<?php
/* *******************************************
 *  ##### lib/tbodyView.php #####
 * *******************************************
 * Description of tbodyView
 * print competitors informations
 * @requires object Levels
 * @requires object Categories
 * @requires object Medals
 * @requires object Regions
 * @requires object Sex
 * @requires function stringToFloat
 * @author regis COQUELET
 * @version 18 février 2018
 */
require_once 'lib/class/class_Levels.php';
require_once 'lib/class/class_Categories.php';
require_once 'lib/class/class_Medals.php';
require_once 'lib/class/class_Regions.php';
require_once 'lib/class/class_Sex.php';
require_once 'lib/functions/stringToFloat.php';

function tbodyView($clubs, $competitions, $competitors) {
    // Create new objects
        $levels = new Levels();
        $categories = new Categories();
        $medals = new Medals();
        $regions = new Regions();
        $sex = new Sex();
    echo '<tbody>';
    // for each competitor
        $maxId = $competitors->count();  // number of competitor
        for ($i = 2; $i < $maxId-2; $i++) {
            // Calcul Scores
            $bestScoreThisYear = stringToFloat($competitors->bestScoreThisYear($i));
            $pointPreviousYear = stringToFloat($competitors->scorePreviousYear($i));
            $coefficient = $competitions->coefficient($competitors->idCompetition($i));
            $pointThisYear = $bestScoreThisYear * $coefficient;
            $scoreFinal = $pointThisYear + $pointPreviousYear/2;
            // Printing row
            echo '<tr id="comp'.$i.'" class = "'. // include class to hide row
                'sex'.$competitors->sex($i).' '.
                'club'.$competitors->idClub($i).' '.
                'level'.$competitors->idLevel($i).' '.
                'cat'.$competitors->idCategory($i).' '.
                'region'.$clubs->idRegion($competitors->idClub($i)).' ">';
            echo '<td>'.$competitors->ranking($i).'</td>';
            echo '<td>'.$competitors->lastName($i).'</td>';
            echo '<td>'.$competitors->firstName($i).'</td>';
            echo '<td>'.$clubs->name($competitors->idClub($i)).'</td>';
            echo '<td class="center">'.$competitors->birthDate($i).'</td>';
            echo '<td>'.$sex->name($competitors->sex($i)).'</td>';
            echo '<td class="center">'.$competitors->licenseNumber($i).'</td>';
            echo '<td class="center">'.$levels->code($competitors->idLevel($i)).' '.
                    $categories->name($competitors->idCategory($i)).'</td>';
            echo '<td>'.$medals->name($competitors->idMedal($i)).'</td>'; // Medal
            echo '<td class="right">'.number_format($scoreFinal, 2, ',', '').'</td>';
            echo '<td class="right">'.number_format($pointThisYear, 2, ',', '').'</td>'; // Pts N
            echo '<td class="right">'.number_format($pointPreviousYear, 2, ',', '').'</td>'; // Pts N-1
            echo '<td class="right">'.number_format($bestScoreThisYear, 2, ',', '').'</td>'; // bestScoreThisYear
            echo '</tr>';
        }
    echo '</tbody>';
}
