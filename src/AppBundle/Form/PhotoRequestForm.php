<?php
/**
 * Created by PhpStorm.
 * User: KevinOtto
 * Date: 11/9/2017
 * Time: 9:29 AM
 */

namespace AppBundle\Form;


use AppBundle\Entity\RequestEntity\PhotoRequestEntity;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoRequestForm extends RequestForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('requestForm',RequestForm::class)
            ->add('platform',TextType::class)
            ->add('submit',SubmitType::class,[
                "attr" => [
                    "formnovalidate" => "formnovalidate"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PhotoRequestEntity::class,
        ]);
    }
}