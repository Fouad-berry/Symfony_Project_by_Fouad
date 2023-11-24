<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
/*         dd($options['data']->getId());
 */
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Name is required',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Product name is too short',
                        'maxMessage' => 'Product name is too long',
                    ])
                ],             
            ])
            ->add('price', MoneyType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Price is required',
                    ]),
                    new Positive([
                        'message' => 'Price must be positive'
                    ])
                ],             
            ]) 
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Description is required',
                    ]),
                ],             
            ]) 
            ->add('quantity', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Quantity is required',
                    ]),
                    new PositiveOrZero([
                        'message' => 'Quantity must be zero or positive'
                    ])
                ],             
            ]) 
            ->add('image', FileType::class, [
                'data_class' => null,
                //si le produit est ajouté, contraintes sur le champ de sélection de selection de fichiers // si le produit est modifié , pas de contrainte
                'constraints' => $options['data']->getId() ? [] : [
                    new NotBlank([
                        'message' => 'Image is required',
                    ]),
                    new Image([
                        'mimeTypesMessage' => 'File format is not allowed',
                        'mimeTypes' => ['image/jpeg', 'image/gif', 'image/png']
                    ])
                ],             
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
