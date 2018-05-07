<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Execution/default.latte

use Latte\Runtime as LR;

class Template0b08cfebe0 extends Latte\Runtime\Template
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



	<h2><i class="fa fa-play-circle"> </i>  Přehled dokončených testů</h2>




<?php
		/* line 12 */ $_tmp = $this->global->uiControl->getComponent("executionGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}

}
