<?php

namespace App\Form\Type;

use App\Entity\Products;
use App\Entity\Countries;
use App\Entity\Companies;
use App\Entity\TypeProduct;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['is_edit'];
        
        $builder
            ->add('id', IntegerType::class, [
            'required' => $options['required'],
            'constraints' => [
                new Assert\Type([
                    'type' => 'integer',
                    'message' => 'The value {{ value }} is not a valid {{ type }}.',
                ])
                ],
                'invalid_message' => 'The value {{ value }} is not a valid integer.',
            ])
            ->add('company', EntityType::class, [ 
                'class' => Companies::class, 
                'choice_label' => 'company',
                'multiple' => true,
                'expanded' => false,
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ])
                ]
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'disabled' => $isEdit,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ]),
                ]
            ])
            ->add('type_product', EntityType::class, [
                'class' => TypeProduct::class,
                'choice_label' => 'Type Product',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ])
                ]
            ])
            ->add('country', EntityType::class, [
                'class' => Countries::class,
                'choice_label' => 'country',
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('imported', ChoiceType::class, [
                'required' => true, 
                'choices' => [
                    'Yes' => true, 
                    'No' => false
                ],
                'empty_data' => false,
                'choice_value' => function($choice) {
                    return is_bool($choice) ? (string) (int) $choice : $choice;
                },
                'constraints' => [
                    new Assert\NotNull([
                        'message' => "The field {{ label }} is required.",
                    ]),
                ]
            ])
            ->add('quantity', IntegerType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ]),
                ]
            ])
            ->add('caducated', ChoiceType::class, [
                'required'=> true, 
                'choices' => [
                    'Yes' => true, 
                    'No' => false,
                ],
                'empty_data' => false,
                'choice_value' => function($choice) {
                    return is_bool($choice) ? (string) (int) $choice : $choice;
                },
                'constraints' => [
                    new Assert\NotNull([
                        'message' => "The field {{ label }} is required.",
                    ]),
                ]
            ])
            ->add('photo', TextType::class, ['required' => false, 'label' => 'Upload Image'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
            'is_edit' => false,
        ]);
    }
}
