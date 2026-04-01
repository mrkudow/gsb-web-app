<header class="navbar">
    <div class="navbar-logo">
        <a href="../controleur/accueil.php"><img src="../vue/images/logo.png" alt="Logo" class="navbar-logo"></a>
    </div>
    <?php if ($_SESSION['user']): ?>
        <nav class="navbar-navigation">
            <ul class="navbar-onglets">
                <li class="navbar-onglet"><a href="../controleur/accueil.php" class="navbar-lien">Accueil</a></li>
            </ul>
        </nav>
        <div class="navbar-deconnexion">
            <form method="POST" action="../controleur/deconnexion.php">
                <button type="submit" class="button-deconnexion"><span>Déconnexion</span></button>
            </form>
        </div>
    <?php endif; ?>
</header>