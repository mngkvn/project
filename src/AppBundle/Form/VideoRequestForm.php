<?php

namespace AppBundle\Form;


use AppBundle\Entity\RequestEntity\VideoRequestEntity;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoRequestForm extends RequestForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("requestForm",RequestForm::class)
            ->add("platform",TextType::class)
            ->add("submit",SubmitType::class,[
                "attr" => [
                    "formnovalidate" => "formnovalidate"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VideoRequestEntity::class,
        ]);
    }
}
