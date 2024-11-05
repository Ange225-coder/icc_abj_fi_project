<?php

    namespace App\Controller\Admin;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class DashboardController extends AbstractController
    {
        #[Route(path: '/ad-icc-abj/dashboard', name: 'admin_dashboard')]
        #[IsGranted('ROLE_ADMIN')]
        public function adminDashboard(): Response
        {
            return $this->render('admin/dashboard.html.twig');
        }
    }