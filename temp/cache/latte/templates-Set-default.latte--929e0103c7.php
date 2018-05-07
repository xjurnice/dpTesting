<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Set/default.latte

use Latte\Runtime as LR;

class Template929e0103c7 extends Latte\Runtime\Template
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>



				<h2> <i class="fa fa-box"></i> Testovací sady</h2>
				<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Set:add")) ?>"><button type="button" class="btn btn-success btn-sm"> <i
								class="fa fa-plus-circle "></i> Přidat testovací sadu</button></a>


<?php
		/* line 12 */ $_tmp = $this->global->uiControl->getComponent("categoriesGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>


<?php
	}


	function blockModal_edit_title($_args)
	{
?>	Editace testovací sady
<?php
	}


	function blockModal_edit_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 21 */ $_tmp = $this->global->uiControl->getComponent("editSetForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_edit_footer($_args)
	{
		
	}

}
