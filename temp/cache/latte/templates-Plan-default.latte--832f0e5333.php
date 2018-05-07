<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Plan/default.latte

use Latte\Runtime as LR;

class Template832f0e5333 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'modal-add-title' => 'blockModal_add_title',
		'modal-add-body' => 'blockModal_add_body',
		'modal-add-footer' => 'blockModal_add_footer',
	];

	public $blockTypes = [
		'content' => 'html',
		'modal-add-title' => 'html',
		'modal-add-body' => 'html',
		'modal-add-footer' => 'html',
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
<h2><i class="fa fa-map"> </i> Přehled test plánů</h2>
<?php
		if ($user->getIdentity()->role_id == 2) {
			?>	<a class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addPlan!")) ?>"><span class=" btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Přidat test plán</span></a>
<?php
		}
?>
				<div class="card">
					<h5 class="card-header"></h5>
					<div class="card-body">
<?php
		/* line 11 */ $_tmp = $this->global->uiControl->getComponent("planGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
					</div>
				</div>


<?php
	}


	function blockModal_add_title($_args)
	{
?>	Nový plán
<?php
	}


	function blockModal_add_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 22 */ $_tmp = $this->global->uiControl->getComponent("addPlanForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_add_footer($_args)
	{
		
	}

}
