<?php

namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Validator\Constraints as Assert;


class CommentType extends AbstractType {

    public function getName() {
        return 'comment';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('author', TextType::class, array(
                'label' => 'Author',
                'constraints' => array(new Assert\NotBlank()),
                'attr' => array('placeholder' => 'Author')
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'Your comment',
                'attr' => array('placeholder' => 'Your comment', 'cols' => '58')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add comment',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Comments',
        ));
    }
}
