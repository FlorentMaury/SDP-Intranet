<?php
    // Définition des données de l'employé.
    $userName = $_SESSION['name'] . ' ' . $_SESSION['surname'];
    $hourRate = $_SESSION['contract_remuneration']; // Taux horaire en euros.
    $weekRate = $_SESSION['contract_weekly']; // Nombre d'heures par semaine.

    // Définir les absence et les delay de l'employé
    $absence = $_SESSION['user_absence']; // Nombre de jours d'absence.
    $illness = $_SESSION['user_illness']; // Nombre de jours de maladie.
    $delay = $_SESSION['user_delay']; // Nombre de fois en delay (en minutes).

    // Définir les heures supplémentaires de l'employé.
    $extraTime = $_SESSION['user_extra_time']; // Nombre d'heures supplémentaires.

    // Calculer les totaux
    $salaryBase = (($hourRate * $weekRate) * 4); // Salaire de base pour 40 heures par semaine.
    $salaryAbsence = ($absence * ($hourRate * 8)); // Perte de salaire due aux absences (8 heures par jour).
    $salaryIllness = ($illness * ($hourRate * 8)); // Perte de salaire due aux maladies (8 heures par jour).
    $salaryDelay = ($delay * ($hourRate * 0.25)); // Perte de salaire due aux retards (supposons 15 minutes de retard = 25% d'une heure).
    $salaryExtraTime = ($extraTime * ($hourRate * 1.5)); // Salaire pour les heures supplémentaires.

    // Calculer le salaire total.
    $totalSalary = $salaryBase - $salaryIllness - $salaryAbsence - $salaryDelay + $salaryExtraTime;

?>

<!-- Afficher les résultats. -->
<p>Nom : <?=$userName?></p>
<p>Salaire de base: <?=$salaryBase?></p>
<p>Perte de salaire due aux absences: <?=$salaryAbsence?></p>
<p>Perte de salaire due aux maladies: <?=$salaryIllness?></p>
<p>Perte de salaire due aux retards: <?=$salaryDelay?></p>
<p>Salaire pour les heures supplémentaires: <?=$salaryExtraTime?></p>
<p>Salaire total: <?=$totalSalary?></p>