<?php
    is_connect();
    
    $liste = getData();
    $topscore=0;
    $liste = array_sort($liste, 'score', SORT_DESC);
    foreach ($liste as $key => $value) {
        if ($value['profil'] == 'joueur') {
            $tab[]=$value;
            $topscore++;
        }
    }
    $_SESSION['topscore']=$topscore;

    $nbrqstionjeux=getData('nbrquestions');
    $nbrqstion=$nbrqstionjeux[0]['nbrequestion'];
    $_SESSION['nbrqstion']=$nbrqstion;
   

    $npage = $_SESSION['nbrqstion'];
    if(!isset($_GET['pages'])){
        $pages = 1;
    }else{
        $pages = $_GET['pages'];
    }
    $min = ($pages-1)*1; $max = $min+1;
    if($pages <= 1){
        $pages = 1;
        $prev = 'none';
        
    }elseif($pages>$npage){
        $pages = $npage;
    }
    if ($pages<$npage) {
        $end = 'none';
    }
    if($pages == $npage){
        $max = $max = $min+1;
        $next = 'none';
        $end = 'block';
    }
?>
<style>
    .prev{
        display: <?= $prev ?>;
        align-self: flex-start;
    }
    .next{
        display: <?= $next ?>;
        float: right;
        margin-right: 10px;
        /* position: relative;
        top: 10px;
        left: 60%; */
        
    }
    .end{
        display: <?= $end ?>;
        float: right;
        margin-right: 10px;
    }
    table {
        border-radius: 1em;
        width: 100%;
        font-size: 1em
    }
    .question-show {
        display: inline-block;
    }   

    th,
    td {
        color: grey;
        padding: .25em 1em;
        text-align: left
    }
    *{
        margin: 0;
        padding: 0;
    }
</style>
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
    <div class="game_back">

        <div class="questiondisplay">
           <?php for ($i=$min; $i < $max; $i++) {
                $j=0;  
                $response = $_SESSION['question'][$i]["bonneReponse"];
                $choixMultiple = $_SESSION['question'][$i]["reponsePossible"];
                $type = $_SESSION['question'][$i]["type"];  ?>
                <div class="questiondisplay-libelle">
                    <u><?php echo 'Question '.($i+1).'/'.$_SESSION['nbrqstion']; ?></u><br>
                    <?php echo $_SESSION['question'][$i]['libelle'] ?>
                </div>
                <div class="nbrePoint">
                    <?php echo $_SESSION['question'][$i]['score'].'pts'; ?>
                </div>
                <div>
                    <form action="" method="post">
                        <?php
                            foreach ($choixMultiple as $key => $value) {
                                if ($type == 'text') {
                                    echo'<div>';
                                    echo '<input type="text" class="text" name="reps">';
                                    echo '</div>';
                                }
                                elseif ($type == 'multiple') {
                                    echo'<div>';
                                        echo '<input type="checkbox" name="checkboxes'.$j.'"> <label class="question-show" name="reponse[]">',$value,'</label><br/>';
                                    echo '</div>';
                                    $j++;
                                }
                                elseif ($type == 'simple') {
                                    echo'<div>';
                                    echo '<input type="radio" name="choix" value="'.$j.'"> <label class="question-show" name="reponse[]">',$value,'</label><br/>';
                                    echo '</div>';
                                    $j++;
                                }
                            }
                        }?>
                        <br>
                        <button class="prev" formaction="index.php?lien=jeux&pages=<?= $pages-1 ?>">Precedent</button>
                        <button class="next" value="next" name="btn" type="submit" formaction="index.php?lien=jeux&pages=<?= $pages+=1?>">suivant</button>
                        <button class="end" value="end" name="btn" type="submit">Terminer</button>
                    </form>
                </div>
        </div>

        <div class="meilleur-score">
            <div class="tab">
                <button class="tablinks" onclick="showInfos(event,'top-score')" id="defaultOpen"> Top score </button>
                <button class="tablinks" onclick="showInfos(event, 'meilleurScore')"> Mon meilleur Score</button>
            </div>
            <div id="top-score" class="tabcontent">
                <table>
                    <tbody>
                        <?php
                            for($cpt = 0; $cpt<$_SESSION['topscore']; $cpt++){ ?>
                                <tr>
                                    <td> <?php echo $tab[$cpt]['nom'].' '.$tab[$cpt]['prenom']?> </td>
                                    <td> <?php echo $tab[$cpt]['score'] ?> </td>
                                </tr>
                                <?php
                            }
                        ?>    
                    </tbody>
                </table>
            </div>
            <div id="meilleurScore" class="tabcontent">
                <?php echo $_SESSION['user']['score']?>
            </div>
            
        </div>
    </div>
</div>
<script>
    function showInfos(evt, affiche){
        var i,tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (let i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (let i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active","");
            
        }
        document.getElementById(affiche).style.display="block";
        evt.currentTarget.className +="active";
        evt.currentTarget.style.color="#3addd6"
    }
    document.getElementById("defaultOpen").click();
</script>