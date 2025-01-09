<?php
require_once 'vendor/autoload.php';

// Connexion à la base de données MySQL
$host = 'localhost:3306'; // Change le port en fonction de ton server SQL
$dbname = 'dailytrip';
$username = 'root';  // Remplacez par votre nom d'utilisateur
$password = '';      // Remplacez par votre mot de passe
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// Initialisation de Faker
$faker = Faker\Factory::create();

// Liste des catégories réelles
$categories = ['Montagne', 'Trail', 'Exploration', 'Désert', 'Roadtrip Automoto'];

// Fonction pour insérer des données dans la table `category`
function insertCategory($pdo, $faker, $categories) {
    foreach ($categories as $category) {
        $stmt = $pdo->prepare("INSERT INTO category (name, image) VALUES (?, ?)");
        $stmt->execute([$category, $faker->imageUrl(640, 480)]);
    }
}

// Fonction pour insérer des données dans la table `localisation`
function insertLocalisation($pdo, $faker) {
    // Générer des coordonnées (longitude, latitude)
    $startLatitude = $faker->latitude;
    $startLongitude = $faker->longitude;
    $finishLatitude = $faker->latitude;
    $finishLongitude = $faker->longitude;

    $stmt = $pdo->prepare("INSERT INTO localisation (start, finish, distance, duration) VALUES (?, ?, ?, ?)");
    $stmt->execute([$startLatitude . ',' . $startLongitude, $finishLatitude . ',' . $finishLongitude, $faker->randomFloat(2, 10, 500), $faker->time('H:i:s')]);

    return $pdo->lastInsertId();
}

// Fonction pour insérer des données dans la table `trips`
function insertTrip($pdo, $faker, $categories) {
    $localisationId = insertLocalisation($pdo, $faker);

    // Choisir une catégorie au hasard
    $categoryId = $pdo->query("SELECT id FROM category ORDER BY RAND() LIMIT 1")->fetchColumn();

    $stmt = $pdo->prepare("INSERT INTO trips (ref, title, description, cover, email, localisation_id, category_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$faker->uuid, $faker->catchPhrase, $faker->text, $faker->imageUrl(800, 600), $faker->email, $localisationId, $categoryId, $faker->numberBetween(0, 1)]);
}

// Fonction pour insérer des données dans la table `poi`
function insertPoi($pdo, $faker) {
    $localisationId = insertLocalisation($pdo, $faker);

    // Générer un point d'intérêt avec des coordonnées géographiques
    $point = $faker->latitude . ',' . $faker->longitude;

    $stmt = $pdo->prepare("INSERT INTO poi (point, localisation_id) VALUES (?, ?)");
    $stmt->execute([$point, $localisationId]);
}

// Fonction pour insérer des données dans la table `rating`
function insertRating($pdo, $faker) {
    $tripId = $pdo->query("SELECT id FROM trips ORDER BY RAND() LIMIT 1")->fetchColumn();

    $stmt = $pdo->prepare("INSERT INTO rating (note, ip_address, trip_id) VALUES (?, ?, ?)");
    $stmt->execute([$faker->numberBetween(1, 5), $faker->ipv4, $tripId]);
}

// Fonction pour insérer des données dans la table `review`
function insertReview($pdo, $faker) {
    $tripId = $pdo->query("SELECT id FROM trips ORDER BY RAND() LIMIT 1")->fetchColumn();

    $stmt = $pdo->prepare("INSERT INTO review (fullname, content, email, trip_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$faker->name, $faker->paragraph, $faker->email, $tripId]);
}

// Insérer des catégories
insertCategory($pdo, $faker, $categories);

// Insérer des trips, reviews et ratings
for ($i = 0; $i < 100; $i++) {
    insertTrip($pdo, $faker, $categories);
}

for ($i = 0; $i < 300; $i++) {
    insertReview($pdo, $faker);
}

for ($i = 0; $i < 500; $i++) {
    insertRating($pdo, $faker);
}

// for ($i = 0; $i < 500; $i++) {
//     insertPoi($pdo, $faker);
// }

echo "Base de données remplie avec succès avec 100 trips, 300 reviews et 500 ratings! Bien joué!";