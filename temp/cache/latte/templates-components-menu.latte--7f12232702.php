<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters\templates\components\menu.latte

use Latte\Runtime as LR;

class Template7f12232702 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		$role = $user->getIdentity()->role_id;
?>
<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Dashboard:default")) ?>"<?php
		if ($_tmp = array_filter([$presenter->isLinkCurrent('Dashboard:*') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-home"></i> Dashboard</a>
<?php
		if ($role==2 OR $role==3) {
?>
<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Case:default")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('Case:*') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-file"></i>  Testovací případy</a>
<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Set:default")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('Set:*') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-box"></i> Testovací sady</a>


<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Execution:default")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('Execution:default') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-play-circle"></i> Přehled dokončených testů</a>
<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Plan:default")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('Plan:*') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-map"></i> Test plány</a>

<?php
		}
		if ($role==4 OR $role==2 OR $role==3) {
?>
<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Request:default")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('Request:*') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-clipboard"></i> Požadavky</a>
<?php
		}
		if ($role==4) {
?>
<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Case:approval")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('Case:approval') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-check-circle"></i>  Schvalován test. případů</a>

<?php
		}
		if ($role==2) {
?>
    <a
            href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("User:management")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('User:management') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
        <i class="fa fa-users"></i>  Správa uživatelů</a>

<a
        href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Setting:default")) ?>"<?php
			if ($_tmp = array_filter([$presenter->isLinkCurrent('Setting:*') ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action'])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>>
    <i class="fa fa-cogs"></i>  Nastavení</a>
<?php
		}
?>


<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
