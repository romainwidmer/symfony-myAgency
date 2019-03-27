<?php

namespace App\Form;

use App\Entity\PropertySearch;
use App\Entity\Feature;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PropertySearchType extends AbstractType {


  public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder
          ->add('maxPrice', IntegerType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
              'placeholder' => 'Maximum price'
            ]
          ])
          ->add('minSurface', IntegerType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
              'placeholder' => 'Minimal surface'
            ]
          ])
          ->add('features', EntityType::class, [
            'required' => false,
            'label' => false,
            'class' => Feature::class,
            'choice_label' => 'name',
            'multiple' => true
          ])
      ;
  }

  public function configureOptions(OptionsResolver $resolver) {
      $resolver->setDefaults([
          'data_class' => PropertySearch::class,
          'method' => 'get',
          'csrf_protection' => false
      ]);
  }


  public function getBlockPrefix() {
    return '';
  }

}
