<?php
function connexion($login, $pwd)
{
    $users = getData();
    foreach ($users as $key => $user) {
        if ($user['login'] === $login && $user['password'] === $pwd) {
            $_SESSION['user'] = $user;
            $_SESSION['statut'] = "login";
            if ($user['profil'] === 'admin') {
                return "accueil";
            } else {
                $question = getData('question');
                shuffle($question);
                $_SESSION['question']=$question;
                return 'jeux';

            }
        }
    }
    return "error";
}
function is_in($login)
{
    $users = getData();
    foreach ($users as $key => $user) {
        if ($user['login'] === $login) {
            return true;
        }
    }
    return false;
}
function decconection()
{
    unset($_SESSION['user']);
    unset($_SESSION['statut']);
    session_destroy();
}
function is_connect()
{
    if (!isset($_SESSION['statut'])) {
        header("location:index.php");
    }
}
function getData($file = "utilisateur")
{
    $data = file_get_contents("./data/" . $file . ".json");
    $data = json_decode($data, true);
    return $data;
}


function array_sort($array, $on, $order = SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

// function saveData($prenom,$nom,$login,$pwd,$profil,$photo){
//     $data[] = array(
//         "prenom"=> $prenom,
//         "nom"=> $nom,
//         "login"=> $login,
//         "password"=> $pwd,
//         "profil"=> $profil,
//         "photo"=>$photo
//     );
//     $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
//     $save = file_put_contents($file, $jsonfile);
//     if ($save) {
//         $result = connexion($login,$pwd);
//         header("location: index.php?lien=".$result);
//     }
// }


function paginer($tab,$pagi){
    if(isset($tab))
    {
        $nbre_total_nbreP= count($tab);
        $nbre_P_par_page=100;
        $nbre_page_avant_pagination_et_apres=2;
        $last_page= ceil($nbre_total_nbreP/$nbre_P_par_page);
 
 
    

    if(isset($_GET[$pagi]) && ctype_digit($_GET[$pagi]))
    {
        $page_num=$_GET[$pagi];           
       
    }
    else
    {
        $page_num=1;
    }

    if($page_num<1)
    {
        $page_num=1;
    }
    elseif($page_num>$last_page)
    {
        $page_num=$last_page;
    }

    //les nbres generés


    echo'<div id="paginer" ><table ><tr>';
    for($i=($page_num-1)*$nbre_P_par_page;$i<$page_num*$nbre_P_par_page;$i++)
    {   
        if($i>=$nbre_total_nbreP)
        {
        break;
        }
        else{
            if(($i!=(($page_num-1)*$nbre_P_par_page)) && ($i%10==0))
            {   if($i%20==0 )
                {
                    echo'</tr><tr >';
                }
                else
                {
                    echo'</tr><tr id="gris">';
                }
               
            }
            echo '<td>'.$tab[$i].'</td>';
          
        }
       
    }

    echo '</tr></table><div id=pagi>';

    $pagination='';
    if($last_page>1)
    {
        if($page_num>1)
        {
            $previous=$page_num-1;
            $pagination.='<a href="index.php?tab=exo1&'.$pagi.'='.$previous.'">Précédent</a>';


         for($i=$page_num-$nbre_page_avant_pagination_et_apres;$i<$page_num;$i++)
             {
              if($i>0)
                 {
                 $pagination.='<a href="index.php?tab=exo1&'.$pagi.'='.$i.'">'.$i.'</a>';
                 }
             }
        }
       
        $pagination.='<span class="activepage">'.$page_num.'</span>';

        for($i=$page_num+1;$i<$last_page;$i++)
        {
            $pagination.='<a href="index.php?tab=exo1&'.$pagi.'='.$i.'">'.$i.'</a>';
            if($i>=$page_num+$nbre_page_avant_pagination_et_apres)
                {
                break;
                }
        }

        if($page_num!=$last_page)
        {
            $next=$page_num+1;
            $pagination.='<a href="index.php?tab=exo1&'.$pagi.'='.$next.'">Suivant</a>';
        }

        
    }


    echo $pagination;
    echo'</div></div>';

        }
    }
    
?>