<!-- <?php
include('./partials/vue_head.php');
include('./partials/vue_navbar.php');
session_start();
?> -->

<div class="div-principal exception">
    <form class="form-auth" method="POST" action="../controleur/authentification.php">
        <h2>Authentification</h2>
        <input type="text" name="identifiant" minlength="3" maxlength="20" placeholder="Identifiant" required />
        <input type="password" name="mdp" minlength="8" maxlength="20"  placeholder="Mot de passe" required />
        <input type="submit" value="Valider"/>
        <p>Mot de passe oublié ?</p>
    </form>
</div>

<!-- <?php include('./partials/vue_footer.php'); ?> -->