<?php
    namespace App\Formulaire;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormTypeInterface;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;

    class LoginForm extends AbstractType {
        
        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder->add('identifiant', TextType :: class)
                    -> add('mdp', PasswordType:: class)
                    -> add('connexion', SubmitType :: class);
                             
        }
    }
?>