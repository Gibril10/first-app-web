<?php

namespace DevWeb\WebPhp\Utils;

use DevWeb\WebPhp\Models\Personne;
use Faker\Factory;
use Faker\Generator;

/**
 *
 */
class GeneratePersonnes {
    /**
     * @var Generator
     */
    private static Generator $faker;
    /**
     * @var GeneratePersonnes
     */
    private static GeneratePersonnes $instance;

    /**
     * GeneratePersonnes constructor.
     */
    private function __construct() {
        self::$faker = Factory::create('fr_FR');
    }

    /**
     * Writes Personne data to a specified file in JSON format.
     *
     * @param string $filename The name of the file to write the data to.
     * @param int $nb The number of Personne data to generate.
     * @throws \Exception If there is an error accessing the file.
     */
    public static function writeFilePersonneData(string $filename, int $nb = 10): void {
        $filehandler = fopen($filename, 'w');
        if (!$filehandler) {
            throw new \Exception(sprintf("Erreur d'accès au fichier %s", $filename));
        }
        $data = GeneratePersonnes::generatePersonneData($nb);
        fwrite($filehandler, json_encode($data, true));

        fclose($filehandler);
    }

    /**
     * Generates an array of Personne data.
     *
     * @param int $nb The number of Personne data to generate.
     * @return array The array of generated Personne data.
     */
    public static function generatePersonneData(int $nb = 10): array {
        $data = [];
        for ($i = 1; $i <= $nb; $i++) {
            $data[$i] = self::generatePersonneDataWithId($i);
        }
        return $data;
    }


    /**
     * Generates a Personne object with the given ID.
     *
     * @param int $num The ID to assign to the generated Personne object.
     * @return Personne The generated Personne object.
     */
    public static function generatePersonneDataWithId(int $num): Personne {
        if (!isset(self::$instance)) {
            self::$instance = new GeneratePersonnes();
        }
        return new Personne(id: $num, name: self::$faker->name(), phone: self::$faker->phoneNumber(), actif: self::$faker->boolean());
    }

    /**
     * Writes an array of Personne data to a specified file in JSON format.
     *
     * @param string $filename The name of the file to write the data to.
     * @param array $data The array of Personne data to be written to the file.
     * @throws \Exception If there is an error accessing the file.
     */
    public static function writeFileWithPersonneData(string $filename, array $data): void {
        $filehandler = fopen($filename, 'w');
        if (!$filehandler) {
            throw new \Exception(sprintf("Erreur d'accès au fichier %s", $filename));
        }
        $json = json_encode($data, true);
        fwrite($filehandler, $json);
        fclose($filehandler);
    }

    /**
     * Reads Personne data from a specified file and returns it as an array.
     *
     * @param string $filename The name of the file to read the data from.
     * @return array The array of Personne data read from the file.
     * @throws \Exception If there is an error reading the file.
     */
    public static function readFilePersonneData(string $filename): array {
        $datas = [];
        // Read the JSON file
        if (file_exists($filename)) {
            $json = file_get_contents($filename);
        } else {
            throw new \Exception(sprintf("Unable to read file. %s", $filename));
        }

        if (!$json) {
            throw new \Exception(sprintf("Erreur de lecture du fichier %s", $filename));
        }
        // Decode the JSON file
        $json_data = json_decode($json, true);
        foreach ($json_data as $data) {
            $datas[$data['id']] = self::generatePersonneWithData($data);
        }
        return $datas;
    }

    /**
     * Generates a Personne object from the given data.
     *
     * @param array $data The data to generate the Personne object from.
     * @return Personne The generated Personne object.
     */
    public static function generatePersonneWithData(array $data): Personne {
        if (!isset(self::$instance)) {
            self::$instance = new GeneratePersonnes();
        }
        return new Personne($data['id'], $data['name'], $data['phone'], $data['actif']);
    }
}
