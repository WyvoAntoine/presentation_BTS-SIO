<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Bac;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
            'required' => true,
            'label' => "Votre nom :",
            'constraints' => [
            new NotBlank(['message' => 'Veuillez saisir un nom']),
            new Length([
            'min' => 2,
            'minMessage' => 'Le nom doit faire au moins {{ limit }} carac.'
            ]),
            ]
            ])
            
            ->add('prenom', TextType::class, [
                'required' => true,
                'label' => "Votre prénom :",
                'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir un prénom']),
                new Length([
                'min' => 6,
                'minMessage' => 'Le prénom doit faire au moins {{ limit }} carac.'
                ]),
                ]
                ])
            
            ->add('adresse', TextType::class, [
                'required' => true,
                'label' => "Votre adresse :",
                'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir une adresse']),
                new Length([
                'min' => 6,
                'minMessage' => 'L\'adresse doit faire au moins {{ limit }} carac.'
                ]),
                ]
                ])
            
            ->add('cp', NumberType::class, [
                'required' => true,
                'label' => "Votre code postal :",
                'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir un code postal']),
                new Length([
                'min' => 5,
                'max' => 5,
                'minMessage' => 'Le code postal doit faire 5 carac.'
                ]),
                ]
                ])
            
            ->add('ville', TextType::class, [
                'required' => true,
                'label' => "Votre ville :",
                'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir une ville']),
                new Length([
                'min' => 6,
                'minMessage' => 'La ville doit faire au moins {{ limit }} carac.'
                ]),
                ]
                ])
            
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => "Votre email :",
                'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir un email']),
                new Length([
                'min' => 6,
                'minMessage' => 'Le email doit faire au moins {{ limit }} carac.'
                ]),
                ]
                ])
            
            ->add('tel', NumberType::class, [
                'required' => true,
                'label' => "Votre téléphone :",
                'constraints' => [
                new NotBlank(['message' => 'Veuillez saisir un numéro de téléphone']),
                new Length([
                'min' => 6,
                'minMessage' => 'Le numéro de téléphone doit faire au moins {{ limit }} carac.'
                ]),
                ]
                ])
            
            ->add('lebac', EntityType::class, [
                'required' => true,
                'label' => 'Choisir un bac :',
                'class' => Bac::class,
                'choice_label' => 'nombac',
                'constraints' => [
                new NotBlank([
                'message' => 'Veuillez choisir un bac'
                ])
                ]
                ])
            
            ->add('save', SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
