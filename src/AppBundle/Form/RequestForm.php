<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 4:07 PM
 */

namespace AppBundle\Form;

use AppBundle\Entity\CategoryEntity;
use AppBundle\Entity\RequestEntity;
use Doctrine\ORM\EntityRepository;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\User;


class RequestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'*Name',
                'attr'=>[
                    'maxlength' => 100
                ]
            ])
            ->add('email',EmailType::class,['label'=>'*Email Address'])
            ->add('contactNumber',TextType::class,['label'=>'Contact Number'])
            ->add('category',EntityType::class,[
                'class' => CategoryEntity::class,
                //Check admin
                'placeholder' =>"Choose an option",
                'label'=>'*Category',
                'choice_label' => function($value){
                //getCategory from the entity and match if b2b marketing for proper Capitalization.
                    if($value->getCategory() === "b2b-marketing"){
                        return "Business to Business Marketing";
                    }
                    return ucwords(str_replace('-',' ',$value));
                },
                //if editing and no entity chosen for category, will trigger error
                'empty_data' => " "
            ])
            ->add('quantity',IntegerType::class,['label'=>'Quantity'])
            ->add('company',TextType::class,['label'=>'Company'])
            ->add('platform',ChoiceType::class,[
                'label' => 'Supported Platforms',
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'ebay' => 'ebay',
                    'amazon' => 'amazon',
                    'walmart' => 'walmart'
                ],
                'choice_label' => function($value){
                    return ucwords($value);
                }
            ])
            ->add('otherPlatform',TextType::class,['label'=>"Other Platforms (please specify)"])
            ->add('message',TextareaType::class,['label'=>'*Message']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => false,
            'data_class' => RequestEntity::class
        ]);
    }
}