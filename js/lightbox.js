document.addEventListener("DOMContentLoaded", function () {
    const lightboxOverlay = document.getElementById("lightbox-overlay");
    const lightboxImage = document.getElementById("lightbox-image");
    const lightboxTitle = document.getElementById("lightbox-title");

    // 📌 Fonction pour attacher les événements aux icônes loupe
    function attachZoomEvents() {
        const zoomIcons = document.querySelectorAll(".zoom-icon");
        zoomIcons.forEach((icon) => {
            icon.removeEventListener("click", handleZoomClick); // Supprime les anciens événements
            icon.addEventListener("click", handleZoomClick); // Ajoute l'écouteur
        });
    }

    // 📌 Gestionnaire d'événement pour l'icône loupe
    function handleZoomClick(e) {
        e.stopPropagation(); // Empêche la propagation vers le lien parent (le lien `<a>`)
        e.preventDefault(); // Empêche l'action par défaut du bouton/lien

        // Récupère les données pour la lightbox
        const largeImage = this.getAttribute("data-large");
        const title = this.getAttribute("data-title");

        // Met à jour la lightbox
        lightboxImage.src = largeImage;
        lightboxTitle.textContent = title;

        // Affiche la lightbox
        lightboxOverlay.style.display = "flex";
    }

    // 📌 Fermer la lightbox
    document.getElementById("lightbox-close").addEventListener("click", function () {
        lightboxOverlay.style.display = "none";
    });

    // 📌 Appelle initialement pour les photos chargées au départ
    attachZoomEvents();

    // 📌 Réattache les événements après chaque chargement AJAX
    const loadMoreButton = document.getElementById("load-more");
    if (loadMoreButton) {
        loadMoreButton.addEventListener("click", function () {
            setTimeout(() => {
                attachZoomEvents(); // Réattache les événements aux nouvelles photos
            }, 500); // Délai pour s'assurer que les nouvelles photos sont ajoutées au DOM
        });
    }
});
