<?php

// Informations de connexion à la base de données
$host = 'localhost:3306'; // Change le port en fonction de ton server SQL
$user = 'root';
$password = '';
$database = 'dailytrip';

try {
    // Connexion au serveur MySQL sans sélectionner de base de données
    $conn = new PDO("mysql:host=$host", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Créer la base de données si elle n'existe pas
    $sql = "CREATE DATABASE IF NOT EXISTS `$database` DEFAULT CHARACTER SET = 'utf8mb4'";
    $conn->exec($sql);
    echo "Base de données '$database' créée avec succès.\n";
    
    // Se connecter à la base de données créée
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Définir le moteur InnoDB pour la création des tables
    $engine = 'ENGINE = InnoDB';
    
    // Création des tables
    $tables = [
        // Il n'y a qu'une pair de " donc le tout ce lance en une boucle du foreach, SQL taitre le tout avec les ;
        // ce qui est plus rapide je pense que de faire tourner 9 fois le foreach
        "CREATE TABLE `trips`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `ref` VARCHAR(255) NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT NOT NULL,
            `cover` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `localisation_id` BIGINT NOT NULL,
            `category_id` BIGINT NOT NULL,
            `gallery_id` BIGINT NULL,
            `status` BOOLEAN
        );
        CREATE TABLE `localisation`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `start` VARCHAR(255) NOT NULL,
            `finish` VARCHAR(255) NOT NULL,
            `distance` DECIMAL NOT NULL,
            `duration` TIME NOT NULL
        );
        CREATE TABLE `poi`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `point` VARCHAR(255) NOT NULL,
            `localisation_id` BIGINT NOT NULL,
            `gallery_id` BIGINT NULL
        );
        CREATE TABLE `gallery`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT
        );
        CREATE TABLE `gallery_images`(
            `gallery_id` BIGINT NULL,
            `images_id` BIGINT NOT NULL
        );
        CREATE TABLE `images`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT
        );
        CREATE TABLE `admin`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL
        );
        CREATE TABLE `review`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `fullname` VARCHAR(255) NOT NULL,
            `content` TEXT NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `trip_id` BIGINT NOT NULL
        );
        CREATE TABLE `rating`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `note` INT NOT NULL,
            `ip_address` VARCHAR(255) NOT NULL,
            `trip_id` BIGINT NOT NULL
        );
        CREATE TABLE `category`(
            `id` BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `image` VARCHAR(255) NOT NULL
        );"
    ];
    
    // Exécution de la création des tables
    foreach ($tables as $tableSql) {
        try {
            $conn->exec($tableSql);
            echo "Table créée avec succès.\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création de la table : " . $e->getMessage() . "\n";
        }
    }
    
    // Ajout des clés étrangères
    $constraints = [
        // Il n'y a qu'une pair de " donc le tout ce lance en une boucle du foreach, SQL taitre le tout avec les ;
        // ce qui est plus rapide je pense que de faire tourner 9 fois le foreach
        "ALTER TABLE `trips` ADD CONSTRAINT `FK_trip_localisation` FOREIGN KEY (`localisation_id`) REFERENCES `localisation`(`id`);
        ALTER TABLE `trips` ADD CONSTRAINT `FK_trip_gallery` FOREIGN KEY (`gallery_id`) REFERENCES `gallery`(`id`);
        ALTER TABLE `trips` ADD CONSTRAINT `FK_trip_category` FOREIGN KEY (`category_id`) REFERENCES `category`(`id`);
        ALTER TABLE `poi` ADD CONSTRAINT `FK_poi_localisation` FOREIGN KEY (`localisation_id`) REFERENCES `localisation`(`id`);
        ALTER TABLE `poi` ADD CONSTRAINT `FK_poi_gallery` FOREIGN KEY (`gallery_id`) REFERENCES `gallery`(`id`);
        ALTER TABLE `gallery_images` ADD CONSTRAINT `FK_gallery_images_gallery` FOREIGN KEY (`gallery_id`) REFERENCES `gallery`(`id`);
        ALTER TABLE `gallery_images` ADD CONSTRAINT `FK_gallery_images_images` FOREIGN KEY (`images_id`) REFERENCES `images`(`id`);
        ALTER TABLE `review` ADD CONSTRAINT `FK_review_trip` FOREIGN KEY (`trip_id`) REFERENCES `trips`(`id`);
        ALTER TABLE `rating` ADD CONSTRAINT `FK_rating_trip` FOREIGN KEY (`trip_id`) REFERENCES `trips`(`id`);"

        // Autre facon de faire sans nommer les constraints
        // "ALTER TABLE `trips` ADD FOREIGN KEY (`localisation_id`) REFERENCES `localisation`(`id`);
        // ALTER TABLE `trips` ADD FOREIGN KEY (`gallery_id`) REFERENCES `gallery`(`id`);
        // ALTER TABLE `trips` ADD FOREIGN KEY (`category_id`) REFERENCES `category`(`id`);
        // ALTER TABLE `poi` ADD FOREIGN KEY (`localisation_id`) REFERENCES `localisation`(`id`);
        // ALTER TABLE `poi` ADD FOREIGN KEY (`gallery_id`) REFERENCES `gallery`(`id`);
        // ALTER TABLE `gallery_images` ADD FOREIGN KEY (`gallery_id`) REFERENCES `gallery`(`id`);
        // ALTER TABLE `gallery_images` ADD FOREIGN KEY (`images_id`) REFERENCES `images`(`id`);
        // ALTER TABLE `review` ADD FOREIGN KEY (`trip_id`) REFERENCES `trips`(`id`);
        // ALTER TABLE `rating` ADD FOREIGN KEY (`trip_id`) REFERENCES `trips`(`id`);"
    ];
    
    // Exécution des contraintes de clés étrangères
    foreach ($constraints as $constraintSql) {
        try {
            $conn->exec($constraintSql);
            echo "Contrainte de clé étrangère ajoutée avec succès.\n";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la contrainte : " . $e->getMessage() . "\n";
        }
    }
    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    exit;
} finally {
    // Fermer la connexion
    $conn = null;
}


