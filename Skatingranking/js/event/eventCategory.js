/****************************************
 *  #####  js/event/eventCategory.js  #####
 ****************************************
 * Listener
 *  event change
 *  object select id=cat
 * @author regis COQUELET
 * @version 17 février 2018
 */
document.getElementById('cat').addEventListener('change', function() {
    var classSelect = 'cat' + this.value;
    hiddenTab();
    setRanking();
});

