<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'currentPlayer',
                TextType::class,
                [
                    'disabled' => true,
                    'data'     => 'Loading...',
                ]
            )
            ->add(
                'team',
                EntityType::class,
                [
                    'class' => Team::class,
                    'label' => 'Select the team',
                ]
            )
        ;
    }
}