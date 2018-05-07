<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Case/edit.latte

use Latte\Runtime as LR;

class Template6f9faf9374 extends Latte\Runtime\Template
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



<?php
		$this->renderBlock('title', get_defined_vars());
		/* line 8 */ $_tmp = $this->global->uiControl->getComponent("editForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>


<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?>				<h2>Editace test. případu</h2>
<?php
	}

}
