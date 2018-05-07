<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Project/add.latte

use Latte\Runtime as LR;

class Template9913aee34c extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
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


<?php
		$this->renderBlock('title', get_defined_vars());
?>
<hr>

<?php
		/* line 8 */ $_tmp = $this->global->uiControl->getComponent("insertForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>




<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
		?>					<h2>Tvorba nového projektu</h2><?php
	}

}
