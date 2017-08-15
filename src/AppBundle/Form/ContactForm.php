<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactForm extends AbstractType{
    public function getName() {
        return 'contact_form';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('sender', TextType::class, array(
                    'label' => 'Nadawca',
                    'mapped' => false,
                    'required' => true,
                    'constraints' => array(
                        new Assert\Length(array('min' => 3)),
                        new Assert\NotBlank()
                    )
                ))
                ->add('email', EmailType::class, array(
                    'label' => 'Email',
                    'mapped' => false,
                    'required' => true,
                    'constraints' => array(
                        new Assert\Email(),
                        new Assert\NotBlank()
                    )
                ))
                ->add('title', TextType::class, array(
                    'label' => 'Tytuł wiadomości',
                    'mapped' => false,
                    'required' => true,
                    'constraints' => array(
                        new Assert\Length(array('min' => 3)),
                        new Assert\NotBlank()
                    )
                ))
                ->add('content', TextareaType::class, array(
                    'label' => 'Treść wiadomości',
                    'mapped' => false,
                    'required' => true,
                    'constraints' => array(
                        new Assert\Length(array('min' => 3, 'max' => 500)),
                        new Assert\NotBlank()
                    )
                ))
                ->add('submit', SubmitType::class, array(
                    'label' => "Wyślij wiadomość"
                ));
        
    }
}
