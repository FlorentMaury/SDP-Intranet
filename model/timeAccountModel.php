<?php
    // Définition les données de l'employé.
    $nomEmploye = $_SESSION['name'] . ' ' . $_SESSION['surname'];
    $tauxHoraire = $_SESSION['contract_remuneration']; // Taux horaire en euros.
    $heuresParSemaines = $_SESSION['contract_weekly']; // Nombre d'heures par semaine.

    // Définir les absences et les retards de l'employé
    $absences = $_SESSION['user_absence']; // Nombre de jours d'absence
    $retards = $_SESSION['user_delay']; // Nombre de fois en retard (en minutes)

    // Définir les heures supplémentaires de l'employé
    $heuresSupplementaires = 10; // Nombre d'heures supplémentaires

    // Calculer les totaux
    $salaireDeBase = (($tauxHoraire * $heuresParSemaines) * 4); // Salaire de base pour 40 heures par semaine
    $salaireAbsences = ($absences * ($tauxHoraire * 8)); // Perte de salaire due aux absences (8 heures par jour)
    $salaireRetards = ($retards * ($tauxHoraire * 0.25)); // Perte de salaire due aux retards (supposons 15 minutes de retard = 25% d'une heure)
    $salaireHeuresSupplementaires = ($heuresSupplementaires * ($tauxHoraire * 1.5)); // Salaire pour les heures supplémentaires

    // Calculer le salaire total
    $salaireTotal = $salaireDeBase - $salaireAbsences - $salaireRetards + $salaireHeuresSupplementaires;

?>

<!-- Afficher les résultats -->
<p>Nom : <?=$nomEmploye?></p>
<p>Salaire de base: <?=$salaireDeBase?></p>
<p>Perte de salaire due aux absences: <?=$salaireAbsences?></p>
<p>Perte de salaire due aux retards: <?=$salaireRetards?></p>
<p>Salaire pour les heures supplémentaires: <?=$salaireHeuresSupplementaires?></p>
<p>Salaire total: <?=$salaireTotal?></p>