<?php

namespace Tests\Utils;

use DevWeb\WebPhp\Models\Personne;
use DevWeb\WebPhp\Utils\GeneratePersonnes;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class GeneratePersonnesTest extends TestCase {


    #[Test]
    #[Testdox("Creation d'une Personne données aléatoires")]
    function create_personne_aleatoire() {
        $p = GeneratePersonnes::generatePersonneDataWithId(1);
        Assert::assertInstanceOf(Personne::class, $p);
        Assert::assertEquals(1, $p->getId());
    }

    #[Test]
    #[Testdox("Creation d'une Personne données fournies")]
    function create_personne() {
        $data = ["id" => 1, "name" => "Robert Duchmol", "phone" => "01 02 03 04 05", "actif" => true];
        $p = GeneratePersonnes::generatePersonneWithData($data);
        Assert::assertInstanceOf(Personne::class, $p);
        Assert::assertEquals(1, $p->getId());
        Assert::assertEquals($data["name"], $p->getName());
        Assert::assertEquals($data["phone"], $p->getPhone());
        Assert::assertEquals($data["actif"], $p->isActif());
    }


    #[Test]
    #[Testdox("Creation d'un tableau de Personnes")]
    function create_personnes() {
        $personnes = GeneratePersonnes::generatePersonneData(5);
        Assert::assertCount(5, $personnes);
        Assert::assertInstanceOf(Personne::class, $personnes[3]);
    }

    #[Test]
    #[Testdox("Lecture / Écriture des données dans un fichier")]
    function read_write_data_in_file() {
        $personnes = GeneratePersonnes::generatePersonneData(5);
        $p = $personnes[2];
        GeneratePersonnes::writeFileWithPersonneData('/tmp/fileTest.txt', $personnes);
        $readPersonnes = GeneratePersonnes::readFilePersonneData('/tmp/fileTest.txt');
        Assert::assertEquals(count($personnes), count($readPersonnes));
        $data = $readPersonnes[2];
        Assert::assertInstanceOf(Personne::class, $p);
        Assert::assertEquals($data->getId(), $p->getId());
        Assert::assertEquals($data->getName(), $p->getName());
        Assert::assertEquals($data->getPhone(), $p->getPhone());
        Assert::assertEquals($data->isActif(), $p->isActif());
    }

    #[Test]
    #[Testdox("Génère une exception en cas de fichier incorrect")]
    function exception_nom_fichier_inexistant() {
        $personnes = GeneratePersonnes::generatePersonneData(5);
        $this->expectException(\Exception::class);
        GeneratePersonnes::writeFileWithPersonneData('/tmp/nexistePas/fileTest.txt', $personnes);
    }

}

