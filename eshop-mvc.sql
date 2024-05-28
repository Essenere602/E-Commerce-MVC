-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 16 mai 2024 à 07:28
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eshop_mvc`
--

DROP DATABASE IF EXISTS eshop_mvc;
CREATE DATABASE eshop_mvc;
USE eshop_mvc;

-- --------------------------------------------------------

--
-- Structure de la table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `delivery_option` varchar(50) NOT NULL,
  `deliver_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payment_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `ean` varchar(50) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `slug` text,
  `stock` int(11) NOT NULL,
  `online` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_description`, `category_id`, `price`, `ean`, `manufacturer_id`, `slug`, `stock`, `online`) VALUES
(1, 'Harden 8', 'Chaussure du looser des Clippers', 2, '160.00', NULL, NULL, 'chaussure-du-looser-des-clippers', 3, NULL),
(2, 'Charles 7', 'La chaussure qui pue des pieds', 2, '99.00', NULL, NULL, '', 6, NULL),
(4, 'La tête à toto', 'Est moins drôle que la tête à charles', NULL, '10.00', NULL, NULL, 'la-t-ete-a-toto', 2, 1),
(5, 'A.E 1', 'La chaussure ', 2, '120.00', NULL, NULL, 'harden-8', 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `cat_parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product_category`
--

INSERT INTO `product_category` (`id`, `cat_name`, `slug`, `cat_parent`) VALUES
(1, 'Vêtements', 'vetements', NULL),
(2, 'chaussures', 'chaussures', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `product_manufacturer`
--

CREATE TABLE `product_manufacturer` (
  `id` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product_manufacturer`
--

INSERT INTO `product_manufacturer` (`id`, `company`, `email`, `phone`) VALUES
(1, 'Adidas', 'contact@adidas.fr', '098765432'),
(2, 'New Balance', 'contact@new-balance.fr', '098765432');

-- --------------------------------------------------------

--
-- Structure de la table `product_option`
--

CREATE TABLE `product_option` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_name` text NOT NULL,
  `option_value` text NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `option_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_number` text,
  `company_vat_number` text,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(95) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `last_connection` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `company_name`, `company_number`, `company_vat_number`, `email`, `phone`, `password`, `birthdate`, `last_connection`, `active`) VALUES
(1, 'Allegret', 'Olivier', NULL, NULL, NULL, '', '09876543', 'obiwan', '2024-05-07', '2024-05-06 14:00:22', 1),
(2, 'Allegret', 'Olivier', NULL, NULL, NULL, 'oallegret@gmail.com', '0123456789', 'obiwan', '2024-05-14', '2024-05-06 19:51:24', 1),
(3, 'Charles', 'Trois', NULL, NULL, NULL, 'charges@gmail.co.uk', '0123456789', 'oirithr', '2024-05-15', '2024-05-06 19:55:31', 1),
(4, 'Brossard', 'Papi', NULL, NULL, NULL, 'piaodf@gmail.com', '0123456789', 'obiwan', '2024-05-09', '2024-05-06 20:14:23', 1),
(5, 'Spielberg', 'Maurice', NULL, NULL, NULL, 'maurice@et.com', '0123456789', 'indiana', '1946-10-05', '2024-05-06 20:34:44', 1),
(7, 'Tirlipinpon', 'Surle chi hua hua', NULL, NULL, NULL, 'carlos@gmail.com', '0123456789', 'obiwan', '1968-04-18', '2024-05-06 21:24:01', 1),
(8, 'Kent', 'Clark', NULL, NULL, NULL, 'superman@jla.com', '098765432', 'bartman', '1980-02-17', '2024-05-07 07:43:42', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text,
  `zip` varchar(15) NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_date` datetime NOT NULL,
  `amount_exc_vat` decimal(9,2) DEFAULT NULL,
  `order_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_cart`
--

INSERT INTO `user_cart` (`id`, `user_id`, `cart_date`, `amount_exc_vat`, `order_status`) VALUES
(14, 2, '2024-05-15 14:43:07', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_cart_detail`
--

CREATE TABLE `user_cart_detail` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_option_id` int(11) DEFAULT NULL,
  `product_option_value` int(11) DEFAULT NULL,
  `price_exc_vat` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vat` decimal(3,2) NOT NULL,
  `vat_amount` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_cart_detail`
--

INSERT INTO `user_cart_detail` (`id`, `cart_id`, `product_id`, `product_option_id`, `product_option_value`, `price_exc_vat`, `quantity`, `vat`, `vat_amount`) VALUES
(9, 14, 1, NULL, NULL, '160.00', 2, '0.20', '32.00'),
(10, 14, 2, NULL, NULL, '99.00', 1, '0.20', '19.80'),
(11, 14, 5, NULL, NULL, '120.00', 2, '0.20', '24.00');

-- --------------------------------------------------------


--
-- Déchargement des données de la table `delivery_choice`
--

INSERT INTO `delivery` (`id`, `delivery_option`, `deliver_time`) VALUES 
(1, 'DPD', '1 semaine'), 
(2, 'UPS', '1 semaine'), 
(3, 'Colissimo', '1 semaine'), 
(4, 'La Poste', '1 semaine'), 
(5, 'Mondial Relay', '1 semaine');

-- --------------------------------------------------------



INSERT INTO `payment` (`id`, `payment_name`) VALUES 
(1, 'CB'), 
(2, 'Paypal'), 
(3, 'Apple Pay'), 
(4, 'Binance'), 
(5, 'Forfait Telephone');

--
-- Structure de la table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `amount_exc_vat` decimal(9,2) NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user_order_detail`
--

CREATE TABLE `user_order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_option_value` int(11) NOT NULL,
  `price_exc_vat` decimal(9,2) NOT NULL,
  `vat` decimal(3,2) NOT NULL,
  `vat_amount` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_manufacturer`
--
ALTER TABLE `product_manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_option`
--
ALTER TABLE `product_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_id` (`user_id`);

--
-- Index pour la table `user_cart_detail`
--
ALTER TABLE `user_cart_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Index pour la table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Index pour la table `user_order_detail`
--
ALTER TABLE `user_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `product_manufacturer`
--
ALTER TABLE `product_manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `product_option`
--
ALTER TABLE `product_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user_cart_detail`
--
ALTER TABLE `user_cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_order_detail`
--
ALTER TABLE `user_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `product_manufacturer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_option`
--
ALTER TABLE `product_option`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_cart_detail`
--
ALTER TABLE `user_cart_detail`
  ADD CONSTRAINT `cart_id` FOREIGN KEY (`cart_id`) REFERENCES `user_cart` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_order_detail`
--
ALTER TABLE `user_order_detail`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;


-- Add delivery_id column to user_order table
ALTER TABLE `user_order`
ADD COLUMN `delivery_id` int(11) NOT NULL AFTER `payment_id`;

-- Set up the foreign key constraint
ALTER TABLE `user_order`
ADD CONSTRAINT `fk_user_order_delivery`
FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`id`);

-- AJOUT DE FOREGN KEY POUR IDENTIFIER LA COMMANDE AVEC LA BONNE LIVRAISON

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;