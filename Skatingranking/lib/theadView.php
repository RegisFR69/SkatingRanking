<?php
/* *******************************************
 *  ##### lib/theadView.php #####
 * *******************************************
 * Description of theadView
 * print the head of the table
 * @requires object Sex
 * @requires object Levels
 * @requires object Categories
 * @author regis COQUELET
 * @version 18 février 2018
 */
require_once 'lib/class/class_Sex.php';
require_once 'lib/class/class_Levels.php';
require_once 'lib/class/class_Categories.php';

function theadView($clubs) {
    echo '<thead>';
    // first row for titles
        echo '<tr>';
        // array of titles of columns
            $tableHeader = ['classement', 'Nom', 'Prénom', 'Club', 'date de naissance', 'Sexe', 'Numero de licence',
            'Catégorie', 'Médaille', 'Score final', 'Points N', 'Points N-1', 'Score compétition'];
        foreach ($tableHeader as $title) {
            echo '<th>'.$title.'</th>';
            }
        echo '</tr>';
    // second row for select and search
        echo '<tr>';
        $sex = new Sex();
        echo '<th>'.$sex->affichageSelect().'</th>';
        echo '<th colspan = "2"><input type = "search" id = "name" name = "q" /><input type = "submit" id="submit" value = "Rechercher" /></th>';
        echo '<th>'.$clubs->affichageSelect().'</th>';
        echo '<th></th><th></th><th></th>';
        $levels = new Levels();
        $categories = new Categories();
        echo '<th>'.$levels->affichageSelect().'<br/>'.$categories->affichageSelect().'</th>';
        echo '<th></th><th></th><th></th><th></th><th></th>';
    echo '</thead>';
}