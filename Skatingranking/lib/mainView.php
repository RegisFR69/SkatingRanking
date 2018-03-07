<?php
/* *******************************************
 *  ##### lib/mainView.php #####
 * *******************************************
 * Description of mainView
 * print <main>
 * @requires function mainHeaderView
 * @requires function tableView
 * @parameter object clubs
 * @parameter object competitions
 * @parameter object competitors
 * @author regis COQUELET
 * @version 18 février 2018
 */
require_once 'mainHeaderView.php';
require_once 'tableView.php';

function mainView($clubs, $competitions, $competitors) {
    echo '<main>';
    mainHeaderView($clubs, $competitions);
    tableView($clubs, $competitions, $competitors);
    echo '</main>';
}
