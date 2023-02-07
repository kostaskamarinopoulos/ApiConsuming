<?php

namespace App\Form;

use App\Entity\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class SymbolFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companySymbol', TextType::class, array('attr' => array('class' => 'form-field')))
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class, ['constraints' => [
                new GreaterThanOrEqual([
                    'propertyPath' => 'parent.all[startDate].data'
                ])],
            ])
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-field')))
            ->add('Submit', SubmitType::class, array('attr' => array('class' => 'form-submit')));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Form::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'form_item',
        ]);
    }
}
