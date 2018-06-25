<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package    MetaModels
 * @subpackage FilterTextCombine
 * @author     Christopher Boelter <christopher@boelter.eu>
 * @copyright  2017 Christopher Bölter
 * @license    https://github.com/cboelter/metamodelsfilter_textcombine/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

// This hack is to load the "old locations" of the classes.
use MetaModels\FilterTextBundle\FilterSetting\Textcombine;
use MetaModels\FilterTextBundle\FilterSetting\TextcombineFilterSettingTypeFactory;

spl_autoload_register(
    function ($class) {
        static $classes = [
            'MetaModels\Filter\Setting\Textcombine'                         => Textcombine::class,
            'MetaModels\Filter\Setting\TextcombineFilterSettingTypeFactory' => TextcombineFilterSettingTypeFactory::class,
        ];

        if (isset($classes[$class])) {
            // @codingStandardsIgnoreStart Silencing errors is discouraged
            @trigger_error('Class "' . $class . '" has been renamed to "' . $classes[$class] . '"', E_USER_DEPRECATED);
            // @codingStandardsIgnoreEnd

            if (!class_exists($classes[$class])) {
                spl_autoload_call($class);
            }

            class_alias($classes[$class], $class);
        }
    }
);

