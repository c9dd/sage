<?php

namespace fewbricks\acf\fields;

/**
 * Class true_false
 * @package fewbricks\acf
 */
class true_false extends field
{

    /**
     * @param string $label
     * @param string $name
     * @param string $key
     * @param array $custom_settings
     */
    public function __construct($label, $name, $key, $custom_settings = [])
    {

        $base_settings = [
            'prefix' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'message' => '',
            'default_value' => 0,
        ];

        parent::__construct($label, $name, $key, $base_settings, $custom_settings);

    }

}