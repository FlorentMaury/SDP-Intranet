<?php

    // Date de début des vacances (1er juin de l'année en cours).
    $start = new DateTime(date('Y') . '-06-01');

    // Date du contrat.
    $contractDate = new DateTime($data['contract_start']);

    // Date actuelle.
    $now = new DateTime();

    if ($contractDate < $start) {
        // Si la date du contrat est antérieure au 1er juin de l'année en cours,
        // alors l'employé a droit à 25 jours de vacances.
        $totalHolidays = 25;
    } else {
        // Sinon, calculez le nombre de mois écoulés depuis la date du contrat.
        $months = $now->diff($contractDate)->format('%m');
        // Nombre total de jours de vacances gagnés.
        $totalHolidays = $months * 2.08;
    }

    // Jours de vacances déjà pris
    $usedHolidays = $data['holidays_taken'];

    // Jours de vacances restants.
    $remainingHolidays = floor($totalHolidays - $usedHolidays);

    // Mettre a jour la quantité de vacances restantes.
    $updateHolidays = $bdd->prepare('UPDATE user SET holidays_total = ? WHERE id = ?');
    $updateHolidays->execute(array($remainingHolidays, $data['id']));

    echo "Nombre de jours de vacances restants : $remainingHolidays jours.";