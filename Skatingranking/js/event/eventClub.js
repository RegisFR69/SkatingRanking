/****************************************
 *  #####  js/event/eventCategory.js  #####
 ****************************************
 * Listener
 *  event change
 *  object select id=club
 * @author regis COQUELET
 * @version 17 février 2018
 */
document.getElementById('club').addEventListener('change', function() {
    //var classSelect = 'club' + this.value;
    hiddenTab();
    setRanking();
});

