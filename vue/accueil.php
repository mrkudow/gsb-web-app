<div class="div-principal exception">
    <form class="form-rdv" method="POST" action="../controleur/rdv.php">
        <h2>Liste de vos rendez-vous</h2>
        <div class="scroll-rdv">
            <div class="liste-rdv">
            <?php if ($visites && count($visites) > 0): ?>
                <?php foreach ($visites as $visite): ?>
                    <div class="rdv">
                        <span class="rdv-texte">
                            <strong><?= date_format(date_create($visite->getDate()), 'd/m/Y H:i'); ?></strong><br/>
                            
                            <?php echo $visite->getPraticien()->getNom()." ".$visite->getPraticien()->getPrenom(); ?><br/>
                            Motif: <?= $visite->getMotif(); ?>
                        </span>
                        <span class="rdv-button">
                            <button type="submit" name="rdv" value="<?= $visite->getCode(); ?>">Consulter</button>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun rendez-vous planifié</p>
            <?php endif; ?>
            </div>
        </div>
    </form>
</div>