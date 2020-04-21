<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZZ</title>
    <link rel="stylesheet" href="./public/css/quizz.css">
    
</head>
<body>
    <div class="header">
        <div class="logo"></div>
        <div class="header-text"> Le plaisir de Jouer</div>
    </div>
    <div class="content">
        <?php
            session_start();
            require_once("./traitement/fonctions.php");
            if (isset($_GET['lien'])) {
                switch ($_GET['lien']) {
                    case 'accueil':
                        require_once("./pages/accueil.php");
                        break;

                    case 'jeux':
                        require_once("./pages/jeux.php");
                        break;
                    
                    case 'inscription':
                        require_once("./pages/inscription.php");
                    break;
                    default:
                        
                        break;
                }
            }
            else{
                if (isset($_GET['statut']) && $_GET['statut'] === "logout") {
                    decconection();
                }
                require_once("./pages/connexion.php");
            }
            
        ?>
    </div>
</body>
</html>