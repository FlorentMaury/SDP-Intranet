<?php

// Vérification du formulaire de modification de la première expérience professionelle.
if(
    !empty($_POST['job1']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob1 = htmlspecialchars($_POST['job1']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_1 = ? WHERE id = ?');
    $req->execute([$modifyJob1, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des dates de début la première expérience professionelle.
if(
    !empty($_POST['job1Start']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob1Start = htmlspecialchars($_POST['job1Start']);
    $userId          = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_1_start = ? WHERE id = ?');
    $req->execute([$modifyJob1Start, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des dates de fin la première expérience professionelle.
if(
    !empty($_POST['job1End']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob1End = htmlspecialchars($_POST['job1End']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_1_end = ? WHERE id = ?');
    $req->execute([$modifyJob1End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des missions de la première expérience professionelle.
if(
    !empty($_POST['job1Exp']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob1Exp = htmlspecialchars($_POST['job1Exp']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_1_exp = ? WHERE id = ?');
    $req->execute([$modifyJob1Exp, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification de la seconde expérience professionelle.
if(
    !empty($_POST['job2']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob2 = htmlspecialchars($_POST['job2']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_2 = ? WHERE id = ?');
    $req->execute([$modifyJob2, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des dates de début la seconde expérience professionelle.
if(
    !empty($_POST['job2Start']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob2Start = htmlspecialchars($_POST['job2Start']);
    $userId          = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_2_start = ? WHERE id = ?');
    $req->execute([$modifyJob2Start, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des dates de fin la seconde expérience professionelle.
if(
    !empty($_POST['job2End']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob2End = htmlspecialchars($_POST['job2End']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_2_end = ? WHERE id = ?');
    $req->execute([$modifyJob2End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des missions de la seconde expérience professionelle.
if(
    !empty($_POST['job2Exp']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob2Exp = htmlspecialchars($_POST['job2Exp']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_2_exp = ? WHERE id = ?');
    $req->execute([$modifyJob2Exp, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification de la troisième expérience professionelle.
if(
    !empty($_POST['job3']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob3 = htmlspecialchars($_POST['job3']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_3 = ? WHERE id = ?');
    $req->execute([$modifyJob3, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des dates de début la troisième expérience professionelle.
if(
    !empty($_POST['job3Start']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob3Start = htmlspecialchars($_POST['job3Start']);
    $userId          = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_3_start = ? WHERE id = ?');
    $req->execute([$modifyJob3Start, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des dates de fin la troisième expérience professionelle.
if(
    !empty($_POST['job3End']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob3End = htmlspecialchars($_POST['job3End']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_3_end = ? WHERE id = ?');
    $req->execute([$modifyJob3End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

// Vérification du formulaire de modification des missions de la troisième expérience professionelle.
if(
    !empty($_POST['job3Exp']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyJob3Exp = htmlspecialchars($_POST['job3Exp']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET job_3_exp = ? WHERE id = ?');
    $req->execute([$modifyJob3Exp, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

?>