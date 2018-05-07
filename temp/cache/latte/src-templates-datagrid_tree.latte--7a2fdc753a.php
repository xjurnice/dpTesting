<?php
// source: C:\xampp\htdocs\dp-testing\vendor\ublaboo\datagrid\src/templates/datagrid_tree.latte

use Latte\Runtime as LR;

class Template7a2fdc753a extends Latte\Runtime\Template
{
	public $blocks = [
		'data' => 'blockData',
		'_table' => 'blockTable',
		'_items' => 'blockItems',
		'_item-header' => 'blockItem_header',
		'icon-chevron' => 'blockIcon_chevron',
		'icon-arrows' => 'blockIcon_arrows',
	];

	public $blockTypes = [
		'data' => 'html',
		'_table' => 'html',
		'_items' => 'html',
		'_item-header' => 'html',
		'icon-chevron' => 'html',
		'icon-arrows' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('data', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['key'])) trigger_error('Variable $key overwritten in foreach on line 18, 26, 37, 66, 89, 114');
		if (isset($this->params['column'])) trigger_error('Variable $column overwritten in foreach on line 18, 26, 66, 89');
		if (isset($this->params['action'])) trigger_error('Variable $action overwritten in foreach on line 37, 114');
		if (isset($this->params['row'])) trigger_error('Variable $row overwritten in foreach on line 56');
		$this->parentName = $original_template;
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockData($_args)
	{
		extract($_args);
		?><div class="datagrid-tree-item-children datagrid-tree" <?php
		if ($control->isSortable()) {
			?>data-sortable-tree data-sortable-url="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link($control->getSortableHandler())) ?>" data-sortable-parent-path="<?php
			echo LR\Filters::escapeHtmlAttr($control->getSortableParentPath()) /* line 13 */ ?>"<?php
		}
		echo ' id="' . htmlSpecialChars($this->global->snippetDriver->getHtmlId('table')) . '"' ?>>
<?php $this->renderBlock('_table', $this->params) ?>
</div>
<?php
		
	}


	function blockTable($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("table", "static");
		?>	<?php
		$this->renderBlock('_items', $this->params);
		$this->global->snippetDriver->leave();
		
	}


