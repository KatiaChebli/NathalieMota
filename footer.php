<footer class="site-footer">
    <div class="footer-container">
        <hr class="footer-line">
        <nav class="footer-nav">
            <ul>
                <li><a href="<?php echo site_url('/index.php/mentions-legales');?>">MENTIONS LÉGALES</a></li>
                <li><a href="<?php echo site_url('/index.php/vie-privee');?>">VIE PRIVÉE</a></li>
                <li><a href="<?php echo site_url('/index.php/tous-droits-reserves');?>">TOUS DROITS RÉSERVÉS</a></li>
            </ul>
        </nav>
    </div>
</footer>


<div id="lightbox-overlay">
    <button id="lightbox-close">✖</button>
    <button id="lightbox-prev">&larr; Précédente</button>

    <div id="lightbox-content">
        <img id="lightbox-image" src="" alt="">
    </div>

    <button id="lightbox-next">Suivante &rarr;</button>

    <div id="lightbox-info">
        <div class="lightbox-details">
        <h3 id="lightbox-reference"></h3> 
        <p id="lightbox-category"></p> 
        </div>
    </div>
</div>



<?php wp_footer(); ?>

</body>
</html>