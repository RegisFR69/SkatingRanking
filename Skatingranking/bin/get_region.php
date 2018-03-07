<?php
/* ******************************
 *  ##### lib/getRegion.php #####
 * ******************************
 * @author regis COQUELET
 * @version 17 février 2018
 */
    $id = $_GET['id'];
    require_once 'class_Regions.php';
    $region = new Regions();
    echo $region->code($id);