	function blockItems($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("items", "area");
		?>		<div class="datagrid-tree-item datagrid-tree-header"<?php echo ' id="' . htmlSpecialChars($this->global->snippetDriver->getHtmlId('item-header')) . '"' ?>>
<?php $this->renderBlock('_item-header', $this->params) ?>
		</div>

<?php
		$iterations = 0;
		foreach ($iterator = $this->global->its[] = new LR\CachingIterator($rows) as $row) {
			$has_children = $control->hasTreeViewChildrenCallback() ? $control->treeViewChildrenCallback($row->getItem()) : $row->getValue($tree_view_has_children_column);
			$item = $row->getItem();
?>

			<div data-id="<?php echo LR\Filters::escapeHtmlAttr($row->getId()) /* line 60 */ ?>"<?php
			if ($_tmp = array_filter([$has_children ? 'has-children' : NULL, 'datagrid-tree-item'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"';
			echo ' id="' . htmlSpecialChars($this->global->snippetDriver->getHtmlId("item-{$row->getId()}")) . '"' ?>>
<?php
			$this->global->snippetDriver->enter("item-{$row->getId()}", "dynamic");
			?>				<div data-id="<?php echo LR\Filters::escapeHtmlAttr($row->getId()) /* line 61 */ ?>" data-has-children="<?php
			echo LR\Filters::escapeHtmlAttr($has_children ? true : false) /* line 61 */ ?>"<?php if ($_tmp = array_filter(['datagrid-tree-item-content', $row->getControlClass()])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
					<div class="datagrid-tree-item-left">
						<a data-toggle-tree="true" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("getChildren!", ['parent' => $row->getId()])) ?>"<?php
			if ($_tmp = array_filter([!$has_children ? 'hidden' : NULL, 'chevron ajax'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
<?php
			$this->renderBlock('icon-chevron', get_defined_vars());
?>
						</a>
<?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($columns) as $key => $column) {
				$col = 'col-' . $key;
				$column = $row->applyColumnCallback($key, clone $column);
?>

<?php
				if ($column->hasTemplate()) {
					/* line 71 */
					$this->createTemplate($column->getTemplate(), array_merge(['item' => $item, ], $column->getTemplateVariables(), []) + $this->params, "include")->renderToContentType('html');
				}
				else {
					if (isset($this->blockQueue["$col"])) {
						$this->renderBlock($col, ['item' => $item] + $this->params, 'html');
					}
					else {
						if ($column->isTemplateEscaped()) {
							?>										<?php echo LR\Filters::escapeHtmlText($column->render($row)) /* line 77 */ ?>

<?php
						}
						else {
							?>										<?php echo $column->render($row) /* line 79 */ ?>

<?php
						}
					}
				}
?>

<?php
				if (TRUE) break;
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
?>
					</div>
					<div class="datagrid-tree-item-right">
						<div class="datagrid-tree-item-right-columns">
<?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($columns) as $key => $column) {
				if ($iterator->isFirst()) continue;
?>

								<div class="datagrid-tree-item-right-columns-column text-<?php echo LR\Filters::escapeHtmlAttr($column->hasAlign() ? $column->getAlign() : 'left') /* line 92 */ ?>">
<?php
				$col = 'col-' . $key;
				$column = $row->applyColumnCallback($key, clone $column);
?>

<?php
				if ($column->hasTemplate()) {
					/* line 97 */
					$this->createTemplate($column->getTemplate(), array_merge(['row' => $row, 'item' => $item, ], $column->getTemplateVariables(), []) + $this->params, "include")->renderToContentType('html');
				}
				else {
					if (isset($this->blockQueue["$col"])) {
						$this->renderBlock($col, ['item' => $item] + $this->params, 'html');
					}
					else {
						if ($column->isTemplateEscaped()) {
							?>												<?php echo LR\Filters::escapeHtmlText($column->render($row)) /* line 103 */ ?>

<?php
						}
						else {
							?>												<?php echo $column->render($row) /* line 105 */ ?>

<?php
						}
					}
				}
?>
								</div>
<?php
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
?>
						</div>
						<div class="datagrid-tree-item-right-actions">
							<div class="datagrid-tree-item-right-actions-action">
<?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($actions) as $key => $action) {
				if ($row->hasAction($key)) {
					if ($action->hasTemplate()) {
						/* line 117 */
						$this->createTemplate($action->getTemplate(), array_merge(['item' => $item, ], $action->getTemplateVariables(), [ 'row' => $row]) + $this->params, "include")->renderToContentType('html');
					}
					else {
						?>											<?php echo $action->render($row) /* line 119 */ ?>

<?php
					}
				}
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
?>

<?php
			if ($control->isSortable()) {
?>								<span class="handle-sort btn btn-xs btn-default">
<?php
				$this->renderBlock('icon-arrows', get_defined_vars());
?>
								</span>
<?php
			}
?>
							</div>
						</div>
					</div>
				</div>
				<div class="datagrid-tree-item-children" <?php
			if ($control->isSortable()) {
				?>data-sortable-tree data-sortable-url="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link($control->getSortableHandler())) ?>"<?php
			}
?>></div>
<?php
			$this->global->snippetDriver->leave();
?>			</div>
<?php
			$iterations++;
		}
		array_pop($this->global->its);
		$iterator = end($this->global->its);
		if (!$rows) {
			?>			<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->translate, 'ublaboo_datagrid.no_item_found')) /* line 135 */ ?>

<?php
		}
		$this->global->snippetDriver->leave();
		
	}


	function blockItem_header($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("item-header", "static");
?>			<div class="datagrid-tree-item-content" data-has-children="">
				<div class="datagrid-tree-item-left">
<?php
		$iterations = 0;
		foreach ($columns as $key => $column) {
			?>						<strong><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->translate, $column->getName())) /* line 19 */ ?></strong>
<?php
			if (TRUE) break;
			$iterations++;
		}
?>
				</div>

				<div class="datagrid-tree-item-right">
					<div class="datagrid-tree-item-right-columns">
<?php
		$iterations = 0;
		foreach ($iterator = $this->global->its[] = new LR\CachingIterator($columns) as $key => $column) {
			if ($iterator->isFirst()) continue;
			?>							<div class="datagrid-tree-item-right-columns-column col-<?php echo LR\Filters::escapeHtmlAttr($column->getColumnName()) /* line 28 */ ?> text-<?php
			echo LR\Filters::escapeHtmlAttr($column->hasAlign() ? $column->getAlign() : 'left') /* line 28 */ ?>">
								<strong><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->translate, $column->getName())) /* line 29 */ ?></strong>
							</div>
<?php
			$iterations++;
		}
		array_pop($this->global->its);
		$iterator = end($this->global->its);
?>
					</div>
<?php
		if (($actions || $control->isSortable()) && $rows) {
?>					<div class="datagrid-tree-item-right-actions">
						<div class="datagrid-tree-item-right-actions-action">
<?php
			$tmp_row = reset($rows);
?>

<?php
			$iterations = 0;
			foreach ($iterator = $this->global->its[] = new LR\CachingIterator($actions) as $key => $action) {
				if ($tmp_row->hasAction($key)) {
					if ($action->hasTemplate()) {
						/* line 40 */
						$this->createTemplate($action->getTemplate(), array_merge(['item' => $tmp_row->getItem(), ], $action->getTemplateVariables(), [ 'row' => $tmp_row]) + $this->params, "include")->renderToContentType('html');
					}
					else {
						?>										<?php echo $action->render($tmp_row) /* line 42 */ ?>

<?php
					}
				}
				$iterations++;
			}
			array_pop($this->global->its);
			$iterator = end($this->global->its);
?>

<?php
			if ($control->isSortable()) {
?>							<span class="handle-sort btn btn-xs btn-default">
								<i class="<?php echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 48 */ ?>arrows"></i>
							</span>
<?php
			}
?>
						</div>
					</div>
<?php
		}
?>
				</div>
			</div>
<?php
		$this->global->snippetDriver->leave();
		
	}


	function blockIcon_chevron($_args)
	{
		extract($_args);
		?>							<i class="<?php echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 64 */ ?>chevron-right"></i>
<?php
	}


	function blockIcon_arrows($_args)
	{
		extract($_args);
		?>									<i class="<?php echo LR\Filters::escapeHtmlAttr($icon_prefix) /* line 125 */ ?>arrows"></i>
<?php
	}

}
