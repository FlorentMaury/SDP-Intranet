<?php
    // Définition des données de l'employé.
    $hourRate = $data['contract_remuneration']; // Taux horaire en euros.
    $weekRate = $data['contract_weekly']; // Nombre d'heures par semaine.

    // Définir les absence et les delay de l'employé
    $absence = $data['user_absence']; // Nombre de jours d'absence.
    $delay = $data['user_delay']; // Nombre de fois en delay (en minutes).

    // Définir les heures supplémentaires de l'employé.
    $extraTime = $data['user_extra_time']; // Nombre d'heures supplémentaires.

    // Calculer les totaux
    $salaryBase = (($hourRate * $weekRate)); // Salaire de base pour 40 heures par semaine.
    $salaryAbsence = ($absence * ($hourRate * 8)); // Perte de salaire due aux absences (8 heures par jour).
    $salaryDelay = ($delay * ($hourRate * 0.25)); // Perte de salaire due aux retards (supposons 15 minutes de retard = 25% d'une heure).
    $salaryExtraTime = ($extraTime * ($hourRate * 1.5)); // Salaire pour les heures supplémentaires.

    // Calculer le salaire total.
    $totalSalary = $salaryBase - $salaryAbsence - $salaryDelay + $salaryExtraTime;

?>

<!-- Afficher les résultats. -->
<p>Salaire de base: <?=$salaryBase?></p>
<p>Perte de salaire due aux absences: <?=$salaryAbsence?></p>
<p>Perte de salaire due aux retards: <?=$salaryDelay?></p>
<p>Salaire pour les heures supplémentaires: <?=$salaryExtraTime?></p>
<p>Salaire total par semaines: <?=$totalSalary?></p>