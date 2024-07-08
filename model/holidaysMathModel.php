<?php

// date_default_timezone_set('Europe/Paris');

// // Date de début des vacances (1er juin de l'année en cours).
// $start = new DateTime(date('Y') . '-06-01', new DateTimeZone('Europe/Paris'));

// // Date actuelle.
// $now = new DateTime('now', new DateTimeZone('Europe/Paris'));

// // Date de contrat.
// $contractDate = new DateTime($data['contract_start'], new DateTimeZone('Europe/Paris'));

// // Utiliser la date de contrat comme date de référence pour calculer le nombre de mois travaillés.
// $referenceDate = $contractDate;

// // Si l'utilisateur est un nouvel arrivant cette année
// if ($referenceDate->format('Y') == $now->format('Y')) {
//     // Nombre fixe de jours de vacances pour les nouveaux arrivants
//     $totalHolidays = 10;
// } else {
//     // Calcul du nombre de mois travaillés à partir de la date de référence.
//     $interval = $referenceDate->diff($now);
//     $months = $interval->y * 12 + $interval->m;

//     // Si le jour actuel est avant le jour de la date de référence, décrémenter le nombre de mois travaillés.
//     if ($now->format('j') < $referenceDate->format('j')) {
//         $months--;
//     }

//     // Nombre total de jours de vacances gagnés (maximum 25 jours).
//     $totalHolidays = min($months * 2.05, 25); // En France, généralement 2.5 jours de vacances par mois travaillé, limité à 25 jours.
// }

// // Récupérer toutes les entrées de vacances acceptées pour l'utilisateur.
// $holidayQuery = $bdd->prepare('SELECT holiday_start, holiday_end FROM user_holiday WHERE user_holiday_id = ? AND holiday_response = 1');
// $holidayQuery->execute([$data['id']]);

// $usedHolidays = 0;

// if ($holidayQuery->rowCount() > 0) {
//     // Calculer la différence en jours pour chaque entrée.
//     while ($holiday = $holidayQuery->fetch(PDO::FETCH_ASSOC)) {
//         $start = new DateTime($holiday['holiday_start']);
//         $end = new DateTime($holiday['holiday_end']);

//         // Calculer le nombre de jours de vacances pour chaque intervalle de vacances.
//         $interval = $start->diff($end);
//         $usedHolidays += $interval->days + 1; // Ajoutez 1 pour inclure le jour de fin.
//     }
// }

// // Jours de vacances restants (maximum 25 jours).
// $remainingHolidays = min(round($totalHolidays - $usedHolidays), 25);

// // Mettre à jour la quantité de vacances restantes.
// $updateHolidays = $bdd->prepare('UPDATE user_time_bank SET holidays_total = ? WHERE user_time_bank_id = ?');
// $updateHolidays->execute([$remainingHolidays, $data['id']]);



// echo "Nombre de jours de vacances restants : $remainingHolidays jours.";


// Étape 1 : Récupérer la date de début de contrat et calculer le total des jours de vacances acquis.
$contractStartQuery = $bdd->prepare('SELECT contract_start FROM user_role WHERE user_role_id = ?');
$contractStartQuery->execute([$data['user_role_id']]);
$contractStart = $contractStartQuery->fetchColumn();

$contractStartDate = new DateTime($contractStart);
$today = new DateTime();
$interval = $contractStartDate->diff($today);
$monthsWorked = ($interval->y * 12) + $interval->m;
$totalHolidaysAccrued = $monthsWorked * 2.5;

// Récupérer le nombre total de jours de vacances de la base de données et ajouter les jours acquis.
$totalHolidaysQuery = $bdd->prepare('SELECT holidays_total FROM user_time_bank WHERE user_time_bank_id = ?');
$totalHolidaysQuery->execute([$data['id']]);
$totalHolidays = $totalHolidaysQuery->fetchColumn() + $totalHolidaysAccrued;

// Étape 2 : Calculer les jours de vacances utilisés.
$holidayQuery = $bdd->prepare('SELECT holiday_start, holiday_end FROM user_holiday WHERE user_holiday_id = ? AND holiday_response = 1');
$holidayQuery->execute([$data['id']]);

$usedHolidays = 0;

if ($holidayQuery->rowCount() > 0) {
    while ($holiday = $holidayQuery->fetch(PDO::FETCH_ASSOC)) {
        $start = new DateTime($holiday['holiday_start']);
        $end = new DateTime($holiday['holiday_end']);
        $interval = $start->diff($end);
        $days = $interval->days + 1;

        if ($days >= 7) {
            for($i = clone $start; $i <= $end; $i->modify('+1 day')){
                if($i->format("N") < 6) {
                    $usedHolidays++;
                }
            }
            $completeWeeks = floor($days / 7);
            $usedHolidays -= $completeWeeks * 2;
        } else {
            $usedHolidays += $days;
        }
    }
}

// Étape 3 : Mettre à jour le total des jours de vacances.
$remainingHolidays = $totalHolidays - $usedHolidays;

echo "Nombre de jours de vacances restants : $remainingHolidays jours.";

?>
