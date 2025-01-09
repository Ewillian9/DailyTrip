<?php

/**
 * Classe de gestion du routage des pages
 */

require_once './src/utils/Database.php';

class Router
{
    // Propriétés (Attributs, vairiables de l'objet)
    private string $url;
    private string $path;
    private array $params;

    /**
     * Un constructeur permet d'instancier un objet issue d'une classe
     * en lui attribuant des valeurs et caractéristiques par défaut.
     */
    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI']; // URL de la requête
        $this->path = parse_url($this->url, PHP_URL_PATH); // Chemin de la requête
        $this->path = rtrim($this->path, '/'); // Supprimer le slash de la fin
        $this->params = [];
    }

    // METHODES (FONCTIONS)
    /**
     * Méthode (fonction) pour démarrer le routage
     * Permet de lancer l'écoute des requêtes et
     * d'y répondre en fonction de l'URL demandée
     * @return void
     */
    public function start()
    {
        $this->goTo();
    }

    /**
     * Méthode (fonction) permettant de vérifier si l'URL demandée
     * existe puis de rendre la page correspondante à la demande
     * @return void
     */
    public function goTo(): void
    {
        if ($this->path === '') {
            $this->path = '/home';
        } else if (preg_match('/^\/trip\/([a-zA-Z0-9-]+)$/', $this->path, $matches)) {
            // Stocke la référence et redirige vers la vue trip
            $this->params['tripRef'] = $matches[1];
            $this->goToOne();
            return;
        }

        $view = './src/views' . $this->path . '.html.php';
        if (file_exists($view)) {
            require_once $view;
        } else {
            require_once './src/views/404.html.php';
        }
    }

    /**
     * Méthode permettant de retourner un trip
     * demandé par l'URL via le paramètre `tripRef`
     */
    public function goToOne(): void
    {
        try {
            $db = new Database();
            $trip = $db->one('trips', $this->params['tripRef']);

            if ($trip) {
                // Si le trip est trouvé, on le stocke dans les paramètres
                $this->params['trip'] = $trip;
                require_once './src/views/trip.html.php';
            } else {
                // Si le trip n'est pas trouvé, on affiche la page 404
                require_once './src/views/404.html.php';
            }
        } catch (PDOException $e) {
            // Stocke le message d'erreur dans les paramètres
            $this->params['error'] = $e->getMessage();
            require_once './src/views/500.html.php';
        } catch (Exception $e) {
            // Pour toutes les autres erreurs
            $this->params['error'] = $e->getMessage();
            require_once './src/views/500.html.php';
        }
    }

    /**
     * Récupère les paramètres de l'URL
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
