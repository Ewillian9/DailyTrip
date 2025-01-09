<?php

/**
 * Classe de gestion des trips
 * Pour gérer la création, la suppression des trips
 */

class Trip
{
    // PROPRIÉTÉS (ATTIRBUS, VARIABLES DE L'OBJET)
    private int $id;
    private string $ref;
    private string $title;
    private string $description;
    private string $cover;
    private string $email;
    private bool $status;
    private int $localisation_id;
    private int $category_id;
    private int $gallery_id;

    // CONSTRUCTEUR D'OBJET
    public function __construct()
    {
        $this->ref = uniqid('trip-', true);
        $this->status = false;
    }

    // GETTERS ET SETTERS PUR L'OBJET EN COURS

    /**
     * Récupère l'identifiant du voyage
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Récupère la référence du voyage
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * Définit la référence du voyage
     * @param string $ref
     * @return self
     */
    public function setRef(string $ref): self
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * Récupère le titre du voyage
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * Définit le titre du voyage
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Récupère la description du voyage
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    
    /**
     * Définit la description du voyage
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Récupère l'image de couverture du voyage
     * @return string
     */
    public function getCover(): string
    {
        return $this->cover;
    }

    /**
     * Définit l'image de couverture du voyage
     * @param string $cover
     * @return self
     */
    public function setCover(string $cover): self
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Récupère l'email associé au voyage
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Définit l'email associé au voyage
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Récupère le statut du voyage
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }
    
    /**
     * Définit le statut du voyage
     * @param bool $status
     * @return self
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }


    // // RELATIONS

    //     /**
    //  * Récupère l'identifiant de la localisation
    //  * @return int
    //  */
    // public function getLocalisationId(): int
    // {
    //     return $this->localisation_id;
    // }

    // /**
    //  * Récupère l'identifiant de la catégorie
    //  * @return int
    //  */
    // public function getCategoryId(): int
    // {
    //     return $this->category_id;
    // }

    // /**
    //  * Récupère l'identifiant de la galerie
    //  * @return int
    //  */
    // public function getGalleryId(): int
    // {
    //     return $this->gallery_id;
    // }

    // /**
    //  * Définit l'identifiant de la localisation
    //  * @param int $localisation_id
    //  * @return self
    //  */
    // public function setLocalisationId(int $localisation_id): self
    // {
    //     $this->localisation_id = $localisation_id;
    //     return $this;
    // }

    // /**
    //  * Définit l'identifiant de la catégorie
    //  * @param int $category_id
    //  * @return self
    //  */
    // public function setCategoryId(int $category_id): self
    // {
    //     $this->category_id = $category_id;
    //     return $this;
    // }

    // /**
    //  * Définit l'identifiant de la galerie
    //  * @param int $gallery_id
    //  * @return self
    //  */
    // public function setGalleryId(int $gallery_id): self
    // {
    //     $this->gallery_id = $gallery_id;
    //     return $this;
    // }



    /**
     * Méthode (fonction) pour récupérer tous les trips
     * @return array
     */


    /**
     * Méthode (fonction) pour récupérer tous les trips avec leur données jointes
     * @return array
     */


    /**
     * Méthode (fonction) pour récupérer un trip
     * @param string $ref
     * @return array
     */


    /**
     * Méthode (fonction) pour enregistrer tous les trips populaires
     * @param int $note
     * @return array
     */


    /**
     * Méthode (fonction) pour récupérer tous les POI
     * @return array
     */


    /**
     * Méthode (fonction) pour récupérer un POI
     * @return array
     */


    /**
     * Méthode (fonction) pour récupérer tous les trips
     * @return array
     */


    /**
     * Méthode (fonction) pour récupérer tous les trips
     * @return array
     */
}
