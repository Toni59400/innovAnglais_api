<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Mot;
use App\Entity\Theme;
use App\Entity\Categorie;
use App\Entity\ListeMot;
class MotFixtures extends Fixture
{
    private $faker;
    public function __construct(){
        $this->faker=Factory::create("fr_FR");
 }

    public function load(ObjectManager $manager): void
    {
        $themes = ["Theme1", "Theme2", "Theme3", "Theme4"];
    

        for($j=0;$j<3;$j++){
            $theme = new Theme();
            $theme->setNomTheme($themes[$j]);
            $listeMot = new ListeMot();
            $listeMot->setTheme($theme);
            $categorie = new Categorie();
            $categorie->setNomCategorie($this->faker->word());
            for($i=0;$i<100;$i++){
                $mot = new Mot();
                $mot->setNom($this->faker->word());
                $tradMot = new Mot();
                $tradMot->setNom($this->faker->word());
                $this->addReference('mot'.$i.'-'.$j, $mot);
                $listeMot->addMot($mot);
                $mot->addMotCorrespondant($tradMot);
                $mot->addCategorie($categorie);
                $tradMot->addCategorie($categorie);
                $manager->persist($mot);
                $manager->persist($tradMot);
            }
            $manager->persist($theme);
            $manager->persist($categorie);
            $manager->persist($listeMot);
            $manager->flush();
        }   
        
    }
}