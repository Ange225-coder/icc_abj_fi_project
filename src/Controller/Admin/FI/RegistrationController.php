<?php

    namespace App\Controller\Admin\FI;

    use App\Entity\Admin\FI;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Form\Fields\Admin\FI\RegistrationFields;
    use App\Form\Type\Admin\FI\RegistrationType;

    class RegistrationController extends AbstractController
    {
        private RequestStack $requestStack;
        private EntityManagerInterface $entityManager;


        public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
        {
            $this->entityManager = $entityManager;
            $this->requestStack = $requestStack;
        }


        #[Route(path: '/ad-icc-abj/fi/add', name: 'add_fi')]
        public function fi_registration(): Response
        {
            $fiEntity = new FI();
            $fiRegistrationFields = new RegistrationFields();

            $fiRegistrationType = $this->createForm(RegistrationType::class, $fiRegistrationFields);

            $fiRegistrationType->handleRequest($this->requestStack->getCurrentRequest());

            if($fiRegistrationType->isSubmitted() && $fiRegistrationType->isValid()) {

                $fiEntity->setMunicipality($fiRegistrationFields->getMunicipality());
                $fiEntity->setContactManager($fiRegistrationFields->getContactManager());
                $fiEntity->setZone($fiRegistrationFields->getZone());
                $fiEntity->setFiManager($fiRegistrationFields->getFiManager());
                $fiEntity->setFIName($fiRegistrationFields->getFIName());

                $this->entityManager->persist($fiEntity);
                $this->entityManager->flush();

                $this->addFlash('fi_registration_success', 'Une Famille d\'Impact vient d\'être ajoutée');

                return $this->redirectToRoute('admin_dashboard');
            }

            return $this->render('admin/fi/registration.html.twig', [
                'fi_registration_form' => $fiRegistrationType,
            ]);
        }
    }