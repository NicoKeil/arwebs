<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class registerType extends AbstractType{


  public function createFormBuilder(FormBuilderInterface $builder, array $options){
      $builder->add('name', TextType::class, array(
        'label' => 'Nombre'
      ))
      ->add('email', EmailType::class, array(
        'label' => 'Correo electrónico'
      ))
      ->add('password', PasswordType::class, array(
        'label' => 'Constaseña'
      ))
      ->add('submit', SubmitType::class, array(
        'label' => 'Registrarse'
      ))
      ;
  }
}