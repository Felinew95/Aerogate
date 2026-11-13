<?php
declare(strict_types=1);

/**
 * footer.inc.php - Pied de page du site
 * 
 * Ce module représente le pied de toutes les pages du site.
 * Il est utile pour éviter de répéter le même code sur chaque page.
 * 
 * @author Alexandre BURIN
 * @version 1.0
 */

/**
 * Variable pour l'année actuelle
 * @var int $date Année actuelle
 */
$date = (int) date('Y');

?>
    </main>
    
    <!-- Pied de page -->
    <footer>
        <div class="footer-container">
            <!-- Copyright -->
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="assets/img/favicon.ico" alt="Logo Aérogate">
                    <span>Aérogate</span>
                </div>
                
                <span class="footer-copyright">&copy; <?= $date ?> &bull; Tous droits réservés.</span>
            </div>

            <!-- Auteurs -->
            <div class="footer-authors">
                <span>Auteurs</span>
                <span>Alexandre BURIN</span>
                <span>Menaouer AMMARI</span>
                <span>Hugo DELHELLE</span>
            </div>
        </div>

        <div class="footer-back-to-top">
            <a href="#haut">Retour en haut</a>
        </div>
    </footer>
</body>
</html>
