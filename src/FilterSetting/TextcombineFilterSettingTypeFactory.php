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

namespace MetaModels\FilterTextcombineBundle\FilterSetting;

use MetaModels\Filter\Setting\AbstractFilterSettingTypeFactory;

/**
 * Attribute type factory for textcombine filter settings.
 */
class TextcombineFilterSettingTypeFactory extends AbstractFilterSettingTypeFactory
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTypeName('textcombine')
            ->setTypeIcon('bundles/metamodelsfiltertextcombine/filter_text.png')
            ->setTypeClass(TextCombine::class)
            ->allowAttributeTypes(
                'longtext',
                'text',
                'translatedtext',
                'translatedlongtext'
            );
    }
}

