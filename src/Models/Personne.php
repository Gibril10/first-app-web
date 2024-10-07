<?php

namespace DevWeb\WebPhp\Models;

class Personne {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email; // Ajout de l'attribut email

    public function __construct(int $id, string $nom, string $prenom, string $email) { // Ajout de l'email au constructeur
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email; // Initialisation de l'email
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getEmail(): string { // Ajout de la méthode getEmail
        return $this->email;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
}
