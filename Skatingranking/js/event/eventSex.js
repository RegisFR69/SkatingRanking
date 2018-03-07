/*************************************
 *  #####  js/event/eventSex.js  #####
 *************************************
 * Listener
 *  event change
 *  object select id=sex
 * @author regis COQUELET
 * @version 17 février 2018
 */
document.getElementById('sex').addEventListener('change', function() {
    var classSelect = 'sex' + this.value;
    hiddenTab();
    setRanking();
});
