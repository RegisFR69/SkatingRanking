<?php
/* *******************************************
 *  ##### lib/headerView.php #####
 * *******************************************
 * Description of headerView
 * print the <header>
 * @requires object Liens
 * @parameter object liens
 * @parameter int id
 * @author regis COQUELET
 * @version 18 février 2018
 */
require 'lib/class/class_Liens.php';

function headerView($liens, $id){
    echo '<header>';
    echo '<h1 id="title">'.$liens->name($id).'</h1>';
    echo $liens->affichageSelect($id);
    echo '</header>';
    return $liens->url($id);
}


