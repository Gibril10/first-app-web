<?php

namespace DevWeb\WebPhp\BD;

use DevWeb\WebPhp\Models\Personne;
use DevWeb\WebPhp\Utils\GeneratePersonnes;

class BDMapper implements IBDMapper {
    private const DEFAULT_FILENAME = __DIR__ . "/../../datas/donnees.txt";
    private static IBDMapper $instance;
    private array $datas;
    private string $filename;

    private function __construct(string $filename, array $datas, bool $init) {
        $this->filename = $filename;
        $this->datas = [];
        if (!empty($datas) || $init) {
            try {
                GeneratePersonnes::writeFileWithPersonneData($this->filename, $datas);
            } catch (\Exception $e) {
                throw new \Exception(sprintf("Erreur d'accès au fichier %s", $this->filename));
            }
        }
        try {
            $this->datas = GeneratePersonnes::readFilePersonneData($this->filename);
        } catch (\Exception $e) {
            try {
                GeneratePersonnes::writeFilePersonneData($this->filename, 50);
            } catch (\Exception $e) {
                throw new \Exception(sprintf("Erreur d'accès au fichier %s", $this->filename));
            }
            $this->datas = GeneratePersonnes::readFilePersonneData($this->filename);
        }
    }

    public static function getInstance(string $filename = self::DEFAULT_FILENAME, array $datas = [], bool $init = false): IBDMapper {
        if (!isset(self::$instance) || !empty($datas) || $init) {
            self::$instance = new BDMapper($filename, $datas, $init);
        }
        return self::$instance;
    }

    public static function sortById(Personne $a, Personne $b): int {
        return $a->getId() - $b->getId();
    }

    public function all(): array {
        return $this->datas;
    }

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

    private function getNextId(): int {
        usort($this->datas, [BDMapper::class, 'sortById']);
        $personne = end($this->datas);
        return $personne->getId() + 1;
    }

    public function findById(int $id): Personne|false {
        foreach ($this->datas as $data) {
            if ($data->getId() === $id) {
                return $data;
            }
        }
        return false;
    }

    public function update(Personne $personne): Personne|false {
        $p = $this->findById($personne->getId());
        if ($p) {
            $this->datas[$personne->getId()] = $personne;
            GeneratePersonnes::writeFileWithPersonneData($this->filename, $this->datas);
            return $personne;
        }
        return false;
    }

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
