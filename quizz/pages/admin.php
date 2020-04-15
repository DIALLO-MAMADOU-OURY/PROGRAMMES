<?php
    is_connect();
?>


<div class="header-admin">


    <div class="header-admin-text">
        CRÉER ET PARAMÉRTER VOS QUIZZ
    </div>
    <button> <a href="index.php?statut=logout">Déconnexion</a></button>
       
</div>
<div class="joueur-body">
    <div class="menu">
        <div class="top-menu">
            <div class="avatar-admin-container">
                <div id="moncercle"> 
                    <div id="AvatarCercle" style="background-image: url(<?php echo $_SESSION['user']['photo'];  ?> ); background-size: cover"></div>
                </div>
            </div>
            <div id="PrenomNom">
                <p id="p1"> <?php echo $_SESSION['user']['prenom'] ?> </p>
                <p id="p2"><?php echo $_SESSION['user']['nom'] ?></p>
            </div>
        </div>

        <!-- lien -->
        <div class="lien">
            <a href="#"><div class="liens">
                <p>Listes Questions</p>
                <div class="img-place"></div>
                </div>
            </a>
            <a href="#"><div class="liens">
                <p>Créer Admin</p>
                <div class="img-place-deux"></div>
                </div>
            </a>
            <a href="#"><div class="liens">
                <p>Listes Joueurs</p>
                <div class="img-place"></div>
                </div>
            </a>
            <a href="#"><div class="liens">
                <p>Créer Questions</p>
                <div class="img-place-deux"></div>
                </div>
            </a>
        </div>
    </div>
</div>