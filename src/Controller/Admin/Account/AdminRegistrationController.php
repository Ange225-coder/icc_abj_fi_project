<?php

    namespace App\Controller\Admin\Account;

    use App\Entity\Admin\Admin;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Form\Fields\Admin\Account\AdminRegistrationFields;
    use App\Form\Type\Admin\Account\AdminRegistrationType;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

    class AdminRegistrationController extends AbstractController
    {
        private RequestStack $requestStack;
        private EntityManagerInterface $entityManager;
        private UserPasswordHasherInterface $passwordHasher;


        public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
        {
            $this->requestStack = $requestStack;
            $this->entityManager = $entityManager;
            $this->passwordHasher = $passwordHasher;
        }


        #[Route(path: '/ad-icc-abj/registration', name: 'admin_registration')]
        public function adminRegistration (): Response
        {
            $adminEntity = new Admin();
            $adminRegistrationFields = new AdminRegistrationFields();

            $adminRegistrationType = $this->createForm(AdminRegistrationType::class, $adminRegistrationFields);

            $request = $this->requestStack->getCurrentRequest();
            $adminRegistrationType->handleRequest($request);

            if($adminRegistrationType->isSubmitted() && $adminRegistrationType->isValid()) {

                $existingAdminName = $this->entityManager->getRepository(Admin::class)->findOneBy([
                    'adminName' => $adminRegistrationFields->getAdminName(),
                ]);

                if($existingAdminName) {
                    $adminRegistrationType->get('adminName')->addError(new FormError('Cet nom est déjà utilisé'));

                    //display error if admin name already exists
                    return $this->render('admin/account/registration.html.twig', [
                        'admin_registration_form' => $adminRegistrationType
                    ]);
                }

                $adminEntity->setAdminName($adminRegistrationFields->getAdminName());
                $adminEntity->setPassword($this->passwordHasher->hashPassword($adminEntity, $adminRegistrationFields->getPassword()));

                $this->entityManager->persist($adminEntity);
                $this->entityManager->flush();

                //authenticate admin

                return $this->redirectToRoute('admin_dashboard');
            }

            return $this->render('admin/account/registration.html.twig', [
                'admin_registration_form' => $adminRegistrationType
            ]);
        }
    }