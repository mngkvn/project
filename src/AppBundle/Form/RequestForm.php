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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RequestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name',TextType::class,['label'=>'*Name'])
            ->add('email',EmailType::class,['label'=>'*Email'])
            ->add('contactNumber',TextType::class,['label'=>'*Contact Number'])
            ->add('message',TextareaType::class,['label'=>'*Message'])
            ->add('category',EntityType::class,[
                'class' => CategoryEntity::class,
                'placeholder' => 'Choose category',
                'label'=>'*Category'
            ])
            ->add('quantity',IntegerType::class,['label'=>'*Quantity'])
            ->add('company',TextType::class,['label'=>'Company'])
            ->add('platform',TextType::class,['label'=>'Platform']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => false,
            'data_class' => RequestEntity::class
        ]);
    }
}