<?php
    is_connect();
?>

<div class="header-joueur">
    <div class="avatar-container">
        <div class="avatar-joueur" style="background-image: url(<?php echo $_SESSION['user']['photo'];  ?> ); background-size: cover"></div>
        <div class="joueur-informations">
            <?php echo $_SESSION['user']['prenom'].' '.$_SESSION['user']['nom'] ?>
        </div>
    </div>
    <div class="header-joueur-text">
        BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>
        JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRAL
    </div>
    <button> <a href="index.php?statut=logout">Déconnexion</a></button>    
</div>
<div class="joueur-body">
    <div class="game_back"></div>
</div>