  
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
    border: solid 2px deepskyblue;
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
    <div class="right">
        <h2>Liste des joueurs par score</h2>
        <div class="liste-body">
            <table>
                <thead>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Score</th>
                </thead>
                <tbody>
                    <?php
                        for($cpt = $min; $cpt<$max; $cpt++){
                            
                                ?>
                                <tr>
                                    <td> <?php echo $_SESSION['tab'][$cpt]['nom']?> </td>
                                    <td> <?php echo $_SESSION['tab'][$cpt]['prenom'] ?> </td>
                                    <td> <?php echo $_SESSION['tab'][$cpt]['score'] ?> </td>
                                </tr>
                                <?php
                            }
                        
                    ?>
                            
                </tbody>
            </table>
        </div>
        <div class="paginate-liste-zone">
        <button type="submit" name="btn_submit" class="btn-form-admin"><a href="index.php?lien=accueil&block=joueur&page=<?= $page+=1?>"> suivat</a></button>
        </div>
    </div>