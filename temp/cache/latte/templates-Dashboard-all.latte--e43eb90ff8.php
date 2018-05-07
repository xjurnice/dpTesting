<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Dashboard/all.latte

use Latte\Runtime as LR;

class Templatee43eb90ff8 extends Latte\Runtime\Template
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
		if (isset($this->params['event'])) trigger_error('Variable $event overwritten in foreach on line 5');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <h2>Přehled všech aktivit</h2>
<?php
		$iterations = 0;
		foreach ($events as $event) {
?>
        <p class="card-text">

<?php
			$this->global->switch[] = ($event->event_type_id);
			if (FALSE) {
?>

<?php
			}
			elseif (end($this->global->switch) === (2)) {
				?>                <i class="fa fa-plus-circle"></i><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:detail", [$event->object_id])) ?>">  Vytvořené test. případu </a>
<?php
			}
			elseif (end($this->global->switch) === (3)) {
				?>                <i class="fa fa-play-circle"></i><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:detail", [$event->object_id])) ?>">  Spuštění test. případu</a>
<?php
			}
			elseif (end($this->global->switch) === (4)) {
				?>                <i class="fa fa-arrow-alt-circle-left"></i><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:detail", [$event->object_id])) ?>"> Změna statusu test. případu</a>

<?php
			}
			else {
?>
                Neznámý
<?php
			}
			array_pop($this->global->switch) ?>            (<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $event->event_time, 'd.m.Y H:i:s')) /* line 20 */ ?>) -  <a href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:profile", [$event->user_id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($event->username) /* line 20 */ ?></a> </p>
<?php
			$iterations++;
		}
		
	}

}
