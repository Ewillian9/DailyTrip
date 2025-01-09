# DailyTrip

Application de partage de trip sous forme de roadbook avec la possiblité de partager ses trajets et de noter les propositions existantes.

## Stack

PHP 8.4
SQLite (BDD)
Composer
LeafletJS (Librairie de gestion de cartes)
TailwindCSS
Google Fonts
Google Fonts Icons

## Fonctionnalités

- **Gestion des trips** :
  - CREATE : anonyme / everyone
  - READ : anonyme / everyone
  - UPDATE : admin
  - DELETE : admin / anonyme / everyone
- **Recherche de trips**
- **Notes et avis de trips**

Les plus +
- **Navigation sur une map**
- **POI : Points d'intérêts**

## Assets

Parmi les éléments que nous avons besoins pour les médias ou autre de l'application, il nous faut :

- [x] Icons
- [x] Images
- [x] Polices d'écritures
- [x] Codes couleurs : #38b6ff #fba708 #0c274e

## UI Design

La liste des compositions de l'interface de l'application :

- Navbar
- Filter bar
- Modals (forms, infos, etc.)
- Cards
- Map
- header, footer
- Trip Header
- Trip comments
- Trip notes

## Diagramme BDD

https://drawsql.app/teams/agiliteach/diagrams/dailytrip


## Homepage

Navigation
Section hero
Section des trips les plus populaires
Section chiffres : avec [counter.js](https://tombruijn.github.io/counter.js/) et inpiré de [algolia](https://www.algolia.com/)
- Nombre de trips
- Nombre de km cumulés
- Nombre de commentaires
- Nombre de partages
- Nombre de photos publiées
Section des régions les plus visitées
Footer