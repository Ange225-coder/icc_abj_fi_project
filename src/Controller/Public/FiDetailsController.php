<?php

    namespace App\Controller\Public;

    use App\Entity\Admin\FI;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Doctrine\ORM\EntityManagerInterface;

    class FiDetailsController extends AbstractController
    {
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route(path: '/famille_d_impact/details/{id}', name: 'fi_details')]
        public function fiDetails(int $id): Response
        {
            $fi_details = $this->entityManager->getRepository(FI::class)->find($id);

            return $this->render('public/fiDetails.html.twig', [
                'fi_details' => $fi_details,
            ]);
        }
    }