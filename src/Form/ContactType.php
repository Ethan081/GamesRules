<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,[
                'attr' => [
                    'placeholder' => 'Prénom',
                ]
            ])
            ->add('lastname', TextType::class,[
                'attr' => [
                    'placeholder' => 'Nom',
                ]
            ])
            ->add('phone', TextType::class,[
                'attr' => [
                    'placeholder' => 'Téléphone',
                ]
            ])
            ->add('email', TextType::class,[
                'attr' => [
                    'placeholder' => 'E-mail',
                ]
            ])
            ->add('message', TextareaType::class,[
                'attr' => [
                    'placeholder' => 'Votre message',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
