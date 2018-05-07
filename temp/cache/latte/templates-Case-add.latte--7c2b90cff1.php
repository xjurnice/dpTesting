<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Case/add.latte

use Latte\Runtime as LR;

class Template7c2b90cff1 extends Latte\Runtime\Template
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

<!--
    <form n:name=insertForm class=form>
        <p><label n:name=name>Jmeno scenare<input n:name=name size=20></label>
        <p><label n:name=description><input n:name=description></label>
        <p><select n:name=priority></select>
        <p><select n:name=category_id></select>

        <p><select n:name=project_id></select>
        <p><input n:name=add class="btn btn-primary btn-lg btn-block btn btn-primary button">

    </form>

-->


<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
		?>					<h2>Tvorba nového testovacího případu</h2><?php
	}

}
