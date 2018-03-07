/* *********************************
 * ##### js/getSelectedText.js #####
 * *********************************
 */
function getSelectedText(elementId) {
    var elt = document.getElementById(elementId);
    if (elt.selectedIndex == -1)
        return null;
    return elt.options[elt.selectedIndex].text;
}


