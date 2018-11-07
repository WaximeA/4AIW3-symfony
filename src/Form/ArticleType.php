<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Tag;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('content')
            ->add('tags', EntityType::class,
                [
                    'label'        => 'Tag',
                    'class'        => Tag::class,
                    'choice_label' => 'name',
                    'multiple'     => true,
                    'required'     => false,
                ]
            )
            ->add('save', SubmitType::class)
        ;
    }
}