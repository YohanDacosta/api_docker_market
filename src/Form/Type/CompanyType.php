<?php

namespace App\Form\Type;

use App\Entity\Companies;
use App\Entity\Countries;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', IntegerType::class, [
            'required'   => $options['required'],
            'constraints'=> [
                new Assert\Type(
                    type: 'integer',
                    message: 'The value {{ value }} is not a valid {{ type }}.',
                )
            ]
        ])
            ->add('type', IntegerType::class, [
            'required'   => true,
            'constraints'=> [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required!",
                ]),
                new Assert\Type(
                    type: 'integer',
                    message: 'The value {{ value }} is not a valid {{ type }}.',
                )
            ]
        ])
            ->add('cif', TextType::class, [
            'required'   => true,
            'constraints'=> [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required!",
                ]),
            ]
        ])
            ->add('name', TextType::class, [
            'required'   => true,   
            'constraints'=> [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required!",
                ]),
            ]
        ])
            ->add('country', EntityType::class, [
            'class' => Countries::class,
            'choice_label' => 'id',
            'required' => true,
            'constraints'=> [
                new Assert\NotBlank([
                    'message' => "The field {{ label }} is required!",
                ])
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Companies::class,
            'csrf_protection' => false
        ]);
    }
}