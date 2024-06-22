<?php

namespace App\Form\Type;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company_id', IntegerType::class, [ 'required' => true])
            ->add('name', TextType::class, ['required' => true])
            ->add('type_product', IntegerType::class, ['required' => true])
            ->add('country_id', IntegerType::class, ['required' => true])
            ->add('imported', ChoiceType::class, ['required' => true, 'choices' => ['Yes' => true, 'No' => false]])
            ->add('quantity', IntegerType::class, ['required' => true])
            ->add('caducated', ChoiceType::class, ['required'=> true, 'choices' => ['Yes' => true, 'No' => false]])
            ->add('photo', FileType::class, ['required' => false, 'label' => 'Upload Image'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
