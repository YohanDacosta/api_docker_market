<?php

namespace App\Form\Type;

use App\Entity\Companies;
use App\Entity\Countries;
use App\Entity\TypeCompany;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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
            ->add('type', EntityType::class, [
            'class' => TypeCompany::class,
            'choice_label' => 'Type Company',
            'required' => true,
            'constraints' => [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required.",
                ])
            ]
        ])
            ->add('cif', TextType::class, [
            'required' => true,
            'disabled' => $isEdit,
            'constraints' => [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required.",
                ]),
            ]
        ])
            ->add('name', TextType::class, [
            'required' => true,   
            'constraints' => [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required.",
                ]),
            ]
        ])
            ->add('country', EntityType::class, [
            'class' => Countries::class,
            'choice_label' => 'id',
            'required' => true,
            'constraints' => [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required.",
                ])
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Companies::class,
            'is_edit' => false,
        ]);
    }
}