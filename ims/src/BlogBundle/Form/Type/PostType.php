<?php

namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Validator\Constraints as Assert;


class PostType extends AbstractType {

    public function getName() {
        return 'post';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Title',
                'constraints' => array(new Assert\NotBlank()),
                'attr' => array('placeholder' => 'Title')
            ))
            ->add('secondTitle', TextType::class, array(
                'label' => 'Second Title',
                'attr' => array('placeholder' => 'Second Title')
            ))
            ->add('author', TextType::class, array(
                'label' => 'Author',
                'constraints' => array(new Assert\NotBlank()),
                'attr' => array('placeholder' => 'Author')
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description',
                'constraints' => array(new Assert\NotBlank()),
                'attr' => array('placeholder' => 'Description', 'cols' => '58')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add post',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Posts',
        ));
    }
}
