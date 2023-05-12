<?php
    namespace App\Formulaire;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Utilisateur;
use App\Entity\Profil;

    class UtilisateurForm extends AbstractType
    {
        function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('util_login', TextType :: class)
                    ->add('util_mdp', PasswordType :: class)
                    ->add('Profil', EntityType::class, ['class' => Profil::class, 'choice_label' => 'pro_lib'])
                    ->add('Sauvegarde', SubmitType :: class);
        }
    }
?>