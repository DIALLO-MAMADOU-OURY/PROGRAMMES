<?php
    is_connect();
?>
<?php
$liste = getData();
$liste = array_sort($liste, 'score', SORT_DESC);
foreach ($liste as $key => $value) {
    if ($value['profil'] == 'joueur') {
        $tab[]=$value;
    }
}
$_SESSION['tab'] = $tab;

$npage = ceil(sizeof($tab)/5);
if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}
$min = ($page-1)*5; $max = $min + 5;
if($page <= 1){
    $page = 1;
    $prev = 'none';
}elseif($page>$npage){
    $page = $npage;
}
if($page == $npage){
    $max = sizeof($tab);
    $next = 'none';
}
?>
<style>
    table {
    border-radius: 1em;
    width: 100%;
    font-size: 1em
}

th,
td {
    color: grey;
    padding: .25em 1em;
    text-align: left
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
        <div class="meilleur-score">
            <div class="tab">
                <button class="tablinks" onclick="showInfos(event,'top-score')" id="defaultOpen"> Top score </button>
                <button class="tablinks" onclick="showInfos(event, 'meilleurScore')"> Mon meilleur Score</button>
            </div>
            <div id="top-score" class="tabcontent">
                <table>
                    <tbody>
                        <?php
                            for($cpt = $min; $cpt<$max; $cpt++){
                                
                                    ?>
                                    <tr>
                                        <td> <?php echo $_SESSION['tab'][$cpt]['nom'].' '.$_SESSION['tab'][$cpt]['prenom']?> </td>
                                        <td> <?php echo $_SESSION['tab'][$cpt]['score'] ?> </td>
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