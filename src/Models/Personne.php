<?php

namespace DevWeb\WebPhp\Models;

class Personne {
    private int $id;
    private string $name; // Assurez-vous que cette propriété existe
    private string $email; // Exemple d'autres propriétés

    public function __construct(int $id, string $name, string $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string { // Ajoutez cette méthode
        return $this->name;
    }

    public function getEmail(): string { // Exemple d'une autre méthode
        return $this->email;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void { // Ajoutez cette méthode si nécessaire
        $this->name = $name;
    }

    public function setEmail(string $email): void { // Exemple d'une autre méthode
        $this->email = $email;
    }
}
