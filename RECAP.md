# Récapitulatif sur PHP & SQL

## PHP

Le web est une application sur le réseau internet. Elle fonctionne grâce au protocole HTTP, c'est le qui permet d'emmettre des requêtes sur le réseau.

Cette échange ce fait entre 2 serveur, il est très courant pour les usagers réguliers, on utilise un client web.

Le client web c'est le navigateur. Il est capable de lire les langages HTML et CSS. Ces langages permettent de faire l'affiche de pages web (Langage de développement).

Le JavaScript, lui est un langage de programmation. Il a la particularité de pouvoir interagir avec le navigateur donc le côté client. Grâce à NodeJS, on peut utiliser le JavaScript dans le côté serveur.

Le côté serveur, est initalement prévu pour l'exécution de scripts en tout genre (PHP, Python, Ruby...). Avec NodeJS on peut faire la même chose avec le JS.

Les principales fonctionnalités du côté serveur (backend) sont liées à l'écoute des requêtes HTTP, afin de répondre à celles-ci.


Avec PHP, on dispose d'un palette de fonctionnalités qui permettent de répondre à des requêtes HTTP et de manipuler des données : 

- $_SERVER : Contient les informations sur le serveur lors de l'exécution d'une requête HTTP quel quelle soit.
- $_REQUEST: Contient les informations sur la requête HTTP que l'on a envoyée.
  - $_GET: Contient les informations sur la requête HTTP GET.
  - $_POST: Contient les informations sur la requête HTTP POST.

Les décisions que l'on prend dans le script va utiliser quasiment tout le temps des données. Les différents types sont : 

| Type | Exemple | Variable d'exemple |
| :--- | :--- | :--- |
| string | "Jean" | $nom = "Jean" |
| boolean | false | $choix = false |
| array | [2, 4, 'Max'] | $data = [2, 4, 'Max'] |
| date | "2025-01-08" | $jour = new Date('today') |
| datetime | "2025-01-08 17:00:00" |$jour = new DateTime('today') |
| objet | Object | $client = new Client() |
| demical | 12,20 | $prix = 12,20 |
| float | 12,200403253053 | $tarif = 12,200403253053 |
| integer | 12 | $age = 12 |
| null | null | $rien = null |

Lors de la déclaration de variable ou de fonction par exemple, il faut utiliser le typage. Cela permet de sécuriser le comportement du script lorsqu'il s'exécute afin d'éviter les erreurs non désirées.

Exemple : 
```php
int $prix = 12,20;
Date $jour = new Date('today');
string $jour->format('d-m-Y');
string $dateDuJour = "2025-01-08";
```


En PHP chaque instruction doit être terminée par un point virgule. C'est indispensable pour que le code fonctionne.

Un fichier PHP termine par l'extension `.php`.

Pour interpréter un fichier PHP, il faut utiliser un serveur web et d'ouvrir la balise `<?php` pour commencer le code et la balise `?>` pour le terminer.