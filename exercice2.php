<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>exercice2</title>
</head>

<body>
 <div class="container">
        <form  method="post">
            <fieldset>
                <legend>Calendrier</legend>
                <div>
                    <input type="hidden" name="lang" value="fr">
                    <label for="name">Choisissez votre langue:</label>
                    <select name="choix" id="langue">
                    <?php
                        if(isset($_POST['choix'])){
                            if($_POST['choix']=='francais'){
                                echo "<option value=\"francais\" selected>FRANCAIS</option>";
                                echo "<option value=\"anglais\">ANGLAIS</option>";
                            }
                            else{
                                echo "<option value=\"francais\">FRANCAIS</option>";
                                echo "<option value=\"anglais\" selected>ANGLAIS</option>";
                            }
                        }
                        else {
                            echo "<option value=\"francais\" selected>FRANCAIS</option>";
                            echo "<option value=\"anglais\">ANGLAIS</option>";
                        } ?>
                    </select><br>
                </div>
                <div class="button">
                    <button type="submit"> valider </button>
                </div>
            </fieldset>
        </form>
</div>

</body>
</html>
    <?php
    if (!empty($_POST)) {
        function Langue(array $tab){
            $n= 0;
            echo '<table class="table">';
            for($i=0 ; $i<4; $i++){
                echo '<tr class="ligne">';
                for($j =0; $j<3; $j++){
                    echo '<td class="numero">';
                    echo  $n+=1 ;
                    echo "</td>";
                    echo '<td class="mois">'.$tab[$i][$j].'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }
        $calendar= array( array("Janvier","Février","Mars"), array("Avril","Mai","Juin"), 
            array("Juillet","Août","Septembre"), array("Octobre","Novembre","Decembre"));
        $calendar1=array( array("Janvary","February","Mars"), array("April","May","Jun"),
            array("July","August","September"), array("October","November","December"));
        if($_POST['choix']=="francais"){
           Langue($calendar);
        }elseif($_POST['choix']=="anglais"){
           Langue($calendar1);
        }
    }?>
       