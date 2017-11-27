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
                'label'=>'*Category',
                'choice_label' => function($value){
                //getCategory from the entity and match if b2b marketing for proper Capitalizaiton.
                    if($value->getCategory() === "b2b-marketing"){
                        return "B2B Marketing";
                    }
                    return ucwords(str_replace('-',' ',$value));
                }
            ])
            ->add('quantity',IntegerType::class,['label'=>'*Quantity'])
            ->add('company',TextType::class,['label'=>'Company'])
            ->add('platform',TextType::class,['label'=>'Platform']);

        //check if admin is logged in before adding this.
        $builder->add('isActive',ChoiceType::class,[
            'label'=>'Status',
            'choices' => ["Active" => true, "Closed" => false]
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