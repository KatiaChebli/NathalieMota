<footer class="site-footer">
    <div class="footer-container">
        <hr class="footer-line">
        <nav class="footer-nav">
            <ul>
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Vie privée</a></li>
                <li><a href="#">Tous droits réservés</a></li>
            </ul>
        </nav>
    </div>
</footer>

<?php wp_footer(); ?>

<!-- <div id="lightbox-overlay">
    <div id="lightbox-content">
        <img id="lightbox-image" src="" alt="">
        <div id="lightbox-info">
            <h3 id="lightbox-title"></h3>
            <button id="lightbox-prev">&lt;</button>
            <button id="lightbox-next">&gt;</button>
            <button id="lightbox-close">✖</button>
        </div>
    </div>
</div> -->
<!-- <div id="lightbox-overlay"> -->
    <!-- <div id="lightbox-content"> -->
        <!-- <button id="lightbox-prev">&lt;</button> Flèche gauche -->
        
        <!-- <img id="lightbox-image" src="" alt=""> Image centrale -->

        <!-- <button id="lightbox-next">&gt;</button> Flèche droite -->

        <!-- <div id="lightbox-info">
            <h3 id="lightbox-title"></h3>
            <button id="lightbox-close">✖</button>
        </div>
    </div>
</div> -->

<div id="lightbox-overlay">
    <!-- Bouton de fermeture -->
    <button id="lightbox-close">✖</button>

    <!-- Flèche gauche -->
    <button id="lightbox-prev">&larr; Précédente</button>
    
    <div id="lightbox-content">
        <img id="lightbox-image" src="" alt="">
    </div>

    <!-- Flèche droite -->
    <button id="lightbox-next">Suivante &rarr;</button>

    <!-- Titre sous la lightbox -->
    <div id="lightbox-info">
        <h3 id="lightbox-title"></h3>
        <p id="lightbox-category"></p> 
    </div>
</div>

</body>
</html>