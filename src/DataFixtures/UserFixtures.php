<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<15;$i++){
            $user = new User();
            $user->setNom($this->faker->lastName())
            ->setPrenom($this->faker->firstName())
            ->setVille($this->faker->city())
            ->setTelephone($this->faker->phoneNumber())
            ->setAdresse($this->faker->address())
            ->setRoles(array('ROLE_USER'))
            ->setEmail(strtolower($user->getPrenom()).'.'.strtolower($user->getNom()).'@'.$this->faker->freeEmailDomain())
            ->setPassword($this->passwordHasher->hashPassword($user, strtolower($user->getPrenom())))
            ->setDateSouscription($this->faker->dateTimeThisYear())
            ->setDateDernierPaiement($this->faker->dateTimeThisYear());
            $this->addReference('user'.$i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }
}