<?php

namespace Backend\Modules\Mailchimp\Domain\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'apiKey',
            TextType::class,
            [
                'required' => true,
                'label' => 'lbl.ApiKey',
            ]
        );

        if ($options['lists']) {
            $builder->add(
                'activeList',
                ChoiceType::class,
                [
                    'required' => false,
                    'label' => 'lbl.SelectList',
                    'choices' => $options['lists'],
                ]
            )->add(
                'status',
                ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'lbl.Status',
                    'choices' => [
                        'lbl.Subscribed' => SettingsDataTransferObject::STATUS_SUBSCRIBED,
                        'lbl.Unsubscribed' => SettingsDataTransferObject::STATUS_UNSUBSCRIBED,
                        'lbl.Cleaned' => SettingsDataTransferObject::STATUS_CLEANED,
                        'lbl.Pending' => SettingsDataTransferObject::STATUS_PENDING,
                    ],
                ]
            );
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => SettingsDataTransferObject::class,
                'lists' => [],
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'settings';
    }
}
