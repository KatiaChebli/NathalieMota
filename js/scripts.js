// modal contact
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contact-modal');
    const closeModalBtn = document.querySelector('.close-modal');
    const contactLink = document.querySelector('.contact-link'); // Sélectionne le bouton Contact

    if (!modal || !contactLink || !closeModalBtn) {
        console.error("Un élément de la modale est manquant.");
        return;
    }

    // Empêche la redirection et ouvre la modale
    contactLink.addEventListener('click', (event) => {
        event.preventDefault(); // Empêche la redirection
        modal.classList.remove('hidden'); // Affiche la modale
    });

    // Fermer la modale au clic sur le bouton de fermeture
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


// Etape5 lightbox
class Lightbox { /*création d'une class qui s'apl init pour initialiser la lightbox*/
    static init () {
        const links = document.querySelectorAll('a[href$=".png"], a[href$=".jpg"], a[href$=".jpeg"] ') /*je séléctionne tt les liens qui mène à des img*/
            .forEach(link => link.addEventListener('click', e => 
            {
                e.preventDefault()
                new Lightbox(e.currentTarget.getAttribute('href')
                )
            }))
    }

    /**
     * 
     * @param {string} url url de l'image
     */
    constructor(url) {
         const element = this.builDom(url)
         document.body.appendChild(element)
    }

    /**
     * @param {string} url url de l'image
     * @return {HTMLElement} 
     */
    buildDom(url) {
        const dom = document.createElement('div')
        dom.classList.add('lightbox')
        dom.innerHTML = `<button class="lightbox__close">Fermer</button>
    <button class="lightbox__next">Suivant</button>
    <button class="lightbox__prev">Précédent</button>
        <div class="lightbox__container">
            <img src="${url}" alt="">
        </div>`
        return dom
    }
}

/**
 * <div class="lightbox">
    <button class="lightbox__close">Fermer</button>
    <button class="lightbox__next">Suivant</button>
    <button class="lightbox__prev">Précédent</button>
        <div class="lightbox__container">
            <img src="https://picsum.photos/300/300" alt="">
        </div>
</div>
 */
Lightbox.init()