/****************************************
 *  #####  js/hiddenTab.js  #####
 ****************************************
 * Description of hiddenTab
 *  add or remove css class 'hiddenRow' in the rows
 * @requires function hiddenRow
 * @author regis COQUELET
 * @version 17 février 2018
 */
function hiddenTab() {
    var lignes = document.getElementsByTagName('tbody')[0].children;
    for (i = 0; i < lignes.length; i++) {
        if ( hiddenRow(lignes[i]) ) {
            lignes[i].classList.add('hiddenRow');
        } else {
            lignes[i].classList.remove('hiddenRow');
        }
    }
}


