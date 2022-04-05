<?php

/**
 * Fonction qui crée la connexion à la base de données.
 * @return PDO : Connexion à la base de données
 */
function Creer_Connexion()
{
    $instancePdo = new PDO('mysql:host=bdd.cafe.local;dbname=cafe;charset=UTF8',
        "bddcafe",
        "secret",
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_SSL_CA => "C:\Users\JB\PhpstormProjects\cafe\TLS\ca-cert.pem",
            PDO::MYSQL_ATTR_SSL_CERT => "C:\Users\JB\PhpstormProjects\cafe\TLS\client-cert.pem",
            PDO::MYSQL_ATTR_SSL_KEY => "C:\Users\JB\PhpstormProjects\cafe\TLS\client-key.pem",
        )
    );
    return $instancePdo;
}
