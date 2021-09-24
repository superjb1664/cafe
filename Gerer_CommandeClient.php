<?php
include("autoload.php");
$connexion = Creer_Connexion();



if(isset($_SESSION["idEntreprise"])){

    Vue_Structure_Entete();
    $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
    Vue_Entreprise_Client_Menu($quantiteMenu);
    //Vue_Entreprise_Client_Menu();

    $listeCommande = Rechercher_Commande_Entreprise($connexion , $_SESSION["idEntreprise"]);
    Vue_Afficher_Commande_Entreprise($listeCategorie, false);
}
else
{
    echo " <table style='padding: 20px; margin-bottom: 50px;   display: inline-block;   border: 1px solid #f1f1f1; box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24); background: #fff; ' >             
 <thead>
                    <tr>
                        <th>Ref commande</th>
                        <th>Etat</th>
                        <th>Date commande</th>
                        <th>Nombre d'articles</th>
                        <th>Montant HT</th>
                        <th>Montant TTC</th>
                    </tr>
                
                </thead>

 
             ";
}