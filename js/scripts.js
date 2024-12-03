document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contact-modal');
    const closeModalBtn = document.querySelector('.close-modal');
    const contactLink = document.querySelector('.menu-item-68');
    console.log("contactLink")
    contactLink.classList.add('open-contact-modal')
    const openModalBtn = document.querySelector('.open-contact-modal');

    // // Ouvrir la modale
    openModalBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
    });

    // Fermer la modale
    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Fermer la modale en cliquant en dehors du contenu
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});

//popup 

