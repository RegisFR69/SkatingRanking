<?php
/* *******************************************
 *  ##### lib/mainHeaderView.php #####
 * *******************************************
 * Description of mainHeaderView
 * print regional select in <main><header>
 * @requires object Regions
 * @author regis COQUELET
 * @version 18 février 2018
 */
require_once 'lib/class/class_Regions.php';

function mainHeaderView() {
    // new object
        $regions = new Regions();
    echo '<header>';
    echo '<h2 id="regionHeader">Toutes régions</h2>';
    echo $regions->affichageSelect();
    echo '</header>';
}