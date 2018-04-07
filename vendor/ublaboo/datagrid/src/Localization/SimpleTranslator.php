<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Ublaboo\DataGrid\Localization;

use Nette;
use Nette\SmartObject;

class SimpleTranslator implements Nette\Localization\ITranslator
{

	use SmartObject;

	/**
	 * @var array
	 */
	private $dictionary = [
        'ublaboo_datagrid.no_item_found_reset' => 'Žádné položky nenalezeny. Zkuste resetovat filtr.',
        'ublaboo_datagrid.no_item_found' => 'Žádné položky nenalezeny.',
        'ublaboo_datagrid.here' => 'Zobraz vše bez filtrů',
        'ublaboo_datagrid.items' => 'Položky',
        'ublaboo_datagrid.all' => 'všechno',
        'ublaboo_datagrid.from' => 'z',
        'ublaboo_datagrid.reset_filter' => 'Reset filtru',
        'ublaboo_datagrid.group_actions' => 'Skupinové akce',
        'ublaboo_datagrid.show_all_columns' => 'Zobrazit všechny sloupce',
        'ublaboo_datagrid.hide_column' => 'Schovat sloupec',
        'ublaboo_datagrid.action' => 'Akce',
        'ublaboo_datagrid.previous' => 'Předchozí',
        'ublaboo_datagrid.next' => 'Další',
        'ublaboo_datagrid.choose' => 'Vybrat',
        'ublaboo_datagrid.execute' => 'Odeslat',
		'ublaboo_datagrid.show' => 'Zobrazit',
		'ublaboo_datagrid.add' => 'Přidat',
		'ublaboo_datagrid.edit' => 'Editovat',
		'ublaboo_datagrid.show_default_columns' => 'Schovat výchozí sloupce',
		'ublaboo_datagrid.hide_column' => 'Schovat sloupec',
		'ublaboo_datagrid.choose_input_required' => 'Hromadná akce nedovoluje prázdnou hodnotu',
		'ublaboo_datagrid.save' => 'Uložit',
		'ublaboo_datagrid.cancel' => 'Zavřít',
		'ublaboo_datagrid.multiselect_choose' => 'Vybrat',
		'ublaboo_datagrid.multiselect_selected' => '{0} vybraných',
		'ublaboo_datagrid.filter_submit_button' => 'Filtr',
		'ublaboo_datagrid.show_filter' => 'Zobrazit filtr',
		'ublaboo_datagrid.per_page_submit' => 'Změnit',
	];


	/**
	 * @param array $dictionary
	 */
	public function __construct($dictionary = null)
	{
		if (is_array($dictionary)) {
			$this->dictionary = $dictionary;
		}
	}


	/**
	 * Translates the given string
	 * 
	 * @param  string
	 * @param  int
	 * @return string
	 */
	public function translate($message, $count = null)
	{
		return isset($this->dictionary[$message]) ? $this->dictionary[$message] : $message;
	}


	/**
	 * Set translator dictionary
	 * @param array $dictionary
	 */
	public function setDictionary(array $dictionary)
	{
		$this->dictionary = $dictionary;
	}
}
