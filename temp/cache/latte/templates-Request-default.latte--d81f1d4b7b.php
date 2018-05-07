<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Request/default.latte

use Latte\Runtime as LR;

class Templated81f1d4b7b extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'modal-addRequest-title' => 'blockModal_addRequest_title',
		'modal-addRequest-body' => 'blockModal_addRequest_body',
		'modal-addRequest-footer' => 'blockModal_addRequest_footer',
	];

	public $blockTypes = [
		'content' => 'html',
		'modal-addRequest-title' => 'html',
		'modal-addRequest-body' => 'html',
		'modal-addRequest-footer' => 'html',
	];


	function main()
	{
		extract($this->params);
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



    <h2><i class="fa fa-clipboard"> </i> Požadavky</h2>
<?php
		if ($user->getIdentity()->role_id == 4) {
			?>        <a class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addRequest!")) ?>"><span class=" btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Přidat nový požadavek</span></a>
<?php
		}
?>

<?php
		/* line 10 */ $_tmp = $this->global->uiControl->getComponent("requestGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>


<?php
	}


	function blockModal_addRequest_title($_args)
	{
?>    Nový požadavek
<?php
	}


	function blockModal_addRequest_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 19 */ $_tmp = $this->global->uiControl->getComponent("addRequestForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_addRequest_footer($_args)
	{
		
	}

}
