<?php
// source: C:\xampp\htdocs\dp-testing\vendor\ublaboo\datagrid\src\templates\datagrid_filter_daterange.latte

use Latte\Runtime as LR;

class Templateb29c341fff extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		$container = $input;
?>

<?php
		if ($outer) {
?>
	<div class="row">
		<?php
			$_input = is_object($container['from']) ? $container['from'] : end($this->global->formsStack)[$container['from']];
			if ($_label = $_input->getLabel()) echo $_label->addAttributes(['class' => 'col-sm-3 control-label']) ?>

		<div class="col-sm-4">
			<div class="input-group">
				<?php
			$_input = is_object($container['from']) ? $container['from'] : end($this->global->formsStack)[$container['from']];
			echo $_input->getControl() /* line 14 */ ?>

				<label class="input-group-addon"<?php
			$_input = is_object($container['from']) ? $container['from'] : end($this->global->formsStack)[$container['from']];
			echo $_input->getLabelPart()->addAttributes(array (
			'class' => NULL,
			))->attributes() ?>><i class="<?php echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 15 */ ?>calendar"></i></label>
			</div>
		</div>
		<?php
			$_input = is_object($container['to']) ? $container['to'] : end($this->global->formsStack)[$container['to']];
			if ($_label = $_input->getLabel()) echo $_label->addAttributes(['class' => 'filter-range-delimiter col-sm-1 control-label']) ?>

		<div class="col-sm-4">
			<div class="input-group">
				<?php
			$_input = is_object($container['to']) ? $container['to'] : end($this->global->formsStack)[$container['to']];
			echo $_input->getControl() /* line 21 */ ?>

				<label class="input-group-addon"<?php
			$_input = is_object($container['to']) ? $container['to'] : end($this->global->formsStack)[$container['to']];
			echo $_input->getLabelPart()->addAttributes(array (
			'class' => NULL,
			))->attributes() ?>><i class="<?php echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 22 */ ?>calendar"></i></label>
			</div>
		</div>
	</div>
<?php
		}
		else {
?>
	<div class="datagrid-col-filter-date-range form-inline">
		<div class="input-group">
			<?php
			$_input = is_object($container['from']) ? $container['from'] : end($this->global->formsStack)[$container['from']];
			echo $_input->getControl() /* line 29 */ ?>

			<label class="input-group-addon input-group-addon-first"<?php
			$_input = is_object($container['from']) ? $container['from'] : end($this->global->formsStack)[$container['from']];
			echo $_input->getLabelPart()->addAttributes(array (
			'class' => NULL,
			))->attributes() ?>><i class="<?php echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 30 */ ?>calendar"></i></label>

			<div class="input-group-addon datagrid-col-filter-datte-range-delimiter">-</div>

			<?php
			$_input = is_object($container['to']) ? $container['to'] : end($this->global->formsStack)[$container['to']];
			echo $_input->getControl() /* line 34 */ ?>

			<label class="input-group-addon"<?php
			$_input = is_object($container['to']) ? $container['to'] : end($this->global->formsStack)[$container['to']];
			echo $_input->getLabelPart()->addAttributes(array (
			'class' => NULL,
			))->attributes() ?>><i class="<?php echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 35 */ ?>calendar"></i></label>
		</div>
	</div>
<?php
		}
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
