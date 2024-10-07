<?php

namespace DevWeb\WebPhp\BD;

use DevWeb\WebPhp\Models\Personne;

interface IBDMapper {
    public function all(): array;
    public function insert(Personne $personne): Personne|false;
    public function findById(int $id): Personne|false;
    public function update(Personne $personne): Personne|false;
    public function delete(int $id): bool;
}
