<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 11/10/2017
 * Time: 4:07 PM
 */

namespace AppBundle\Form;

use AppBundle\Entity\AdminEntity;
use AppBundle\Entity\CategoryEntity;
use AppBundle\Entity\PlatformEntity;
use AppBundle\Entity\RequestEntity;
use Doctrine\ORM\EntityRepository;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
                'placeholder' => $options["username"] ? false : "Select Category",
                'label'=> $options["username"] ? '*Move Category' : '*Category',
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
            //Initialize fields
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($builder,$options){
                $form = $event->getForm();
                $data = $event->getData();


                if($options["username"] && $options["requestMethod"] === 'editing'){
                    //if an admin did not close the request yet.
                    if($data->getIsActive()){
                        $form
                            ->add('isActive',ChoiceType::class,[
                                'label' => 'Request Status',
                                'choices' => [
                                    'Open' => true,
                                    'Closed' => false
                                ]
                            ])
                            ->add('movedBy',HiddenType::class,[
                                'data' => json_encode($options["moversList"])
                            ])
                            ->add('closedBy',HiddenType::class);
                    }
                }

                //If there's no data yet or if request is still active, add the button
                if(!$data || $data->getIsActive()){
                    $form
                        ->add('submit',SubmitType::class,[
                        "label" => $options["username"] ? "Save" : "Submit",
                        "attr" => [
                            "formnovalidate" => "formnovalidate",
                            "class" => "btn btn-primary btn-submit",
                        ]
                    ]);
                }
            })
            ->addEventListener(FormEvents::PRE_SUBMIT,function(FormEvent $event) use ($options){
                $form = $event->getForm();
                $data = $event->getData();

                if($options["username"] && $options["requestMethod"] === 'editing'){
                    //Original categoryId and isActive coming from the database;
                    $staticCategory = $form->get('category')->getData()->getId();
                    $staticIsActive = $form->get('isActive')->getData();

                    $adminUsername = $options["username"];
                    $adminadminId = $options["adminId"];
                    $currentTime = new \DateTime();

                    //If categoryId is not equal to new categoryId
                    if($staticCategory != $data["category"]){
                        $data["movedBy"] = [];
                        $data["movedBy"]["adminId"] = $adminadminId;
                        $data["movedBy"]["username"] = $adminUsername;
                        $data["movedBy"]["date"] = $currentTime;
                        $data["movedBy"]["previous"] = $form->get('category')->getData()->getId();
                        $data["movedBy"]["current"] = (int)$data["category"];

                        // != because previous returns a number and current returns a string
                        if($data["movedBy"]["previous"] != $data["movedBy"]["current"]){
                            $event->setData($data);
                        }
                    }

                    //if status isActive and new status is not Active
                    if($staticIsActive != $data["isActive"]){
                        $data["closedBy"] = [];
                        $data["closedBy"]["adminId"] = $adminadminId;
                        $data["closedBy"]["username"] = $adminUsername;
                        $data["closedBy"]["date"] = $currentTime;
                        $event->setData($data);
                    };
                }
//                dump($data,$options["moversList"]);
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => false,
            'data_class' => RequestEntity::class,
            'username' => null,
            'adminId' => null,
            'requestMethod' => null,
            'moversList' => null
        ]);
    }
}