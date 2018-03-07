/***************************************
 *  #####  js/event/eventLinks.js  #####
 ***************************************
 * Listener
 *  event change
 *  object select id=links
 * @author regis COQUELET
 * @version 17 février 2018
 */
document.getElementById('links').addEventListener('change', function() {
    window.location = 'index.php?id=' + this.value;
});

