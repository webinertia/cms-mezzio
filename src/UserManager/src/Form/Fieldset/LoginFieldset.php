<?php

declare(strict_types=1);

namespace UserManager\Form\Fieldset;

use Laminas\Filter;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator;
use Limatus\Form;

class LoginFieldset extends Form\Fieldset implements InputFilterProviderInterface
{
    /** @inheritDoc */
    public function __construct($name = 'horizontal-fieldset', $options = [])
    {
        parent::__construct($name = 'horizontal-fieldset', $options);
    }

    public function init(): void
    {
        $this->add([
            'name'       => 'username',
            'type'       => Form\Element\Text::class,
            'attributes' => [
                'class'       => 'form-control custom-class',
                'placeholder' => 'User Name',
            ],
            'options'    => [
                'label'                 => 'User Name',
                'label_attributes'      => [
                    'class' => 'col-sm-2 col-form-label',
                ],
                'bootstrap_attributes'  => [
                    'class' => 'row mb-3',
                ],
                'horizontal_attributes' => [
                    'class' => 'col-sm-10',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'email',
            'type'       => Form\Element\Text::class,
            'attributes' => [
                'class'       => 'form-control custom-class',
                'placeholder' => 'Email',
            ],
            'options'    => [
                'label'                 => 'Email',
                'label_attributes'      => [
                    'class' => 'col-sm-2 col-form-label',
                ],
                'bootstrap_attributes'  => [
                    'class' => 'row mb-3',
                ],
                'horizontal_attributes' => [
                    'class' => 'col-sm-10',
                ],
            ],
        ]);
        // $this->add([
        //     'name'    => 'login_type',
        //     'type'    => Checkbox::class,
        //     'attributes' => [
        //         'value' => '1',
        //         /**
        //          * attribute used in the input class="form-check-input"
        //          * the example-checkbox is a custom class for css targeting, see the style sheet for the demo site
        //          */
        //         'class' => 'form-check-input',
        //     ],
        //     'options' => [
        //         'label' => 'Checkbox',
        //         'use_hidden_element' => false,
        //         'checked_value' => '1',
        //         'unchecked_value' => '0',
        //         'bootstrap_attributes' => [
        //             'class' => 'row', // used in the outer most wrapper div for checkbox
        //         ],
        //         'label_attributes' => [
        //             'class' => 'form-check-label',
        //         ],
        //         /**
        //          * used for the div wrapping the input wrapper which is always form-check
        //          * @see \Bootstrap\Form\View\Helper\FormCheckbox
        //          */
        //         'horizontal_attributes' => [
        //             'class' => 'col-sm-10 offset-sm-2',
        //         ],
        //         // we need the label after the input
        //         'label_options' => [
        //             'label_position' => 'APPEND',
        //         ],
        //         'help'            => 'Testing help text for checkbox\'s',
        //         'help_attributes' => [
        //             'class' => 'form-text text-muted col-sm-10 offset-sm-2',
        //         ],
        //     ],
        // ]);
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'username' => [
                'required'   => true,
                'filters'    => [
                    ['name' => Filter\StripTags::class],
                    ['name' => Filter\StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => Validator\StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],
        ];
    }
}
