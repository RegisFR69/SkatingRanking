/****************************************
 *  #####  js/event/submit.js  #####
 ****************************************
 * Listener
 *  event click
 *  object button research
 * @author regis COQUELET
 * @version 17 février 2018
 */
document.getElementById('submit').addEventListener('click', function() {
    var searchName = document.getElementById('name').value;
    var pattern = searchName.toUpperCase();
    var rows = document.getElementsByTagName('tbody');
    var row = rows[0].children;
    for (var i = 0; i < row.length; i++) {
        var value = row[i].childNodes[1].innerHTML;
        var subject = value.toUpperCase();
        if (subject.search(pattern) != -1 ) {
            document.location.href="#comp" + (i-5);
            selectRow = document.getElementById("comp" + (i+2)).style;
            selectRow.backgroundColor = '#0B7E2A';
            selectRow.color = 'white';
            return;
        } else {
            var value = row[i].childNodes[2].innerHTML;
            var subject = value.toUpperCase();
            if (subject.search(pattern) != -1 ) {
                document.location.href="#comp" + (i-5);
                selectRow = document.getElementById("comp" + (i+2)).style;
                selectRow.backgroundColor = '#0B7E2A';
                selectRow.color = 'white';
                return;
            }
        }
    }
    alert('aucune correspondance !')
});
