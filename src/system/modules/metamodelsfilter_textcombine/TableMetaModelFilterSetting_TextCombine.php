<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage FilterTextCombine
 * @author     Christopher Bölter <c.boelter@cogizz.de>
 * @copyright  Cogizz - web solutions
 * @license    LGPL.
 * @filesource
 */

/**
 * Filter "text combine" for FE-filtering, based on filters by the MetaModels team.
 *
 * @package	   MetaModels
 * @subpackage FrontendFilter
 * @author     Christopher Bölter <c.boelter@cogizz.de>
 */

/**
 * Provides be-functionalities
 *
 * @package	   MetaModels
 * @subpackage FilterTextCombine
 * @author     Christopher Bölter <c.boelter@cogizz.de>
 */
class TableMetaModelFilterSetting_TextCombine extends TableMetaModelHelper
{

    protected $objMetaModel = null;

    /**
	 * translates an id to a generated alias {@see TableMetaModelFilterSetting::getAttributeNames()}
	 *
	 * @param string        $strValue the id to translate.
	 *
	 * @param DataContainer $objDC    the data container calling.
	 *
	 * @return string
	 */
    public function attrIdToName($strValue, $objDC)
    {
        $objMetaModel = TableMetaModelFilterSetting::getInstance()->getMetaModel($objDC);

        if (!$objMetaModel) {
            return 0;
        }
        $arrIds = deserialize($strValue);
        $arrNames = array();

        if (count($arrIds) > 0) {
            foreach ($arrIds as $id) {
                $objAttribute = $objMetaModel->getAttributeById($id);
                if ($objAttribute) {
                    $arrNames[] =  $objMetaModel->getTableName() .'_' . $objAttribute->getColName();
                }
            }

            $strValue = serialize($arrNames);
        }

        return $strValue;
    }

    /**
	 * provide options for default selection
	 *
	 * @param object
	 *
	 * @return array
	 */
    public function arrNameToAttrId($strValue, $objDC)
    {
        $objMetaModel = TableMetaModelFilterSetting::getInstance()->getMetaModel($objDC);

        if (!$objMetaModel) {
            return 0;
        }

        $arrNames = deserialize($strValue);
        $arrIds = array();

        if (count($arrNames) > 0) {
            foreach ($arrNames as $name) {
                $strName = str_replace($objMetaModel->getTableName() . '_', '', $name);

                $objAttribute = $objMetaModel->getAttribute($strName);

                if ($objAttribute) {
                    $arrIds[] = $objAttribute->get('id');
                }
            }

            $strValue = serialize($arrIds);
        }

        return $strValue;
    }

    /**
	 * backend list display of fe-filter
	 * @param array
	 * @param string
	 * @param object
	 * @param string
	 * @param string
	 * @return string
	 */
    public function infoCallback($arrRow, $strLabel, $objDC, $imageAttribute, $strImage)
    {
        $objDatabase = Database::getInstance();
        $this->objMetaModel = TableMetaModelFilterSetting::getInstance()->getMetaModel($objDC);
        $objAttributes = $objDatabase->prepare("SELECT textcombine_attributes FROM tl_metamodel_filtersetting Where id = ?")->limit(1)->execute($arrRow['id']);

        $arrAttributes = deserialize($objAttributes->textcombine_attributes);
        $strAttrName = '';

        if ($objAttributes->numRows > 0) {
            foreach ($arrAttributes as $attribute) {
                $objAttribute = $this->objMetaModel->getAttributeById($attribute);

                if ($objAttribute) {
                    $arrAttributeNames[] = $objAttribute->getName();
                } else {
                    $arrAttributeNames[] = $attribute;
                }
            }

            $strAttrName = implode(', ', $arrAttributeNames);
        }

        if (!empty($arrRow['comment'])) {
            $arrRow['comment'] = sprintf($GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typedesc']['_comment_'], $arrRow['comment']);
        }

        $strReturn = sprintf(
            $GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typedesc']['fefilter'],
            '<a href="' . $this->addToUrl('act=edit&amp;id='.$arrRow['id']). '">' . $strImage . '</a>',
            $strLabel,
            $arrRow['comment'],
            $strAttrName,
            $arrRow['urlparam'] ? $arrRow['urlparam'] : 'textsearch_' . $arrRow['id']
        );

        return $strReturn;
    }
}