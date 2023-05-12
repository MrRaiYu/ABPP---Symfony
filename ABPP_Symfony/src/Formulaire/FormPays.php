<?php
namespace App\Formulaire;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormPays extends AbstractType {
        
        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder-> add('pays_lib', TextType :: class)
                    -> add('Sauvegarder', SubmitType :: class);
        }
    }
?>