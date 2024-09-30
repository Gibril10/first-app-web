<?php

namespace DevWeb\WebPhp\BD;

use DevWeb\WebPhp\Models\Personne;

interface IBDMapper {

    function all(): array;
    function findById(int $id): Personne|false;
    function insert(Personne $personne): Personne|false;
    function update(Personne $personne): Personne|false;
    function delete(int $id): bool;
}
