// modal contact
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


// ETAPE 4 filtres Ajax
document.getElementById('photo-filters').addEventListener('submit', function (e) {
    e.preventDefault();

    const format = document.getElementById('format').value;
    const category = document.getElementById('category').value;
    const orderBy = document.getElementById('order_by').value;

    const params = new URLSearchParams({
        format: format,
        category: category,
        order_by: orderBy,
    });

    fetch(ajaxurl + '?action=filter_photos&' + params.toString(), {
        method: 'GET',
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('photo-results').innerHTML = data; // Met à jour les résultats
        })
        .catch(error => console.error('Erreur :', error));
});


//ETAPE 4 affichage des photos
document.getElementById('photo-filters').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const params = new URLSearchParams(formData);

    fetch(ajaxurl + '?action=filter_photos&' + params.toString(), {
        method: 'GET',
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('photo-results').innerHTML = data;
        })
        .catch(error => console.error('Erreur:', error));
});

// bouton charger plus photos
document.getElementById('load-more').addEventListener('click', function () {
    const button = this;
    const page = button.getAttribute('data-page'); // Page actuelle
    const nextPage = parseInt(page) + 1; // Page suivante

    fetch(ajaxurl + '?action=load_more_photos&page=' + nextPage, {
        method: 'GET',
    })
        .then(response => response.text())
        .then(data => {
            if (data.trim() !== '') {
                document.getElementById('photo-results').innerHTML += data; // Ajoute les nouvelles photos
                button.setAttribute('data-page', nextPage); // Met à jour la page suivante
            } else {
                button.style.display = 'none'; // Cache le bouton si plus de photos
            }
        })
        .catch(error => console.error('Erreur :', error));
});


