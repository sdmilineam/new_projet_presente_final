<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('NiveauEtude')
            ->add('link')
            ->add('contacte')
            ->add('adresse')
            

            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Confimer Votre Profil',
                'download_uri' => true,
                'download_label' => '',
                'asset_helper' => true,
                'invalid_message' => 'Please, upload a .jpeg or .png file only',
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
