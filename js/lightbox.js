document.addEventListener('DOMContentLoaded', () => {
    const lightboxTriggers = document.querySelectorAll('.lightbox-trigger');
    const lightbox = document.querySelector('.lightbox'); // Sélecteur de la lightbox existante
    const lightboxImage = lightbox.querySelector('.lightbox-image'); // Image dans la lightbox
    const lightboxTitle = lightbox.querySelector('.lightbox-title'); // Titre dans la lightbox

    lightboxTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const imageUrl = trigger.getAttribute('data-large');
            const imageTitle = trigger.getAttribute('data-title');

            // Mettre à jour l'image et le titre de la lightbox
            lightboxImage.src = imageUrl;
            lightboxTitle.textContent = imageTitle;

            // Afficher la lightbox
            lightbox.classList.add('active');
        });
    });

    // Gestion de la fermeture de la lightbox
    document.querySelector('.lightbox-close').addEventListener('click', () => {
        lightbox.classList.remove('active');
    });
});
