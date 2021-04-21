<?php
/**
 * Ce script est composé de fonctions d'exploitation des données
 * détenues pas le SGBDR MySQL utilisées par la logique de l'application.
 *
 * C'est le seul endroit dans l'application où a lieu la communication entre
 * la logique métier de l'application et les données en base de données, que
 * ce soit en lecture ou en écriture.
 *
 * PHP version 7
 *
 * @category  Database_Access_Function
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

/**
 *  Les fonctions dépendent d'une connection à la base de données,
 *  cette fonction est déportée dans un autre script.
 */
require_once 'connect-db.php';

/**
 * Obtenir la liste de tous les pays référencés d'un continent donné
 *
 * @param string $continent le nom d'un continent
 * 
 * @return array tableau d'objets (des pays)
 */
function getCountriesByContinent($continent)
{
    // pour utiliser la variable globale dans la fonction
    global $pdo;
    $query = 'SELECT * FROM Country WHERE Continent = :cont;';
    $prep = $pdo->prepare($query);
    // on associe ici (bind) le paramètre (:cont) de la req SQL,
    // avec la valeur reçue en paramètre de la fonction ($continent)
    // on prend soin de spécifier le type de la valeur (String) afin
    // de se prémunir d'injections SQL (des filtres seront appliqués)
    $prep->bindValue(':cont', $continent, PDO::PARAM_STR);
    $prep->execute();
    // var_dump($prep);  pour du debug
    // var_dump($continent);

    // on retourne un tableau d'objets (car spécifié dans connect-db.php)
    return $prep->fetchAll();
}
function getAllContinents()
{
    global $pdo;
    $query = 'SELECT DISTINCT Continent FROM Country;';
    return $pdo ->query($query)->fetchAll();
}
function getUsers($username,$password)
{
    global $pdo;
    $query = 'SELECT * FROM users WHERE username = :use AND password = :pas;';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':use', $username, PDO::PARAM_STR);
    $prep->bindValue(':pas', $password, PDO::PARAM_STR);
    $prep->execute();

    $result = $prep->fetch(PDO::FETCH_ASSOC);
    
    echo $result;
    return $result;
}

/**
 * Obtenir la liste des pays
 *
 * @return liste d'objets
 */
function getAllCountries()
{
    global $pdo;
    $query = 'SELECT * FROM Country;';
    return $pdo->query($query)->fetchAll();

}

function getNameCapital($idville)   
{

    global $pdo;
    $query = 'SELECT Name FROM city WHERE id = :id;';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $idville, PDO::PARAM_STR);
    $prep->execute();

    $result = $prep->fetch(PDO::FETCH_ASSOC);
    
    
    return $result;
}

function getNameLanguage($idCountry)   
{

    global $pdo;
    $query = 'select Name from countrylanguage INNER Join language On countrylanguage.idLanguage = language.id where idCountry = :id;';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $idCountry, PDO::PARAM_STR);
    $prep->execute();

    $result = $prep->fetch(PDO::FETCH_ASSOC);
    
    
    return $result;
}

function insertUser($username,$password)
{
    global $pdo;
    $query = 'INSERT INTO `users`(`username`, `password`) VALUES (:user, :pas)';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':user', $username, PDO::PARAM_STR);
    $prep->bindValue(':pas', $password, PDO::PARAM_STR);
    $prep->execute();

    $result = $prep->fetch(PDO::FETCH_ASSOC);
    
    
    return $result;
}
