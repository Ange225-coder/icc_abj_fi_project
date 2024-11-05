<?php

    namespace App\Form\Type\Public;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Form\Fields\Public\FiSearchFormFields;

    class FiSearchFormType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder->add('municipality', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre commune de residence, EX: Yopougon']
            ]);
        }


        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => FiSearchFormFields::class
            ]);
        }
    }