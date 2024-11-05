<?php

    namespace App\Controller\Admin;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class Home extends AbstractController
    {
        #[Route(path: '/ad-icc-abj', name: 'admin_icc')]
        public function home(): Response
        {
            return $this->render('admin/home.html.twig');
        }
    }