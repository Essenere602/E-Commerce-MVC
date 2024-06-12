<?php
namespace Models; // Définition du namespace pour la classe PaymentModel

use App\Database; // Importation de la classe Database depuis l'espace de noms App
use Lib\Slug; // Importation de la classe Slug depuis l'espace de noms Lib

class PaymentModel { // Définition de la classe PaymentModel

    protected $db; // Déclaration d'une propriété protégée pour stocker l'objet de connexion à la base de données
    protected $slug; // Déclaration d'une propriété protégée pour l'objet de génération de slug

    public function __construct() { // Constructeur de la classe PaymentModel
        $this->db = new Database(); // Initialise la connexion à la base de données
        $this->slug = new Slug(); // Initialise l'objet de génération de slug
    }

    public function fetchPaymentOpt() { // Méthode pour récupérer les moyens de paiement
        try { // Essaie d'exécuter les instructions suivantes
            $pdo = $this->db->getConnection()->prepare("SELECT id, payment_name FROM payment"); // Prépare la requête SQL pour sélectionner les moyens de paiement
            $pdo->execute(); // Exécute la requête SQL
            return $pdo->fetchAll(\PDO::FETCH_ASSOC); // Retourne tous les résultats de la requête sous forme d'un tableau associatif
        } catch (\PDOException $e) { // Attrape une éventuelle exception PDO
            echo "Erreur lors de la récupération des moyens de paiement : " . $e->getMessage(); // Affiche un message d'erreur en cas d'échec
        }
    }
}
