<?php

    namespace App\Security;

    use App\Entity\Admin\Admin;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
    use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
    use Symfony\Component\Security\Http\SecurityRequestAttributes;
    use Symfony\Component\Security\Http\Util\TargetPathTrait;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

    class AdminAuthenticator extends AbstractLoginFormAuthenticator
    {
        use TargetPathTrait;

        public const LOGIN_ROUTE = 'admin_login';

        private EntityManagerInterface $entityManager;
        private UserPasswordHasherInterface $passwordHasher;


        public function __construct(private readonly UrlGeneratorInterface $urlGenerator, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
        {
            $this->entityManager = $entityManager;
            $this->passwordHasher = $passwordHasher;
        }


        public function authenticate(Request $request): Passport
        {
            $adminName = $request->getPayload()->getString('adminName');
            $plainPass = $request->getPayload()->getString('password');

            $admin = $this->entityManager->getRepository(Admin::class)->findOneBy([
                'adminName' => $adminName,
            ]);

            if(!$admin) {
                throw new CustomUserMessageAuthenticationException('Accès interdit');
            }

            if(!$this->passwordHasher->isPasswordValid($admin, $plainPass)) {
                throw new CustomUserMessageAuthenticationException('Vérifier vos accès');
            }

            $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $adminName);

            return new Passport(
                new UserBadge($adminName),
                new PasswordCredentials($request->getPayload()->getString('password')),
                [
                    new CsrfTokenBadge('authenticate', $request->getPayload()->getString('_csrf_token')),            ]
            );
        }


        public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
        {
            if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
                return new RedirectResponse($targetPath);
            }

            // For example:
            return new RedirectResponse($this->urlGenerator->generate('admin_dashboard'));
            //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
        }

        protected function getLoginUrl(Request $request): string
        {
            return $this->urlGenerator->generate(self::LOGIN_ROUTE);
        }
    }
