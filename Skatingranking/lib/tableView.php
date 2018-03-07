<?php
/* *******************************************
 *  ##### lib/tableView.php #####
 * *******************************************
 * Description of tableView
 * print the <table> content
 * @requires function theadView.php
 * @requires function tbodyView.php
 * @parameter object clubs
 * @parameter object competitions
 * @parameter object competitors
 * @author regis COQUELET
 * @version 18 février 2018
 */
require 'lib/theadView.php';
require 'lib/tbodyView.php';

function tableView($clubs, $competitions, $competitors) {
    echo '<table id="classement">';
    theadView($clubs);
    tbodyView($clubs, $competitions, $competitors);
    echo '</table>';
}
