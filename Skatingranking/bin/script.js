
document.getElementById('titre').addEventListener("change", function(){
    alert('ok');
    var text = getSelectedText('titre');
    document.getElementById('h1_titre').innerHTML = text;

/*document.getElementById('type_classement').addEventListener("change", function(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var text = getSelectedText('type_classement');
            text = text + "<br />" + this.responseText;
            document.getElementById('classement').innerHTML = text;
        }
    };
    var url = document.getElementById('type_classement').value;
    xhttp.open("GET", "lib/get_liste.php?url=" + url, true);
    xhttp.send();
*/
});


