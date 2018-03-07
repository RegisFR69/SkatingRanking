<?php
/* *****************************
 * ##### lib/functions.php #####
 * *****************************
 * and open the template in the editor.
 */

function stringToFloat($strValue, $decimal = 2, $dec_point = ',', $thousand_sep = ' ') {
    $pattern = array('/\D{2}/', '/,/');
    $replacement = array('', '.');
    $returnValue = preg_replace($pattern, $replacement, $strValue);
    $returnValue = floatval($returnValue);
    return $returnValue;
}
