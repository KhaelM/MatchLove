var slideActuel = 0;
montrerSlide(slideActuel);

function montrerSlide(indiceDuSlide) {
    var listeTab = document.getElementsByClassName("tab");
    listeTab[indiceDuSlide].style.display = "inline-block";
    fixerEtape(indiceDuSlide);
}

function suivantPrecedent(n) {
    var listeTab = document.getElementsByClassName("tab");

    if( (slideActuel == 0 && n == -1) || (slideActuel == listeTab.length-1 && n == 1)) {
        return false;
    }

    // Effacer slide précédent
    listeTab[slideActuel].style.display = "none";
    slideActuel += n;
    montrerSlide(slideActuel);

}

function fixerEtape(indiceDuSlide) {
    var i, listeEtape = document.getElementsByClassName("etape");
    for(i = 0; i < listeEtape.length; i++) {
        listeEtape[i].className = listeEtape[i].className.replace(" actif", "");
    }
    listeEtape[indiceDuSlide].className += " actif";
}