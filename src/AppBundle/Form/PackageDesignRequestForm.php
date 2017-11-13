<?php

namespace AppBundle\Form;

use AppBundle\Entity\RequestEntity\PackageDesignRequestEntity;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackageDesignRequestForm extends RequestForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("requestForm",RequestForm::class)
            ->add("submit",SubmitType::class,[
                "attr" => [
                    "formnovalidate" => "formnovalidate"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PackageDesignRequestEntity::class
        ]);
    }
}
