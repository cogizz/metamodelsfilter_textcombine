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
 * filter types
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['typenames']['textcombine']     = 'Combine-Text filter';

/**
 * fields
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['textsearch']   = array('Search type', 'Finding text parts.');

/**
 * references
 */
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['exact']      = 'exact search';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['beginswith'] = 'begins with search term';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['endswith']   = 'ends with search term';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['or']   = 'OR';
$GLOBALS['TL_LANG']['tl_metamodel_filtersetting']['references']['and']   = 'AND';
