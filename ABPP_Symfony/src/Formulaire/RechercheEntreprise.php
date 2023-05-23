<?php
    namespace App\Formulaire;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;

    class RechercheEntreprise extends AbstractType {
        
        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder->add('Nom', TextType :: class, array('required' => false))
                    -> add('Adresse', TextType :: class, array('required' => false))
                    -> add('Ville', TextType :: class, array('required' => false))
                    -> add('Recherche', SubmitType :: class);
        }
    }
?>