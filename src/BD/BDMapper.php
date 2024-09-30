<?php

namespace DevWeb\WebPhp\BD;

use DevWeb\WebPhp\Models\Personne;
use DevWeb\WebPhp\Utils\GeneratePersonnes;

class BDMapper implements IBDMapper {

    /**
     * @var string
     */
    private const DEFAULT_FILENAME = __DIR__ . "/../../datas/" . "donnees.txt";
    /**
     * @var BDMapper
     */
    private static IBDMapper $instance;
    /**
     * @var array
     */
    private array $datas;
    /**
     * @var string $filename
     */
    private string $filename;


    /**
     * BDMapper constructor.
     *
     * @param string $filename The name of the file to read/write data.
     * @param array $datas The initial data to be written to the file.
     * @param bool $init Whether to initialize the file with the given data.
     * @throws \Exception If there is an error accessing the file.
     */
    private function __construct(string $filename, array $datas, bool $init) {
        $this->filename = $filename;
        $this->datas = [];
        if (!empty($datas) || $init) {
            try {
                GeneratePersonnes::writeFileWithPersonneData($this->filename, $datas);
            } catch (\Exception $e1) {
                throw new \Exception(sprintf("Erreur d'accès au fichier %s", $this->filename));
            }
        }
        try {
            $this->datas = GeneratePersonnes::readFilePersonneData($this->filename);
        } catch (\Exception $e) {
            try {
                GeneratePersonnes::writeFilePersonneData($this->filename, 50);
            } catch (\Exception $e1) {
                throw new \Exception(sprintf("Erreur d'accès au fichier %s", $this->filename));
            }

            $this->datas = GeneratePersonnes::readFilePersonneData($this->filename);
        }
    }

    /**
     * Returns the BDMapper instance.
     *
     * If the instance does not exist, it creates a new instance with the given filename and data.
     *
     * @param string $filename The name of the file to read/write data.
     * @param array $datas The initial data to be written to the file.
     * @param bool $init Whether to initialize the file with the given data.
     * @return BDMapper The BDMapper instance.
     */
    public static function getInstance(string $filename = self::DEFAULT_FILENAME, array $datas = [], bool $init = false): IBDMapper {
        if (!empty($datas) || !isset(self::$instance) || $init) {
            self::$instance = new BDMapper($filename, $datas, $init);
        }
        return self::$instance;
    }

    /**
     * Compares two Personne objects by their ID.
     *
     * @param Personne $a The first Personne object.
     * @param Personne $b The second Personne object.
     * @return int The comparison result: negative if $a's ID is less than $b's,
     *             zero if they are equal, positive if $a's ID is greater than $b's.
     */
    public static function sortById(Personne $a, Personne $b): int {
        return $a->getId() - $b->getId();
    }

    /**
     * Retrieves all Personne objects.
     *
     * @return array The array of all Personne objects.
     */
    public function all(): array {
        return $this->datas;
    }

    /**
     * Inserts a Personne object into the data array.
     *
     * If the Personne object has an ID of 0, it assigns a new ID to it.
     * If a Personne with the same ID does not already exist, it adds the Personne to the data array
     * and writes the updated data to the file.
     *
     * @param Personne $personne The Personne object to insert.
     * @return Personne|false The inserted Personne object, or false if a Personne with the same ID already exists.
     */
    public function insert(Personne $personne): Personne|false {
        if ($personne->getId() == 0) {
            $personne->setId($this->getNextId());
        }
        $p = $this->findById($personne->getId());
        if (!$p) {
            $this->datas[$personne->getId()] = $personne;
            GeneratePersonnes::writeFileWithPersonneData($this->filename, $this->datas);
            return $personne;
        }
        return false;
    }

    /**
     * Gets the next available ID for a new Personne object.
     *
     * Sorts the existing Personne objects by their ID in ascending order,
     * retrieves the highest ID, and returns the next ID.
     *
     * @return int The next available ID.
     */
    private function getNextId(): int {
        usort($this->datas, [BDMapper::class, 'sortById']);
        $personne = end($this->datas);
        return $personne->getId() + 1;
    }

    /**
     * Finds a Personne object by its ID.
     *
     * @param int $id The ID of the Personne to find.
     * @return Personne|false The Personne object if found, or false if not found.
     */
    public function findById(int $id): Personne|false {
        foreach ($this->datas as $data) {
            if ($data->getId() === $id) {
                return $data;
            }
        }
        return false;
    }

    /**
     * Updates an existing Personne object in the data array.
     *
     * If a Personne with the same ID exists, it updates the Personne in the data array
     * and writes the updated data to the file.
     *
     * @param Personne $personne The Personne object to update.
     * @return Personne|false The updated Personne object, or false if the Personne does not exist.
     */
    public function update(Personne $personne): Personne|false {
        $p = $this->findById($personne->getId());
        if ($p) {
            $this->datas[$personne->getId()] = $personne;
            GeneratePersonnes::writeFileWithPersonneData($this->filename, $this->datas);
            return $personne;
        }
        return false;
    }

    /**
     * Deletes a Personne object by its ID.
     *
     * If a Personne with the given ID exists, it removes the Personne from the data array
     * and writes the updated data to the file.
     *
     * @param int $id The ID of the Personne to delete.
     * @return bool True if the Personne was deleted, false if the Personne does not exist.
     */
    public function delete(int $id): bool {
        $p = $this->findById($id);
        if ($p) {
            unset($this->datas[$id]);
            GeneratePersonnes::writeFileWithPersonneData($this->filename, $this->datas);
            return true;
        }
        return false;
    }

}
