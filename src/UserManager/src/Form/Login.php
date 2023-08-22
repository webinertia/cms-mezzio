<?php

declare(strict_types=1);

namespace UserManager\Form;

use Laminas\Filter;
use Laminas\Form\Element\Password;
use Laminas\Form\Exception\InvalidArgumentException;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator;
use Limatus\Form;

final class Login extends Form\Form implements InputFilterProviderInterface
{
    /** @inheritDoc */
    protected $attributes = ['class' => 'horizontal', 'method' => 'POST'];
    /**
     *
     * @param string $name
     * @param array $options
     * @return void
     * @throws InvalidArgumentException
     */
    public function __construct($name = 'horizontal', $options = [])
    {
        parent::__construct($name, $options);
    }

    public function init(): void
    {
            $this->setAttribute('action', '/user/login');
            $this->add([
                'name'       => 'userName',
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
                'name'       => 'password',
                'type'       => Password::class,
                'attributes' => [
                    'class'       => 'form-control custom-class',
                    'placeholder' => 'Password',
                ],
                'options'    => [
                    'label'                 => 'Password',
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
