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
        foreach ($groupements as $key => $groupement) {
            $exercice = (new Exercice())
                        ->setGroupement($groupement)
                        ->setDebutAt(new \DateTime('2026-01-01'))
                        ->setFinAt(new \DateTime('2026-12-31'))
                        ->setLimitePretsAt(new \DateTime('2026-10-01'))
                        ->setRetributionAt(new \DateTime('2026-11-01'))
                        ->setStatut(StatutExercice::ENCOURS);
            $manager->persist($exercice);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
