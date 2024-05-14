<?php
// Assurez-vous que le script est appelé via une requête POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifiez si les données du formulaire ont été envoyées
    if (isset($_POST["product_id"])) {
        // Récupérez les données du formulaire
        $userIp = $_SERVER['REMOTE_ADDR'];
        $productId = $_POST["product_id"];
        $price = $_POST["price"];
        
        // Connectez-vous à votre base de données (modifiez ces informations en fonction de votre configuration)
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "eshop_mvc";

        try {
            // Créez une connexion PDO
            $cnx = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Définissez le mode d'erreur PDO à exception
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparez votre requête SQL pour insérer les données dans la table user_cart
            $ins = $cnx->prepare("INSERT INTO user_cart (user_ip, cart_date, amount_exc_vat, order_status)
                                VALUES (?, NOW(), ?, 1);");
            
            // Liez les valeurs aux paramètres de la requête préparée
            $ins->bindParam(1, $userIp);
            $ins->bindParam(2, $price);
            
            // Exécutez la requête préparée pour insérer les données
            $ins->execute();

            // Succès : données insérées avec succès
            echo json_encode(array("success" => true));
        } catch(PDOException $e) {
            // Erreur : impossible d'insérer les données
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }

        // Fermez la connexion PDO
        $cnx = null;
    } else {
        // Si les données du formulaire ne sont pas complètes
        echo json_encode(array("success" => false, "message" => "Données du formulaire incomplètes"));
    }
} else {
    // Si la requête n'est pas une méthode POST
    echo json_encode(array("success" => false, "message" => "Cette page ne peut être accédée que par une méthode POST"));
}
?>
