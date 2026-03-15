<div class="div-principal">
    <h2>Détails du rendez-vous</h2>
    <div class="informations">
    <div class="info-rdv">
        <h3>Détails</h3>
        <p>Date: <?php echo $visiteJour; ?></p>
        <p>Heure: <?php echo $visiteHeure; ?></p>
        <p>Motif: <?php echo $visite->getMotif(); ?></p>
        <p>Rapport: <?php echo ($visite->getRapport() ? $visite->getRapport() : "Aucun rapport"); ?></p>
    </div>
    <!-- <span><button type='submit'>Modifier</button></span> -->
    <div class="info-praticien">
        <h3>Praticien</h3>
        <p>Dr. <?php echo $praticien->getNom() . " " . $praticien->getPrenom(); ?></p>
        <p>Adresse: <?php echo $praticien->getAdresse(); ?></p>
        <p>Region: <?php echo $praticien->getRegion(); ?></p>
        <p>Spécialité: <?php echo $praticien->getSpecialite(); ?></p>
        <p>Lieu de travail: <?php echo $praticien->getLieu(); ?></p>
        <p>Coefficient de notoriété: <?php echo $praticien->getCoefNotoriete(); ?></p>
    </div>
    <div class="medicaments">
        <h3>Médicaments selectionnés</h3>
        <?php if ($echantillons && count($echantillons) > 0): ?>
            <?php foreach ($echantillons as $echantillon): ?>
                <div class="info-medicament">
                    <h3><?php echo $echantillon[0]->getNomCommercial(); ?></h3>
                    <p>Dépôt légal: <?php echo $echantillon[0]->getDepotLegal() ?></p>
                    <p>Famille: <?php echo $echantillon[0]->getFamille() ?></p>
                    <p>Composition: <?php echo $echantillon[0]->getComposition(); ?></p>
                    <p>Effets: <?php echo $echantillon[0]->getEffets(); ?></p>
                    <p>Prix: <?php echo $echantillon[0]->getPrix() < 0 ? "Non disponible" : $echantillon[0]->getPrix() . " €"; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun médicament sélectionné</p>
        <?php endif; ?>
    </div>
</div>
</div>