<?php
// source: C:\xampp\htdocs\dp-testing\vendor\ublaboo\datagrid\src\Column/../templates/column_status.latte

use Latte\Runtime as LR;

class Templatea94cacdd76 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		$active_option = $status->getCurrentOption($row);
?>

<div class="dropdown">
<?php
		if ($active_option) {
			?>		<button class="dropdown-toggle <?php echo LR\Filters::escapeHtmlAttr($active_option->getClass()) /* line 10 */ ?> <?php
			echo LR\Filters::escapeHtmlAttr($active_option->getClassSecondary()) /* line 10 */ ?>" type="button" data-toggle="dropdown">
			<?php
			if ($active_option->getIcon()) {
				?><i class="<?php
				echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 11 */;
				echo LR\Filters::escapeHtmlAttr($active_option->getIcon()) /* line 11 */ ?>"></i> <?php
			}
?>

			<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->translate, $active_option->getText())) /* line 12 */ ?> <?php
			if ($status->hasCaret()) {
?><i class="caret"></i>
<?php
			}
?>
		</button>
<?php
		}
		else {
			?>		<?php echo LR\Filters::escapeHtmlText($row->getValue($status->getColumn())) /* line 15 */ ?>

<?php
		}
?>
	<ul class="dropdown-menu">
<?php
		$iterations = 0;
		foreach ($status->getOptions() as $option) {
?>		<li>
			<a class="<?php echo LR\Filters::escapeHtmlAttr($option->getClassInDropdown()) /* line 19 */ ?>" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("changeStatus!", ['id' => $row->getId(), 'key' => $status->getKey(), 'value' => $option->getValue()])) ?>">
				<?php
			if ($option->getIconSecondary()) {
				?><i class="datagrid-column-status-option-icon <?php
				echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 20 */;
				echo LR\Filters::escapeHtmlAttr($option->getIconSecondary()) /* line 20 */ ?>"></i> <?php
			}
?>

				<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->translate, $option->getText())) /* line 21 */ ?>

			</a>
		</li>
<?php
			$iterations++;
		}
?>
	</ul>
</div>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['option'])) trigger_error('Variable $option overwritten in foreach on line 18');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
