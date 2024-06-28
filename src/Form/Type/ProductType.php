<?php

namespace App\Form\Type;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company_id', IntegerType::class, [ 
                'required' => true, 
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ]),
                    new Assert\Type([
                        'type' => 'integer',
                        'message' => "The value {{ value }} is not a valid {{ type }}.",
                    ]),
                ],
                'invalid_message' => 'The value {{ value }} is not a valid integer.',
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ]),
                ]
            ])
            ->add('type_product', IntegerType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ]),
                    new Assert\Type([
                        'type' => 'integer',
                        'message' => "The value {{ value }} is not a valid {{ type }}.",
                    ]),
                ],
                'invalid_message' => 'The value {{ value }} is not a valid integer.',
            ])
            ->add('country_id', IntegerType::class, [
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => "The field {{ label }} is required.",
                    ]),
                    new Assert\Type([
                        'type' => 'integer',
                        'message' => "The value {{ value }} is not a valid {{ type }}.",
                    ]),
                ],
                'invalid_message' => 'The value {{ value }} is not a valid integer.',
            ])
            ->add('imported', ChoiceType::class, [
                'required' => true, 
                'choices' => ['Yes' => true, 'No' => false],
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
                'choices' => ['Yes' => true, 'No' => false],
                'constraints' => [
                    new Assert\NotNull([
                        'message' => "The field {{ label }} is required.",
                    ]),
                ]
            ])
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
