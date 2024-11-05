<?php

    namespace App\Form\Type\Admin\FI;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Form\Fields\Admin\FI\RegistrationFields;

    class RegistrationType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('FI_name', TextType::class, [
                    'label' => 'Nom de La F.I.',
                    'required' => false,
                ])

                ->add('municipality', TextType::class, [
                    'label' => 'Commune',
                ])

                ->add('zone', TextType::class, [
                    'label' => 'Quartier',
                    'attr' => ['placeholder' => 'EX: Deux Plateaux Vallon']
                ])

                ->add('contact_manager', TelType::class, [
                    'label' => 'Contact du responsable'
                ])

                ->add('fi_manager', TextType::class, [
                    'label' => 'Responsable de la F.I.'
                ])
            ;
        }



        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => RegistrationFields::class,
            ]);
        }
    }