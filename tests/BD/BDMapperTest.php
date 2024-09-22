<?php

namespace Tests\BD;

use DevWeb\WebPhp\BD\BDMapper;
use DevWeb\WebPhp\BD\IBDMapper;
use DevWeb\WebPhp\Models\Personne;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class BDMapperTest extends TestCase {

    private IBDMapper $bdMapper;

    #[Before]
    public function initDonnees() {
        $datas = [
            ["id" => 1, "name" => "Robert Duchmol", "phone" => "01 02 03 04 05", "actif" => true],
            ["id" => 2, "name" => "Julie Lebas", "phone" => "02 03 04 05 06", "actif" => false],
            ["id" => 3, "name" => "Gérard Martin", "phone" => "51 04 03 02 05", "actif" => true]
        ];
        $this->bdMapper = BDMapper::getInstance('./testDonnees.txt', $datas);
    }

    #[After]
    public function truncateDatas() {
        $this->bdMapper = BDMapper::getInstance('./testDonnees.txt', [], true);
    }


    #[Test]
    #[Testdox("Test la modification d'une personne")]
    public function testUpdate() {
        $personne = new Personne(1, "Roro Duchmol", "01 02 03 04 05", false);
        $p = $this->bdMapper->update($personne);
        $this->assertInstanceOf(Personne::class, $p);
        $this->assertCount(3, $this->bdMapper->all());
        $this->assertFalse($p->isActif());
        $this->assertEquals("Roro Duchmol", $p->getName());
    }


    #[Test]
    #[Testdox("Test la modification d'une personne avec un identifiant inconnu")]
    public function testUpdatePersonneNonConnu() {
        $personne = new Personne(4, "Roro Duchmol", "01 02 03 04 05", false);
        $p = $this->bdMapper->update($personne);
        $this->assertFalse($p);
    }


    #[Test]
    #[Testdox("Test l'insertion d'une personne")]
    public function testInsert() {
        $personne = new Personne(0, "Lucas Barteau", "05 04 03 02 05", false);
        $p = $this->bdMapper->insert($personne);
        $this->assertInstanceOf(Personne::class, $p);
        $this->assertCount(4, $this->bdMapper->all());
        $this->assertEquals(4, $p->getId());
        $this->assertEquals("Lucas Barteau", $p->getName());
    }

    #[Test]
    #[Testdox("Test l'insertion d'une personne avec un id != 0 et qui existe")]
    public function testInsert_withIdQuiExiste() {
        $personne = new Personne(3, "Lucas Barteau", "05 04 03 02 05", false);
        $p = $this->bdMapper->insert($personne);
        $this->assertFalse($p);
    }

    #[Test]
    #[Testdox("Test l'insertion d'une personne avec un id != 0 et qui n'existe pas")]
    public function testInsert_withIdQuiNExistePas() {
        $personne = new Personne(5, "Lucas Barteau", "05 04 03 02 05", false);
        $p = $this->bdMapper->insert($personne);
        $this->assertInstanceOf(Personne::class, $p);
        $this->assertCount(4, $this->bdMapper->all());
        $this->assertEquals(5, $p->getId());
        $this->assertEquals("Lucas Barteau", $p->getName());
    }

    #[Test]
    #[Testdox("Test la suppression d'une personne avec identifiant connu")]
    public function testDelete() {
        $p = $this->bdMapper->delete(1);
        $this->assertTrue($p);
        $this->assertCount(2, $this->bdMapper->all());
        $this->assertFalse($this->bdMapper->findById(1));
    }

    #[Test]
    #[Testdox("Test la suppression d'une personne avec identifiant non connu")]
    public function testDeleteWitnUnknownId() {
        $p = $this->bdMapper->delete(4);
        $this->assertFalse($p);
    }

    #[Test]
    #[Testdox("Test la recherche d'une personne par identifiant")]
    public function testFindById() {
        $personne = $this->bdMapper->findById(2);
        $this->assertInstanceOf(Personne::class, $personne);
        $this->assertEquals("Julie Lebas", $personne->getName());
    }

    #[Test]
    #[Testdox("Test la recherche d'une personne par identifiant inconnu")]
    public function testFindById_withUnknownId() {
        $personne = $this->bdMapper->findById(6);
        $this->assertFalse($personne);
    }

    #[Test]
    #[Testdox("Test la recherche de toutes les personnes")]
    public function testAll() {
        $personnes = $this->bdMapper->all();
        Assert::assertCount(3, $personnes);
    }
}

