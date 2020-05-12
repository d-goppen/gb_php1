"use strict";

// Get the modal
let theModal = document.getElementById("pictureModal");

// When the user clicks on <span> (x), close the modal
document.getElementsByClassName("fullPicture")[0].addEventListener('click',
    function() {
        theModal.style.display = "none";
    });

// When the user clicks anywhere outside of the modal, close it
window.addEventListener('click', function(event) {
    if (event.target == theModal) {
        theModal.style.display = "none";
    }
});

// Opens picture in moal window
let openPicture = function() {
    if (theModal) {
        document.getElementsByClassName("fullPicture")[0].src = "";
        document.getElementsByClassName("fullPicture")[0].src = this.firstChild.src.replace(/_s/g, '_b');
        theModal.style.display = "flex";
    }
}

// Set openPicture to all thumbnails
document.querySelectorAll('.pictureThumbContainer').forEach(element => {
    element.addEventListener('click', openPicture);
});