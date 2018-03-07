/****************************************
 *  #####  js/event/eventRegion.js  #####
 ****************************************
 * Listener
 *  event change
 *  object select id=region
 * @requires function getSelectedText
 * @author regis COQUELET
 * @version 18 février 2018
 */

document.getElementById('region').addEventListener('change', function() {
    id = document.getElementById('region').value;
    document.getElementById('regionHeader').innerHTML = getSelectedText('region');
    var clubs = document.getElementById('club').children;
    for (var i = 0; i < clubs.length; ++i) {
        idOption = clubs[i].getAttribute('region');
    }
    hiddenTab();
    setRanking();
});
