<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Choice;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('lastName', TextType::class, ['label' => 'Nom'])
            ->add('birthDate', DateType::class, ['label' => 'Date de naissance', 'widget' => 'single_text'])
            ->add('city', TextType::class, ['label' => 'Ville', 'attr' => ['class' => "city"]])
            ->add('emailAddress', EmailType::class, ['label' => 'Email'])
            ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
            ->add('passwordConfirm', PasswordType::class, ['label' => 'Confirmez le mot de passe'])
            ->add('spokenLanguages', ChoiceType::class, [
                'label' => 'Langues parlées:', 'multiple' => true,
                'expanded' => true, 'choices' => ['Français' => 'Français', 'Anglais' => 'Anglais']

            ])
            ->add('accepationCondition', CheckboxType::class, ['label' => 'j\'ai lu et j\'accepte les  Conditions Générales d\'Utilisation et la  Politique de Protection des Données Personnelles.']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
