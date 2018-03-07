/****************************************
 *  #####  js/hiddenRow.js  #####
 ****************************************
 * Description of hiddenRow
 * @return boolean
 * true if row not matches with all selects
 * @author regis COQUELET
 * @version 17 février 2018
 */
function hiddenRow(rowCompetitor) {
    var classes = rowCompetitor.className.split(" ");
    // Select sex
        var id = 'sex' + document.getElementById('sex').value;
        if (id != 'sex0' && classes.indexOf(id) == -1) { return true; }
    // Select region
        var id = 'region' + document.getElementById('region').value;
        if ( id != 'region0' && classes.indexOf(id) == -1 ) { return true; }
    // Select level
        var id = 'level' + document.getElementById('level').value;
        if ( id != 'level0' && classes.indexOf(id) == -1 ) { return true; }
    // Select category
        var id = 'cat' + document.getElementById('cat').value;
        if ( id != 'cat0' && classes.indexOf(id) == -1 ) { return true; }
    // Select club
        var id = 'club' + document.getElementById('club').value;
        if ( id != 'club0' && classes.indexOf(id) == -1 ) { return true; }
    // Default else
    return false;
}

