<?php
        // Définition les données de l'employé.
        $nomEmploye = $_SESSION['name'] . ' ' . $_SESSION['surname'];
        $tauxHoraire = 15.00; // Taux horaire en euros.
        $heuresParSemaines = $_SESSION['contract_weekly']; // Nombre d'heures par semaine.

        // Définir les absences et les retards de l'employé
        $absences = 2; // Nombre de jours d'absence
        $retards = 3; // Nombre de fois en retard (en minutes)

        // Définir les heures supplémentaires de l'employé
        $heuresSupplementaires = 10; // Nombre d'heures supplémentaires

        // Calculer les totaux
        $salaireDeBase = ($tauxHoraire * 40); // Salaire de base pour 40 heures par semaine
        $salaireAbsences = ($absences * ($tauxHoraire * 8)); // Perte de salaire due aux absences (8 heures par jour)
        $salaireRetards = ($retards * ($tauxHoraire * 0.25)); // Perte de salaire due aux retards (supposons 15 minutes de retard = 25% d'une heure)
        $salaireHeuresSupplementaires = ($heuresSupplementaires * ($tauxHoraire * 1.5)); // Salaire pour les heures supplémentaires

        // Calculer le salaire total
        $salaireTotal = $salaireDeBase - $salaireAbsences - $salaireRetards + $salaireHeuresSupplementaires;

        // Afficher les résultats
        echo "Nom de l'employé: $nomEmploye <br>";
        echo "Salaire de base: $salaireDeBase <br>";
        echo "Perte de salaire due aux absences: $salaireAbsences <br>";
        echo "Perte de salaire due aux retards: $salaireRetards <br>";
        echo "Salaire pour les heures supplémentaires: $salaireHeuresSupplementaires <br>";
        echo "Salaire total: $salaireTotal <br>";
    ?>

</div>