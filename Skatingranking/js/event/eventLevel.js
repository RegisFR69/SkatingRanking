/****************************************
 *  #####  js/event/eventLevel.js  #####
 ****************************************
 * Listener
 *  event change
 *  object select id=level
 * @author regis COQUELET
 * @version 17 février 2018
 */
document.getElementById('level').addEventListener('change', function() {
    var classSelect = 'level' + this.value;
    console.log(classSelect);
    hiddenTab();
    setRanking();
});
