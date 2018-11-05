<?php

namespace Backend\Modules\Mailchimp\Domain\Subscribe;

use Frontend\Core\Language\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscribeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType::class,
            [
                'required' => true,
                'label' => 'lbl.Name',
            ]
        )->add(
            'subscriber',
            EmailType::class,
            [
                'required' => true,
                'label' => 'lbl.Email',
            ]
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => SubscribeDataTransferObject::class,
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'subscribe';
    }
}
