// modal contact
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contact-modal');
    const closeModalBtn = document.querySelector('.close-modal');
    const contactBtns = document.querySelectorAll('.single-photo-contact'); // Boutons Contact de la single-page
    const headerContactBtn = document.querySelector('.contact-link'); // Bouton Contact du menu
    const refPhotoField = document.querySelector('input[name="ref-photo"]'); // Champ référence photo dans le formulaire

    if (!modal || !closeModalBtn || !refPhotoField) {
        console.error("Un élément nécessaire pour la modale ou le formulaire est manquant.");
        return;
    }

    // Fonction pour ouvrir la modale et insérer la référence uniquement depuis la single-page
    contactBtns.forEach(btn => {
        btn.addEventListener('click', (event) => {
            event.preventDefault();
            modal.classList.remove('hidden'); // Affiche la modale

            // Ajouter la référence SEULEMENT si on clique depuis la single-page
            const refPhoto = btn.getAttribute('data-ref-photo');
            if (refPhoto) {
                refPhotoField.value = refPhoto; // Pré-remplit le champ du formulaire
            }
        });
    });

    // Écouter le clic sur le bouton Contact du menu (ne doit pas pré-remplir la référence)
    if (headerContactBtn) {
        headerContactBtn.addEventListener('click', (event) => {
            event.preventDefault();
            modal.classList.remove('hidden'); // Affiche la modale

            // On vide la référence photo si l'utilisateur vient du menu
            refPhotoField.value = "";
        });
    }

    // Fermer la modale au clic sur la croix
    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Fermer la modale en cliquant en dehors
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});


//photo preview single-page
document.addEventListener('DOMContentLoaded', () => {
    const navContainers = document.querySelectorAll('.nav-container');

    if (navContainers.length === 0) return;

    navContainers.forEach(container => {
        const link = container.querySelector('.nav-link');
        const preview = container.querySelector('.photo-preview');

        link.addEventListener('mouseenter', () => {
            const thumbnail = link.getAttribute('data-thumbnail');
            if (thumbnail) {
                preview.style.backgroundImage = `url(${thumbnail})`;
                preview.classList.remove('hidden'); // Afficher l'image
            }
        });

        link.addEventListener('mouseleave', () => {
            preview.classList.add('hidden'); // Cacher l'image
        });
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


//ETAPE 4 affichage des photos home page
document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll('#photo-filters select');

    filters.forEach(filter => {
        filter.addEventListener('change', function () {
            // Récupère les valeurs sélectionnées
            const category = document.getElementById('category').value;
            const format = document.getElementById('format').value;
            const orderBy = document.getElementById('order_by').value;

            const formData = new FormData();
            formData.append('action', 'filter_photos');
            formData.append('category', category);
            formData.append('format', format);
            formData.append('order_by', orderBy);

            // Envoie la requête AJAX
            fetch(ajaxurl, {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('photo-results').innerHTML = data; // Met à jour l'affichage
            })
            .catch(error => console.error('Erreur AJAX :', error));
        });
    });
});




// bouton charger plus photos home page
// document.getElementById('load-more').addEventListener('click', function () {
//     const button = this;
//     const page = button.getAttribute('data-page'); // Page actuelle
//     const nextPage = parseInt(page) + 1; // Page suivante

//     fetch(ajaxurl + '?action=load_more_photos&page=' + nextPage, {
//         method: 'GET',
//     })
//         .then(response => response.text())
//         .then(data => {
//             if (data.trim() !== '') {
//                 document.getElementById('photo-results').innerHTML += data; // Ajoute les nouvelles photos
//                 button.setAttribute('data-page', nextPage); // Met à jour la page suivante
//             } else {
//                 button.style.display = 'none'; // Cache le bouton si plus de photos
//             }
//         })
//         .catch(error => console.error('Erreur :', error));
// });

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
                
                attachLightboxEvents(); // 🔥 Réattache les événements pour la lightbox
            } else {
                button.style.display = 'none'; // Cache le bouton si plus de photos
            }
        })
        .catch(error => console.error('Erreur :', error));
});


