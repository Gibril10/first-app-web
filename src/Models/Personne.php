<?php

namespace DevWeb\WebPhp\Models;

class Personne {
    private int $id;
    private string $nom;
    private string $prenom;

    public function __construct(int $id, string $nom, string $prenom) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
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

    public function setId(int $id): void {
        $this->id = $id;
    }
}
