<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 4:07 PM
 */

namespace AppBundle\Form;

use AppBundle\Entity\CategoryEntity;
use AppBundle\Entity\PlatformEntity;
use AppBundle\Entity\RequestEntity;
use Doctrine\ORM\EntityRepository;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('email',EmailType::class,[
                'label'=>'*Email Address',
                'attr'=>[
                    'maxlength' => 100
                ]
            ])
            ->add('contactNumber',TextType::class,[
                'label'=>'Contact Number',
                'attr'=>[
                    'maxlength' => 100
                ]
            ])
            ->add('category',EntityType::class,[
                'class' => CategoryEntity::class,
                'placeholder' => "Select a category",
                'label'=>'*Category',
                'choice_label' => function($value){
                    return ucwords(str_replace('-',' ',$value));
                },
                //if editing and no entity chosen for category, will trigger error
                'empty_data' => " "
            ])
            ->add('quantity',IntegerType::class,['label'=>'Quantity'])
            ->add('company',TextType::class,[
                'label'=>'Company',
                'attr'=>[
                    'maxlength' => 100
                ]
            ])
            ->add('isAmazon',CheckboxType::class,['label' => 'Amazon'])
            ->add('isEbay',CheckboxType::class,['label' => 'Ebay'])
            ->add('isWalmart',CheckboxType::class,['label' => 'Walmart'])
            ->add('otherPlatform',TextType::class,[
                'label' => 'Other Platforms (please specify)',
                'attr' => [
                    'maxlength' => 100
                ]
            ])
            ->add('message',TextareaType::class,[
                'label' => '*Message',
                'attr' => [
                    "maxlength" => 5000
                ]
            ])
            ->add('moveCategory',EntityType::class,[
                'class' => CategoryEntity::class,
                'placeholder' => "Move category to",
                'label'=>'Edit Category',
                'choice_label' => function($value){
                    return ucwords(str_replace('-',' ',$value));
                },
                //if editing and no entity chosen for category, will trigger error
                'empty_data' => " "
            ])
            ->add('isActive',ChoiceType::class,[
                'label' => 'Request Status',
                'choices' => [
                    'Open' => true,
                    'Closed' => false
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => false,
            'data_class' => RequestEntity::class
        ]);
    }
}