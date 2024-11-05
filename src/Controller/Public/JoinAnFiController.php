<?php

    namespace App\Controller\Public;

    use App\Entity\Admin\FI;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use App\Form\Fields\Public\FiSearchFormFields;
    use App\Form\Type\Public\FiSearchFormType;
    use Symfony\Component\HttpFoundation\RequestStack;

    class JoinAnFiController extends AbstractController
    {
        private EntityManagerInterface $entityManager;
        private RequestStack $requestStack;


        public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
        {
            $this->entityManager = $entityManager;
            $this->requestStack = $requestStack;
        }


        #[Route(path: '/famille_d_impact/rejoindre', name: 'join_an_fi')]
        public function joinAnFi(): Response
        {
            $fi = $this->entityManager->getRepository(FI::class)->findBy(
                [],
            );



            /**
             * fi search bar
             *
             * make search bar after project test
             *
             * $fiSearchFields = new FiSearchFormFields();
             *
             * $fiSearchType = $this->createForm(FiSearchFormType::class, $fiSearchFields);
             *
             * $request = $this->requestStack->getCurrentRequest();
             * $fiSearchType->handleRequest($request);
             *
             * $municipalityList = [];
             *
             * if($fiSearchType->isSubmitted() && $fiSearchType->isValid()) {
             * $this->addFlash('success', 'Formulaire soumis');
             *
             * $municipalityList = $this->entityManager
             * ->getRepository(FI::class)
             * ->createQueryBuilder('fi')
             * ->where('fi.municipality LIKE :municipality')
             * ->setParameter('municipality', '%'.$fiSearchFields->getMunicipality().'%')
             * ->getQuery()
             * ->getResult()
             * ;
             * }
             */


            return $this->render('public/joinAnFi.html.twig', [
                'fi_counter' => $fi,
                //'fi_search_form' => $fiSearchType->createView(),
                //'municipality_result' => $municipalityList,
                //'municipality' => $fiSearchFields->getMunicipality(),
            ]);
        }
    }