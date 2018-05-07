<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Set/detail.latte

use Latte\Runtime as LR;

class Templatef43ab95fe5 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'modal-edit-title' => 'blockModal_edit_title',
		'modal-edit-body' => 'blockModal_edit_body',
		'modal-edit-footer' => 'blockModal_edit_footer',
	];

	public $blockTypes = [
		'content' => 'html',
		'modal-edit-title' => 'html',
		'modal-edit-body' => 'html',
		'modal-edit-footer' => 'html',
	];


	function main()
	{
		extract($this->params);
?>


<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>




<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['chset'])) trigger_error('Variable $chset overwritten in foreach on line 24');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a class="text-success" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Set:default")) ?>"><i class="fa fa-home fa-1x"></i> </a></li>
<?php
		if (!($parentSet)) {
		}
		else {
?>
            <li class="breadcrumb-item active" aria-current="page">...</li>
                <li class="breadcrumb-item"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Set:detail", [$parentSet->id, $parentSet->parent_id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($parentSet->name) /* line 10 */ ?></a></li>
<?php
		}
?>

            <li class="breadcrumb-item active" aria-current="page"><?php echo LR\Filters::escapeHtmlText($set->name) /* line 13 */ ?></li>

    </nav>

    <h2 ><?php echo LR\Filters::escapeHtmlText($set->name) /* line 17 */ ?></h2>  <a
        class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit!", [$set->id])) ?>">
    <button type="button" class="btn btn-warning btn-sm"><i
                class="fa fa-edit "></i>
    </button>
</a>
<hr>
<?php
		$iterations = 0;
		foreach ($childrenSets as $chset) {
			?>    <span class="text-info"><a class="text-info" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Set:detail", [$chset->id,$chset->parent_id])) ?>"> <i class="fa fa-level-down-alt"></i> <?php
			echo LR\Filters::escapeHtmlText($chset->name) /* line 25 */ ?> </a></span>

<?php
			$iterations++;
		}
?>




<?php
		/* line 32 */ $_tmp = $this->global->uiControl->getComponent("setDetailGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_edit_title($_args)
	{
?>    Editace testovací sady
<?php
	}


	function blockModal_edit_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 42 */ $_tmp = $this->global->uiControl->getComponent("editSetForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_edit_footer($_args)
	{
		
	}

}
