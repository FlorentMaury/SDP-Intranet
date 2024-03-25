<?php

// Date de début des vacances (1er juin de l'année en cours).
$start = new DateTime(date('Y') . '-06-01');

// Date du contrat.
$contractDate = new DateTime($data['contract_start']);

// Date actuelle.
$now = new DateTime();

// Si la date du contrat est après le 1er juin, utilisez la date du contrat, sinon utilisez le 1er juin.
$referenceDate = $contractDate > $start ? $contractDate : $start;

// Si nous sommes après le 1er juin et que la date de début du contrat est avant le 1er juin, réinitialisez le total des jours de vacances.
if ($now >= $start && $contractDate < $start) {
    $totalHolidays = 0;
    $referenceDate = $start;
}

// Calculez le nombre de mois depuis la date de référence jusqu'à maintenant.
$interval = $referenceDate->diff($now);
$months = $interval->y * 12 + $interval->m;

// Si le jour du mois dans la date actuelle est plus petit que le jour du mois dans la date de référence, soustrayez un mois.
if ($now->format('j') < $referenceDate->format('j')) {
    $months--;
}

// Nombre total de jours de vacances gagnés.
$totalHolidays += $months * 2.08;

// Récupérer toutes les entrées de vacances acceptées pour l'utilisateur
$holidayQuery = $bdd->prepare('SELECT holiday_start, holiday_end FROM user_holiday WHERE user_holiday_id = ? AND holiday_response = 1');
$holidayQuery->execute([$data['id']]);

$usedHolidays = 0;

if ($holidayQuery->rowCount() > 0) {
    // Calculer la différence en jours pour chaque entrée
    while ($holiday = $holidayQuery->fetch(PDO::FETCH_ASSOC)) {
        $start = new DateTime($holiday['holiday_start']);
        $end = new DateTime($holiday['holiday_end']);

        $interval = $start->diff($end);

        $usedHolidays += $interval->days;
    }
}

// Jours de vacances restants.
$remainingHolidays = floor($totalHolidays - $usedHolidays);

// Mettre a jour la quantité de vacances restantes.
$updateHolidays = $bdd->prepare('UPDATE user_time_bank SET holidays_total = ? WHERE user_time_bank_id = ?');
$updateHolidays->execute(array($remainingHolidays, $data['id']));

echo "Nombre de jours de vacances restants : $remainingHolidays jours.";
