<?php
namespace Models; // Définition de l'espace de noms du fichier

use App\Database; // Importation de la classe Database depuis l'espace de noms App

class AccountModel { // Déclaration de la classe AccountModel

    protected $db; // Déclaration de la propriété protégée $db pour la connexion à la base de données

    public function __construct() { // Définition du constructeur de la classe
        $this->db = new Database(); // Initialisation de la propriété $db avec une nouvelle instance de la classe Database
    }

    // Méthode pour mettre à jour les informations de l'utilisateur
    public function updateUser() {
        // Récupération de l'identifiant de l'utilisateur à partir de la session
        $user_id = $_SESSION['id'];
        // Récupération des données du formulaire
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        // Hashage du mot de passe à partir des données du formulaire
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // Définition de la valeur par défaut pour l'état du compte utilisateur
        $active = 1;

        try { // Bloc try-catch pour gérer les exceptions PDO
            // Préparation de la requête SQL pour mettre à jour les informations de l'utilisateur
            $pdo = $this->db->getConnection()->prepare("UPDATE user SET lastname = ?, firstname = ?, email = ?, phone = ?, password = ?, active = ? WHERE id = $user_id;");
            // Exécution de la requête SQL avec les valeurs fournies
            $pdo->execute([$lastname, $firstname, $email, $phone, $password, $active]);
            // Affichage d'un message de succès
            echo "<h1>Utilisateur modifié avec succès</h1>";
        } catch (\PDOException $e) { // Capture d'une exception PDO en cas d'erreur
            // Affichage de l'erreur PDO
            echo "Erreur lors de la modification de l'utilisateur : " . $e->getMessage();
        }
    }

    // Méthode pour récupérer les adresses de l'utilisateur
    public function getAddresses($userId) {
        // Préparation de la requête SQL pour récupérer les adresses de l'utilisateur
        $query = $this->db->getConnection()->prepare("SELECT * FROM user_address WHERE user_id = :user_id");
        // Exécution de la requête SQL avec l'identifiant de l'utilisateur fourni
        $query->execute(['user_id' => $userId]);
        // Renvoi de toutes les lignes de résultat sous forme de tableau
        return $query->fetchAll();
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
            // Renvoi de faux en cas d'erreur
            return false;
        }
    }

    // Méthode pour sauvegarder ou mettre à jour une adresse utilisateur
    public function saveAddress() {
        // Récupération de l'identifiant de l'utilisateur à partir de la session
        $userId = $_SESSION['id'];
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

    // Méthode pour récupérer les commandes de l'utilisateur
    public function getOrders($userId) {
        // Préparation de la requête SQL pour récupérer les commandes de l'utilisateur
        $query = $this->db->getConnection()->prepare("SELECT user_order.*, user_order_detail.* FROM user_order JOIN user_order_detail ON user_order_detail.order_id = user_order.id WHERE user_id = :user_id");
        // Exécution de la requête SQL avec l'identifiant de l'utilisateur fourni
        $query->execute(['user_id' => $userId]);
        // Renvoi de toutes les lignes de résultat sous forme de tableau
        return $query->fetchAll();
    }
}
?>
