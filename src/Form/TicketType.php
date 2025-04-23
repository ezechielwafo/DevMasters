<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du ticket'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description détaillée'
            ]);
            
        // Les champs suivants sont généralement gérés autrement :
        // - status: géré par le workflow en backend
        // - priority: pourrait être ajouté avec un ChoiceType si nécessaire
        // - createdAt: automatiquement défini à new \DateTime()
        // - Tickets: relation inutile dans le formulaire
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}