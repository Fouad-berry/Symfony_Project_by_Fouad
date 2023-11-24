<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
/*         dd($options['data']->getId());
 */
        $builder
            ->add('subject', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'The subject is required',
                    ]),
                ],             
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email([
                        'message' => 'Use the good format of email (ex : name@domaine.com)',
                    ]),
                    new NotBlank([
                        'message' => 'The Email is required',
                    ])
                ],             
            ]) 
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Description is required',
                    ]),
                    new Length([
                        'min' => 60,
                        'max' => 255,
                        'minMessage' => 'message is too short',
                        'maxMessage' => 'message is too long',
                    ])

                ],             
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
