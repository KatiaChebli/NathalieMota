
// function attachLightboxEvents() {
//     const lightboxTriggers = document.querySelectorAll('.zoom-icon'); 
//     const lightbox = document.getElementById('lightbox-overlay');  
//     const lightboxImage = document.getElementById('lightbox-image');  
//     const lightboxTitle = document.getElementById('lightbox-title');  

//     lightboxTriggers.forEach(trigger => {
//         trigger.addEventListener('click', (event) => {
//             event.preventDefault(); // Empêche la redirection vers la single-page

//             const imageUrl = trigger.getAttribute('data-large');
//             const imageTitle = trigger.getAttribute('data-title');

//             if (lightbox && lightboxImage && lightboxTitle) {
//                 lightboxImage.src = imageUrl;
//                 lightboxTitle.textContent = imageTitle;

//                 lightbox.classList.add('active'); // Affiche la lightbox
//             }
//         });
//     });

//     // Gestion de la fermeture de la lightbox
//     const closeButton = document.getElementById('lightbox-close');
//     if (closeButton) {
//         closeButton.addEventListener('click', () => {
//             lightbox.classList.remove('active');
//         });
//     }
// }

// // 🔥 Exécuter une première fois au chargement initial
// document.addEventListener('DOMContentLoaded', attachLightboxEvents);

let imagesList = []; // Tableau qui contiendra les images visibles
let currentIndex = 0; // Index de l'image actuellement affichée dans la lightbox

function attachLightboxEvents() {
    const lightboxTriggers = document.querySelectorAll('.zoom-icon'); 
    const lightbox = document.getElementById('lightbox-overlay');  
    const lightboxImage = document.getElementById('lightbox-image');  
    const lightboxTitle = document.getElementById('lightbox-title');  
    const prevButton = document.getElementById('lightbox-prev'); 
    const nextButton = document.getElementById('lightbox-next');

    // 🖼️ Mettre à jour la liste des images visibles
    imagesList = Array.from(lightboxTriggers).map(trigger => ({
        src: trigger.getAttribute('data-large'),
        title: trigger.getAttribute('data-title')
    }));

    lightboxTriggers.forEach((trigger, index) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault(); // Empêcher la redirection vers la single-page

            currentIndex = index; // Sauvegarde de l'index de l'image sélectionnée
            openLightbox(currentIndex);
        });
    });

    // Gestion de la fermeture de la lightbox
    const closeButton = document.getElementById('lightbox-close');
    if (closeButton) {
        closeButton.addEventListener('click', () => {
            lightbox.classList.remove('active');
        });
    }

    // 🎯 Gestion des boutons "Précédent" et "Suivant"
    if (prevButton) {
        prevButton.addEventListener('click', () => showPrevImage());
    }
    if (nextButton) {
        nextButton.addEventListener('click', () => showNextImage());
    }
}

// Fonction pour ouvrir la lightbox avec une image spécifique
function openLightbox(index) {
    const lightbox = document.getElementById('lightbox-overlay');  
    const lightboxImage = document.getElementById('lightbox-image');  
    const lightboxTitle = document.getElementById('lightbox-title');  

    if (imagesList.length > 0) {
        lightboxImage.src = imagesList[index].src;
        lightboxTitle.textContent = imagesList[index].title;
        lightbox.classList.add('active');
    }
}

// Fonction pour afficher l'image précédente
function showPrevImage() {
    currentIndex = (currentIndex - 1 + imagesList.length) % imagesList.length; // Revenir à la dernière image si on est à la première
    openLightbox(currentIndex);
}

// Fonction pour afficher l'image suivante
function showNextImage() {
    currentIndex = (currentIndex + 1) % imagesList.length; // Aller à la première image si on est à la dernière
    openLightbox(currentIndex);
}

// 🔥 Exécuter la fonction au chargement initial
document.addEventListener('DOMContentLoaded', attachLightboxEvents);
