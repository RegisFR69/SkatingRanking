/* *********************************
 * ##### js/setRanking.js #####
 * *********************************
 */
function setRanking() {
    var lignes = document.getElementsByTagName('tbody')[0].children;
    var ranking = 1;
    var generalRanking = 0;
    for (i = 0; i < lignes.length; i++) {
        if ( !lignes[i].classList.contains('hiddenRow') ){
            var tds = lignes[i].getElementsByTagName('td');
            if (generalRanking == tds[0].innerHTML) {
                tds[0].innerHTML = ranking - 1;
            } else {
                generalRanking = tds[0].innerHTML;
                tds[0].innerHTML = ranking++;
            }
        }
    }
}


