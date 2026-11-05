<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Enum\StatutExercice;
use App\Repository\GroupementRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExerciceFixtures extends Fixture implements DependentFixtureInterface
{
    // private GroupementRepository $repo;

    // public function __construct(GroupementRepository $repo) {
    //     $this->repo = $repo;
    // }

    public function __construct(private readonly GroupementRepository $repo) {
        
    }

    public function getDependencies(): array {
        return [GroupementFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $groupements = $this->repo->findAll();
        $compteur = 10;
        foreach ($groupements as $key => $groupement) {
            $annee = 2026;
            $exercice = (new Exercice())
                        ->setGroupement($groupement)
                        ->setDebutAt(new \DateTime("$annee-01-01"))
                        ->setFinAt(new \DateTime("$annee-12-31"))
                        ->setLimitePretsAt(new \DateTime("$annee-11-10"))
                        ->setRetributionAt(new \DateTime("$annee-11-30"))
                        ->setStatut(StatutExercice::ENCOURS);
            $manager->persist($exercice);
            for ($i = 0; $i < $compteur; $i++) {
                $annee--;
                $exercice = (new Exercice())
                    ->setGroupement($groupement)
                    ->setDebutAt(new \DateTime(($annee)."-01-01"))
                    ->setFinAt(new \DateTime(($annee)."-12-31"))
                    ->setLimitePretsAt(new \DateTime(($annee)."-11-10"))
                    ->setRetributionAt(new \DateTime(($annee)."-11-30"))
                    ->setStatut(StatutExercice::CLOTURE);
                $manager->persist($exercice);
            }
            $compteur -= 3;
            
        }

        $manager->flush();
    }
}
