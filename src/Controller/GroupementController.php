<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\GroupementRepository;

final class GroupementController extends AbstractController
{
    public function __construct(private readonly GroupementRepository $repo) {
        
    }

    #[Route('/groupement', name: 'app_groupement')]
    public function index(): Response
    {
        $groupements = $this->repo->findAll();
        return $this->render('groupement/index.html.twig', [
            'controller_name' => 'GroupementController',
            'dataGroupements' => $groupements
        ]);
    }
}
