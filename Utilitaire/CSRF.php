<?php
function CSRF_Verifier()
{
    if($_REQUEST["CSRF"] == $_SESSION["CSRF_ACT"])
    {
        // Tout va bien !
        return true;
    }
    else
    {
        return false;
    }
}

function CSRF_Renouveler()
{
    if(isset($_SESSION["CSRF_NEXT"]))
        $_SESSION["CSRF_ACT"] = $_SESSION["CSRF_NEXT"];
    //CSRF_ACT : LA valeur qui doit être actuellement valide
    $_SESSION["CSRF_NEXT"] = random_int(0, 100000000);
    //CSRF_NEXT : LA valeur qui sera valide au prochain passage
}

function CSRF_GenereChamp()
{
    echo '<input type="hidden" name="CSRF" value= "'.$_SESSION["CSRF_NEXT"].'" />';
}