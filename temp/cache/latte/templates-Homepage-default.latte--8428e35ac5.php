<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template8428e35ac5 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
		'scripts' => 'blockScripts',
		'head' => 'blockHead',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
		'scripts' => 'html',
		'head' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>

<?php
		$this->renderBlock('scripts', get_defined_vars());
?>


<?php
		$this->renderBlock('head', get_defined_vars());
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


	<div id="banner">
<?php
		$this->renderBlock('title', get_defined_vars());
		?>       Login as <?php echo LR\Filters::escapeHtmlText($user->getIdentity()->username) /* line 8 */ ?>

		<a class="btn btn-xs btn-danger" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>"> <span class="glyphicon glyphicon-hand-right"></span> Odhlásit se</a>
	</div>

<?php
	}


	function blockTitle($_args)
	{
		extract($_args);
?>	<h1>Congratulations!</h1>
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>
<script src="https://files.nette.org/sandbox/jush.js"></script>

<?php
	}


	function blockHead($_args)
	{
?><style>

</style>
<?php
	}

}
