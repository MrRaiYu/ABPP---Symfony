<?php
namespace App\Formulaire;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Entreprise;
use App\Entity\Specialite;
use App\Entity\Pays;

class EntrepriseForm extends AbstractType {
        
        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder->add('ent_rs', TextType :: class)
                    -> add('ent_ville', TextType :: class)
                    -> add('Adresse', TextareaType :: class)
                    -> add('pays_id', EntityType::class, ['class' => Pays::class, 'choice_label' => 'pays_lib'])
                    ->add('specialites', EntityType::class, ['class' => Specialite::class, 'choice_label' => 'SpeLib', 'multiple' => true, 'expanded' => true,])
                    ->add('Sauvegarde', SubmitType :: class);
        }
    }
?>