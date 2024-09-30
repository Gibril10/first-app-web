<?php

namespace DevWeb\WebPhp\Models;

/**
 * Class Personne.
 */
class Personne implements \JsonSerializable {
    /**
     * @var int
     */
    protected int $id;
    /**
     * @var string
     */
    protected string $name;
    /**
     * @var string
     */
    protected string $phone;
    /**
     * @var bool
     */
    protected bool $actif;

    /**
     * @param int $id
     * @param string $name
     * @param string $phone
     * @param bool $actif
     */
    public function __construct(int $id = 0, string $name = "", string $phone = "", bool $actif = false) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->actif = $actif;
    }

    /**
     * Returns a string representation of the Personne object.
     *
     * @return string The string representation of the Personne.
     */
    public function __toString(): string {
        return sprintf("id: %d - %s %s %s", $this->id, $this->name, $this->phone, ($this->actif ? "Ok" : "Ko"));
    }


    /**
     * Serializes the Personne object to a JSON-compatible array.
     *
     * @return array The JSON-serializable data of the Personne.
     */
    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'actif' => $this->actif
        ];
    }

    /**
     * Gets the ID of the Personne.
     *
     * @return int The ID of the Personne.
     */
    public function getId(): int {
        return $this->id;
    }


    /**
     * Sets the ID of the Personne.
     *
     * @param int $id The ID to set.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /** Ajoutez les getters et setters pour les autres attributs de la classe Personne */
}
