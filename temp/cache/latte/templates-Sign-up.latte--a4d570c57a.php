<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Sign/up.latte

use Latte\Runtime as LR;

class Templatea4d570c57a extends Latte\Runtime\Template
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



<div class="empty-block"></div>
<div class="container">

    <div class="row">
        <div class="form-signin">
            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Dashboard:default")) ?>"><img src="<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 10 */ ?>/images/logo-sm.png" class="img-fluid" alt="TestOne - testovací nástroj"> </a>
            <p><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("up")) ?>">Testovací nástroj</a></p>
<?php
		/* line 12 */ $_tmp = $this->global->uiControl->getComponent("signUpForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

        </div>

<?php
	}

}
