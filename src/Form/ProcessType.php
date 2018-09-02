<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Places;

class ProcessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder
        	->add('processNumber', TextType::class, array('label' => 'Número de Proceso'))
          	->add('description', TextareaType::class, array('label' => 'Descripción'))
            ->add('processPlace', EntityType::class, array('class' => Places::class, 'label' => 'Sede'))
            ->add('budget', TextType::class, array('label' => 'Presupuesto', 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Guardar' ))
        ;
    }
}