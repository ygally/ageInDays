<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class DateAgeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/^\d{8}$/',
                        'message' => 'Date should be in yyyyMMdd format',
                    ]),
                ],
            ])
            ->add('referenceDate', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('calculate', SubmitType::class, [
                'label' => 'Calculate Age',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
