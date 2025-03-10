<?php

    namespace App\Form\Type\Admin\Account;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use App\Form\Fields\Admin\Account\AdminRegistrationFields;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class AdminRegistrationType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('adminName', TextType::class, [
                    'attr' => ['placeholder' => 'Nom d\'administrateur']
                ])

                ->add('password', PasswordType::class, [
                    'attr' => ['placeholder' => 'Mot de passe']
                ])
            ;
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => AdminRegistrationFields::class,
            ]);
        }
    }