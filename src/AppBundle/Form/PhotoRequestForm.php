<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/9/2017
 * Time: 9:29 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoRequestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('requestForm',RequestForm::class,[
                'data_class' => PhotoRequestForm::class,
            ])
            ->add('platform',TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\RequestEntity\PhotoRequestEntity',
        ]);
    }
}