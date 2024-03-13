<?php

    // Date de début des vacances (1er juin de l'année en cours).
    $start = new DateTime(date('Y') . '-06-01');

    // Date du contrat.
    $contractDate = new DateTime($data['contract_start']);

    // Date actuelle.
    $now = new DateTime();

    if ($now >= $start) {
        // Si la date actuelle est après le 1er juin de l'année en cours,
        // alors réinitialisez le total des jours de vacances à 25.
        $totalHolidays = 25;
    } else if ($contractDate < $start) {
        // Si la date du contrat est antérieure au 1er juin de l'année en cours,
        // alors l'employé a droit à 25 jours de vacances.
        $totalHolidays = 25;
    } else {
        // Sinon, calculez le nombre de mois écoulés depuis la date du contrat.
        $months = $now->diff($contractDate)->format('%m');
        // Nombre total de jours de vacances gagnés.
        $totalHolidays = $months * 2.08;
    }

    // Récupérer toutes les entrées de vacances acceptées pour l'utilisateur
    $holidayQuery = $bdd->prepare('SELECT holiday_start, holiday_end FROM user_holiday WHERE user_holiday_id = ? AND holiday_response = 1');
    $holidayQuery->execute([$data['id']]);

    $usedHolidays = 0;

    // Calculer la différence en jours pour chaque entrée
    while ($holiday = $holidayQuery->fetch(PDO::FETCH_ASSOC)) {
        $start = new DateTime($holiday['holiday_start']);
        $end = new DateTime($holiday['holiday_end']);

        $interval = $start->diff($end);

        $usedHolidays += $interval->days;
    }

    // Jours de vacances restants.
    $remainingHolidays = floor($totalHolidays - $usedHolidays);

    // Mettre a jour la quantité de vacances restantes.
    $updateHolidays = $bdd->prepare('UPDATE user_time_bank SET holidays_total = ? WHERE user_time_bank_id = ?');
    $updateHolidays->execute(array($remainingHolidays, $data['id']));

    echo "Nombre de jours de vacances restants : $remainingHolidays jours.";