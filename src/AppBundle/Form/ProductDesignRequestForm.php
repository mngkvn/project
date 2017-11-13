<?php

namespace AppBundle\Form;

use AppBundle\Entity\RequestEntity\ProductDesignRequestEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductDesignRequestForm extends AbstractType
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
            'data_class' => ProductDesignRequestEntity::class,
        ]);
    }
}
