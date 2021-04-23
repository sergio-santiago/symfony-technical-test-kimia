<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'position',
                ChoiceType::class,
                [
                    'choices' => $this->getPositionChoices(),
                ]
            )
            ->add('team')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Player::class,
            ]
        );
    }

    private function getPositionChoices(): array
    {
        $choices = [];
        foreach (Player::POSITIONS as $position) {
            $choices[$position] = $position;
        }

        return $choices;
    }
}
