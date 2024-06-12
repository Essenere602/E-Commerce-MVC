<?php
namespace Models; // Définition de l'espace de noms du fichier

use App\Database; // Importation de la classe Database depuis l'espace de noms App
use Lib\Slug; // Importation de la classe Slug depuis l'espace de noms Lib

class AddressCartModel { // Déclaration de la classe AddressCartModel

    protected $db; // Déclaration de la propriété protégée $db pour la connexion à la base de données
    protected $slug; // Déclaration de la propriété protégée $slug pour la gestion des slugs

    public function __construct() { // Définition du constructeur de la classe
        $this->db = new Database(); // Initialisation de la propriété $db avec une nouvelle instance de la classe Database
        $this->slug = new Slug(); // Initialisation de la propriété $slug avec une nouvelle instance de la classe Slug
    }

    // Méthode pour récupérer l'adresse de livraison de l'utilisateur
    public function fetchAddress() {
        $userId = $_SESSION['id']; // Récupération de l'identifiant de l'utilisateur à partir de la session
        try { // Bloc try-catch pour gérer les exceptions PDO
            // Préparation de la requête SQL pour récupérer l'adresse de l'utilisateur
            $pdo = $this->db->getConnection()->prepare("SELECT address_1, address_2, zip, city, country FROM user_address WHERE user_id = ?");
            // Exécution de la requête SQL avec l'identifiant de l'utilisateur fourni
            $pdo->execute([$userId]);
            // Récupération de l'adresse sous forme de tableau associatif
            $address = $pdo->fetch(\PDO::FETCH_ASSOC);

            // Stocker l'adresse dans la session s'il existe
            if ($address) {
                $_SESSION['user_address'] = $address;
            }

            return $address; // Renvoi de l'adresse récupérée
        } catch (\PDOException $e) { // Capture d'une exception PDO en cas d'erreur
            // Affichage de l'erreur PDO
            echo "Erreur lors de la récupération de l'adresse : " . $e->getMessage();
            return false; // Renvoi de faux en cas d'erreur
        }
    }

    // Méthode pour vérifier si une adresse existe pour un utilisateur
    public function addressExists($userId) {
        try { // Bloc try-catch pour gérer les exceptions PDO
            // Préparation de la requête SQL pour compter le nombre d'adresses pour un utilisateur donné
            $pdo = $this->db->getConnection()->prepare("SELECT COUNT(*) FROM user_address WHERE user_id = ?");
            // Exécution de la requête SQL avec l'identifiant de l'utilisateur fourni
            $pdo->execute([$userId]);
            // Renvoi vrai si le nombre d'adresses est supérieur à zéro, sinon faux
            return $pdo->fetchColumn() > 0;
        } catch (\PDOException $e) { // Capture d'une exception PDO en cas d'erreur
            // Affichage de l'erreur PDO
            echo "Erreur lors de la vérification de l'adresse : " . $e->getMessage();
            return false; // Renvoi de faux en cas d'erreur
        }
    }

    // Méthode pour sauvegarder ou mettre à jour une adresse utilisateur
    public function saveAddress() {
        $userId = $_SESSION['id']; // Récupération de l'identifiant de l'utilisateur à partir de la session
        // Récupération des données du formulaire
        $addressOne = $_POST['address_1']; 
        $addressTwo = $_POST['address_2']; 
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        
        try { // Bloc try-catch pour gérer les exceptions PDO
            if ($this->addressExists($userId)) { // Vérification si une adresse existe déjà pour l'utilisateur
                // Préparation de la requête SQL pour mettre à jour l'adresse de l'utilisateur
                $pdo = $this->db->getConnection()->prepare("UPDATE user_address SET address_1 = ?, address_2 = ?, zip = ?, city = ?, country = ? WHERE user_id = ?");
                // Exécution de la requête SQL avec les valeurs fournies
                $pdo->execute([$addressOne, $addressTwo, $zip, $city, $country, $userId]);
                // Affichage d'un message de succès
                echo "<h1>Adresse mise à jour</h1>";
            } else {
                // Préparation de la requête SQL pour insérer une nouvelle adresse utilisateur
                $pdo = $this->db->getConnection()->prepare("INSERT INTO user_address (user_id, address_1, address_2, zip, city, country) VALUES (?, ?, ?, ?, ?, ?)");
                // Exécution de la requête SQL avec les valeurs fournies
                $pdo->execute([$userId, $addressOne, $addressTwo, $zip, $city, $country]);
                // Affichage d'un message de succès
                echo "<h1>Adresse sauvegardée</h1>";
            }

            // Mettre à jour la session avec la nouvelle adresse
            $_SESSION['user_address'] = [
                'address_1' => $addressOne,
                'address_2' => $addressTwo,
                'zip' => $zip,
                'city' => $city,
                'country' => $country
            ];
        } catch (\PDOException $e) { // Capture d'une exception PDO en cas d'erreur
            // Affichage de l'erreur PDO
            echo "Erreur lors de la sauvegarde de l'adresse : " . $e->getMessage();
        }
    }
}
?>
