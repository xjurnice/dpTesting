<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Case/default.latte

use Latte\Runtime as LR;

class Template04e8b78943 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
?>


<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
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



	<h2><i class="fa fa-file"> </i> Testovací případy</h2>
	<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:add")) ?>"><button type="button" class="btn btn-success btn-sm"> <i
					class="fa fa-plus-circle "></i> Přidat testovací případ</button></a>




<?php
		/* line 14 */ $_tmp = $this->global->uiControl->getComponent("caseGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}

}
