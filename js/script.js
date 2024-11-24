document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contact-modal');
    const openModalButton = document.querySelector('.open-contact-modal');
    const closeModalButton = document.querySelector('.close-modal');

    // Ouvrir la modale
    openModalButton.addEventListener('click', () => {
        modal.classList.add('active');
    });

    // Fermer la modale
    closeModalButton.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    // Fermer la modale en cliquant à l'extérieur
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});
