

// let imagesList = []; // Tableau contenant les images visibles
// let currentIndex = 0; // Index de l'image actuellement affichée dans la lightbox

// // Récupération des éléments de la lightbox
// const lightbox = document.getElementById('lightbox-overlay');  
// const lightboxImage = document.getElementById('lightbox-image');  
// const lightboxReference = document.getElementById('lightbox-reference');  
// const lightboxCategory = document.getElementById('lightbox-category');  
// const closeButton = document.getElementById('lightbox-close');
// const prevButton = document.getElementById('lightbox-prev');
// const nextButton = document.getElementById('lightbox-next');

// function attachLightboxEvents() {
//     const lightboxTriggers = document.querySelectorAll('.zoom-icon'); 

//     // Vérification si les éléments existent bien avant de continuer
//     if (!lightbox || !lightboxImage || !lightboxReference || !lightboxCategory) {
//         console.error("Erreur : Un élément de la lightbox est introuvable dans le DOM.");
//         return;
//     }

//     // Stocke les infos des images dans un tableau
//     imagesList = Array.from(lightboxTriggers).map(trigger => ({
//         src: trigger.getAttribute('data-large') || '',
//         reference: trigger.getAttribute('data-reference') || 'Réf. inconnue',
//         category: trigger.getAttribute('data-category') || 'Sans catégorie'
//     }));

//     // Ajout des événements au clic sur les boutons zoom-icon
//     lightboxTriggers.forEach((trigger, index) => {
//         trigger.addEventListener('click', (event) => {
//             event.preventDefault(); // Empêcher la redirection vers la single-page
//             console.log("clic detecter:", index);
//             currentIndex = index; // Sauvegarde l'index de l'image sélectionnée
//             openLightbox(currentIndex);
//         });
//     });

//     // Gestion de la fermeture de la lightbox
//     if (closeButton) {
//         closeButton.addEventListener('click', () => {
//             lightbox.classList.remove('active');
//         });
//     }

//     // Gestion des boutons "Précédent" et "Suivant"
//     if (prevButton) {
//         prevButton.addEventListener('click', () => showPrevImage());
//     }
//     if (nextButton) {
//         nextButton.addEventListener('click', () => showNextImage());
//     }
// }

// // Fonction pour ouvrir la lightbox avec l'image sélectionnée
// function openLightbox(index) {
//     if (!imagesList[index]) {
//         console.error(" Erreur : Index d'image invalide.");
//         return;
//     }

//     // Mise à jour de l'image et des infos
//     lightboxImage.src = imagesList[index].src;
//     lightboxReference.textContent = imagesList[index].reference;
//     lightboxCategory.textContent = imagesList[index].category;
    
//     // Afficher la lightbox
//     lightbox.classList.add('active');
// }

// // Fonction pour afficher l'image précédente
// function showPrevImage() {
//     currentIndex = (currentIndex - 1 + imagesList.length) % imagesList.length;
//     openLightbox(currentIndex);
// }

// // Fonction pour afficher l'image suivante
// function showNextImage() {
//     currentIndex = (currentIndex + 1) % imagesList.length;
//     openLightbox(currentIndex);
// }

// //  Exécuter la fonction au chargement initial
// document.addEventListener('DOMContentLoaded', attachLightboxEvents);


let imagesList = []; // Tableau contenant les images visibles
let currentIndex = 0; // Index de l'image actuellement affichée dans la lightbox

// Récupération des éléments de la lightbox
const lightbox = document.getElementById('lightbox-overlay');  
const lightboxImage = document.getElementById('lightbox-image');  
const lightboxReference = document.getElementById('lightbox-reference');  
const lightboxCategory = document.getElementById('lightbox-category');  
const closeButton = document.getElementById('lightbox-close');
const prevButton = document.getElementById('lightbox-prev');
const nextButton = document.getElementById('lightbox-next');

// Fonction principale pour attacher les événements aux images
function attachLightboxEvents() {
    updateLightboxEvents(); // Attache les événements au chargement initial
}

// Fonction pour mettre à jour les événements après le chargement de nouvelles images
function updateLightboxEvents() {
    const lightboxTriggers = document.querySelectorAll('.zoom-icon'); 

    // Met à jour la liste des images visibles
    imagesList = Array.from(lightboxTriggers).map(trigger => ({
        src: trigger.getAttribute('data-large'),
        reference: trigger.getAttribute('data-reference') || 'Réf. inconnue',
        category: trigger.getAttribute('data-category') || 'Sans catégorie'
    }));

    console.log("🔄 Mise à jour des images détectées :", imagesList); // Debug

    // Ajoute les événements de clic aux images, en supprimant les anciens événements pour éviter les doublons
    lightboxTriggers.forEach((trigger, index) => {
        trigger.removeEventListener('click', openLightboxEvent); // Suppression des anciens événements
        trigger.addEventListener('click', openLightboxEvent); // Ajout du nouvel événement
    });
}

// Fonction pour gérer le clic sur une image et ouvrir la lightbox
function openLightboxEvent(event) {
    event.preventDefault();
    const index = Array.from(document.querySelectorAll('.zoom-icon')).indexOf(event.currentTarget);
    if (index !== -1) openLightbox(index);
}

// Fonction pour ouvrir la lightbox avec l'image sélectionnée
function openLightbox(index) {
    if (!lightbox || !lightboxImage || !lightboxReference || !lightboxCategory) {
        console.error("❌ Erreur : Un élément de la lightbox est introuvable dans le DOM.");
        return;
    }

    console.log("🖼️ Ouverture de la lightbox avec :", imagesList[index]); // Debug

    // Mise à jour des valeurs dans la lightbox
    lightboxImage.src = imagesList[index].src;
    lightboxReference.textContent =  imagesList[index].reference;
    lightboxCategory.textContent = imagesList[index].category;

    // Afficher la lightbox
    lightbox.classList.add('active');
}

// Fonction pour afficher l'image précédente
function showPrevImage() {
    currentIndex = (currentIndex - 1 + imagesList.length) % imagesList.length;
    openLightbox(currentIndex);
}

// Fonction pour afficher l'image suivante
function showNextImage() {
    currentIndex = (currentIndex + 1) % imagesList.length;
    openLightbox(currentIndex);
}

// Fonction pour fermer la lightbox
function closeLightbox() {
    lightbox.classList.remove('active');
}

// Ajout des événements aux flèches de navigation et au bouton de fermeture
if (prevButton) prevButton.addEventListener('click', showPrevImage);
if (nextButton) nextButton.addEventListener('click', showNextImage);
if (closeButton) closeButton.addEventListener('click', closeLightbox);

// Ajoute l'événement pour fermer la lightbox en cliquant en dehors de l'image
lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) closeLightbox();
});

// Met à jour les événements au chargement initial
document.addEventListener('DOMContentLoaded', attachLightboxEvents);
