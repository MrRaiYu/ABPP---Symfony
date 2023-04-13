<?php
    namespace App\Formulaire;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

    class ConnexionType extends AbstractType
    {
        function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('util_login', TextType :: class)
                    ->add('util_mdp', PasswordType :: class);
        }
    }
?>