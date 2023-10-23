<?php
    // Définition des données de l'employé.
    $hourRate = floatval($data['contract_remuneration']); // Taux horaire en euros.
    $weekRate = floatval($data['contract_weekly']); // Nombre d'heures par semaine.

    // Définir les absence et les delay de l'employé
    $absence = floatval($data['user_absence']); // Nombre de jours d'absence.
    $delay = floatval($data['user_delay']); // Nombre de fois en retard (en minutes).

    // Définir les heures supplémentaires de l'employé.
    $extraTime = floatval($data['user_extra_time']); // Nombre d'heures supplémentaires.
    
    // Banque de temps.
    $extraTimeBank = $extraTime * 60;
    $delayTimeBank = $delay * 60;
    $totalTimeBank = ($extraTimeBank - $delayTimeBank);

?>

<div class="border rounded mt-3 p-3">
    <h4 class="my-3">Banque de temps</h4>
    <!-- Afficher la banque de temps. -->
    <p>Temps supplémentaire effectué: <?=$extraTimeBank?> minutes</p>
    <p>Temps de la semaine à rattraper: <?=$delayTimeBank?> minutes</p>
    <p>Temps total: 
        <?php
            if($totalTimeBank >= 0)
                {
                    echo '<span class="text-success">' .$totalTimeBank. ' minutes</span>';
                } else {
                    echo '<span class="text-danger">' .$totalTimeBank. ' minutes</span>';
                };
        ?>
    </p>

    <!-- Boutons de déclarations. -->
    <div class="dashboardItems mt-4 d-flex flex-column flex-md-row">
    <button class="btn btn-md btn-dark p-2 m-3" type="submit">
        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDelayInfo">
            Déclarer un retard
        </a>
    </button>
    
    <button class="btn btn-md btn-dark p-2 m-3" type="submit">
        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyExtraTimeInfo">
            Déclarer des heures supplémentaires
        </a>
    </button>
</div>

</div>