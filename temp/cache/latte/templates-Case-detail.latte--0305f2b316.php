<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Case/detail.latte

use Latte\Runtime as LR;

class Template0305f2b316 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'modal-edit-title' => 'blockModal_edit_title',
		'modal-edit-body' => 'blockModal_edit_body',
		'modal-edit-footer' => 'blockModal_edit_footer',
		'modal-add-title' => 'blockModal_add_title',
		'modal-add-body' => 'blockModal_add_body',
		'modal-add-footer' => 'blockModal_add_footer',
		'modal-note-title' => 'blockModal_note_title',
		'modal-note-body' => 'blockModal_note_body',
		'modal-note-footer' => 'blockModal_note_footer',
	];

	public $blockTypes = [
		'content' => 'html',
		'modal-edit-title' => 'html',
		'modal-edit-body' => 'html',
		'modal-edit-footer' => 'html',
		'modal-add-title' => 'html',
		'modal-add-body' => 'html',
		'modal-add-footer' => 'html',
		'modal-note-title' => 'html',
		'modal-note-body' => 'html',
		'modal-note-footer' => 'html',
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
		if (isset($this->params['step'])) trigger_error('Variable $step overwritten in foreach on line 136');
		if (isset($this->params['plan'])) trigger_error('Variable $plan overwritten in foreach on line 205');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		$role = $user->getIdentity()->role_id;
		?>    <h2><?php echo LR\Filters::escapeHtmlText($case->name) /* line 3 */ ?></h2>
    <h3 class="lead"><b>Status:
<?php
		$this->global->switch[] = ($case->status);
		if (FALSE) {
		}
		elseif (end($this->global->switch) === (0)) {
?>
                <span class="text-danger">K přepracování</span>
<?php
		}
		elseif (end($this->global->switch) === (1)) {
?>
                <span class="text-info">Navžený</span>
<?php
		}
		elseif (end($this->global->switch) === (2)) {
?>
                <span class="text-success">Schválený</span>
<?php
		}
		else {
?>
                Neznámý
            <?php
		}
		array_pop($this->global->switch) ?></b></h3>
<?php
		if ($role==2 OR $role==3) {
			?>    <a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Execution:run", [$case->id])) ?>"><span class=" btn btn-success"><i
                    class="fa fa-play-circle"></i> Spustit test</span></a>
    <a class="btn btn-warning btn-sm" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:edit", [$case->id])) ?>"><i
                class="fa fa-edit"></i></a>
<?php
		}
?>
    <br><br>
    <table id="table1" class="table table-striped w-75 align-self-center">

        <tbody>

        <tr>
            <th scope="row">Popis</th>
            <td>  <?php echo LR\Filters::escapeHtmlText($case->description) /* line 28 */ ?>

            </td>
        </tr>
        <tr>
            <th scope="row">Vytvořeno</th>
            <td>  <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $case->create_time, 'd.m.Y H:i:s')) /* line 33 */ ?>

            </td>
        </tr>
<?php
		if (isset($case->update_time)) {
?>
            <tr>
                <th scope="row">Poslední změna</th>
                <td>  <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $case->update_time, 'd.m.Y H:i:s')) /* line 39 */ ?>

                </td>
            </tr>
<?php
		}
?>
        <tr>
            <th scope="row">Kategorie</th>
            <td>  <?php
		if (isset($category->name)) {
?>

                    <?php echo LR\Filters::escapeHtmlText($category->name) /* line 46 */ ?>

<?php
		}
		else {
?>
                    Není zadána
<?php
		}
?>
            </td>
        </tr>
        <tr>
            <th scope="row">Sada</th>
            <td>  <?php
		if (isset($setName->name)) {
?>


                    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Set:detail", [$setName->id, $setName->parent_id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($setName->name) /* line 56 */ ?></a>
<?php
		}
		else {
?>
                    Není zadána
<?php
		}
?>
            </td>
        </tr>
        <tr>
            <th scope="row">Vytvořeno uživatelem</th>
<?php
		$id = $author->id;
		?>            <td><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:profile", [$id])) ?>"><?php
		echo LR\Filters::escapeHtmlText($author->username) /* line 65 */ ?></a>
            </td>
        </tr>

<?php
		if ($exeCount>=1) {
?>
            <tr>
                <th scope="row">Počet spuštění testu</th>
                <td>
                    <?php echo LR\Filters::escapeHtmlText($exeCount) /* line 73 */ ?> krát
                </td>
            </tr>
            <tr>
                <th scope="row">Poměr výsledků</th>
                <td>

<?php
			$podilFail = ($exeFailCount/$exeCount)*100;
			$podilPass = ($exePassCount/$exeCount)*100;
			$podilSkip = ($exeSkipCount/$exeCount)*100;
?>
                    <div class="progress shadow">
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                             style="width: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss(call_user_func($this->filters->number, $podilFail, 0, ',', ' '))) /* line 85 */ ?>%" aria-valuenow="<?php
			echo LR\Filters::escapeHtmlAttr($exeFailCount) /* line 85 */ ?>"
                             aria-valuemin="0"
                             aria-valuemax="<?php echo LR\Filters::escapeHtmlAttr($exeCount) /* line 87 */ ?>"
                             title="<?php echo LR\Filters::escapeHtmlAttr($exeFailCount) /* line 88 */ ?> neúspěšné výsledky"><?php
			echo LR\Filters::escapeHtmlText($exeFailCount) /* line 88 */ ?></div>
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                             style="width: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss(call_user_func($this->filters->number, $podilPass, 0, ',', ' '))) /* line 90 */ ?>%" aria-valuenow="<?php
			echo LR\Filters::escapeHtmlAttr($exePassCount) /* line 90 */ ?>"
                             aria-valuemin="0"
                             title="<?php echo LR\Filters::escapeHtmlAttr($exePassCount) /* line 92 */ ?> úspěšné výsledky" aria-valuemax="<?php
			echo LR\Filters::escapeHtmlAttr($exeCount) /* line 92 */ ?>"><?php echo LR\Filters::escapeHtmlText($exePassCount) /* line 92 */ ?></div>
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                             style="width: <?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss(call_user_func($this->filters->number, $podilSkip, 0, ',', ' '))) /* line 94 */ ?>%" aria-valuenow="<?php
			echo LR\Filters::escapeHtmlAttr($exeSkipCount) /* line 94 */ ?>"
                             aria-valuemin="0"
                             title="<?php echo LR\Filters::escapeHtmlAttr($exeSkipCount) /* line 96 */ ?> vynechané výsledky"
                             aria-valuemax="<?php echo LR\Filters::escapeHtmlAttr($exeCount) /* line 97 */ ?>"><?php
			echo LR\Filters::escapeHtmlText($exeSkipCount) /* line 97 */ ?></div>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">Průměrný čas spuštění testu</th>
                <td>

<?php
			$prumerCas = ($exeSumTime/$exeCount)/60;
			?>                    <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->number, $prumerCas, 3, ',', ' ')) /* line 106 */ ?> minut

                </td>
            </tr>
<?php
		}
?>
        </tbody>

    </table>

    <h2>Kroky scénáře</h2>
    <table class="table table-striped">

        <thead>
        </thead>
        <tbody>
        <tr>

            <div class="row">
                <div class="col-lg-2 col-sm-1 col-md-1 col-xl-1">
                    <b>Krok</b>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-5 col-xl-4">
                    <b>Akce</b>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-5 col-xl-4">
                    <b>Očekávaný výstup</b>
                </div>

            </div>
        </tr>
<?php
		$iterations = 0;
		foreach ($iterator = $this->global->its[] = new LR\CachingIterator($steps) as $step) {
?>
            <tr>
                <td class="td_steps">
                    <div class="row">
                        <div class="col-lg-2 col-sm-1 col-md-1 col-xl-1">
                            <dt class="step_id primary"><?php echo LR\Filters::escapeHtmlText($iterator->counter) /* line 141 */ ?>. krok</dt>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-md-5 col-xl-4">
                            <div class="card shadow">
                                <div class="card-body">

                                    <p class="card-text">    <?php echo LR\Filters::escapeHtmlText($step->action) /* line 147 */ ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-md-5 col-xl-4">
                            <div class="card shadow">
                                <div class="card-body">

                                    <p class="card-text">    <?php echo LR\Filters::escapeHtmlText($step->result) /* line 156 */ ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-1 col-md-1 col-xl-1">
<?php
			if ($role==2 OR $role==3) {
?>
                            <a
                                    class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("editStep!", ['id_step'=>$step->id])) ?>"><span
                                        class=" btn btn-warning btn-sm"><i class="fa fa-edit"></i></span></a>
                            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("deleteStep!", ['id_step'=>$step->id])) ?>"><span class=" btn btn-danger btn-sm"><i
                                            class="fa fa-trash "></i></span></a>

<?php
			}
?>
                        </div>
                        <div class="col-lg-2 col-sm-1 col-md-1 col-xl-1">

                            <?php
			if ($step->note<>null) {
?><br><br>
                                <a class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addNote!", ['id_step'=>$step->id])) ?>"><span class=" btn btn-light btn-sm"><i
                                                class="fa fa-pencil-alt"></i> Editovat poznámku</span></a>

                                <button type="button" class="btn btn-sm btn-primary shadow " data-toggle="popover" title="Poznámka"
                                        data-content="<?php echo LR\Filters::escapeHtmlAttr($step->note) /* line 178 */ ?>"><i
                                            class="fa fa-info fa-1x "></i></button>
<?php
			}
			else {
				?>                                <a class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addNote!", ['id_step'=>$step->id])) ?>"><span class=" btn btn-light btn-sm"><i
                                                class="fa fa-plus-circle "></i> Přidat poznámku</span></a>
<?php
			}
?>
                        </div>
                    </div>


                </td>
            </tr>

<?php
			$iterations++;
		}
		array_pop($this->global->its);
		$iterator = end($this->global->its);
?>
        </tbody>
    </table>
    <div class="empty-block"></div>
<?php
		if ($role==2 OR $role==3) {
			?>    <a class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addStep!")) ?>"><span class=" btn btn-success"><i
                    class="fa fa-plus-circle"></i> Přidat krok</span></a>
    <div class="empty-block"></div>

    <h2>Výskyt se v testplánech</h2>

    <table class="table table-striped w-50 align-self-center">

        <tbody>
<?php
			$iterations = 0;
			foreach ($plans as $plan) {
?>
            <tr>
                <td>
                    <b> <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Plan:detail", [$plan->id])) ?>"><?php
				echo LR\Filters::escapeHtmlText($plan->name) /* line 208 */ ?> </a></b>
                </td>
                <td>
                    Status: <b><?php
				$this->global->switch[] = ($plan->status);
				if (FALSE) {
?>

<?php
				}
				elseif (end($this->global->switch) === (0)) {
?>
                            <span class="text-info"> Upravený</span>
<?php
				}
				elseif (end($this->global->switch) === (1)) {
?>
                            <span class="text-success">Dokončený</span>
<?php
				}
				else {
?>
                            Vytvořený
                        <?php
				}
				array_pop($this->global->switch) ?></b>
                <td>  <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $case->create_time, 'd.m.Y H:i:s')) /* line 219 */ ?>

                </td>
                </td>
            </tr>

<?php
				$iterations++;
			}
?>
        </tbody>
    </table>
    <h2>Záznamy spuštění testu</h2>

<?php
			/* line 229 */ $_tmp = $this->global->uiControl->getComponent("exeGrid");
			if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
			$_tmp->render();
		}
?>

<?php
	}


	function blockModal_edit_title($_args)
	{
?>    Editace kroku
<?php
	}


	function blockModal_edit_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 239 */ $_tmp = $this->global->uiControl->getComponent("editStepForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_edit_footer($_args)
	{
		
	}


	function blockModal_add_title($_args)
	{
?>    Nový krok
<?php
	}


	function blockModal_add_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 250 */ $_tmp = $this->global->uiControl->getComponent("addStepForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_add_footer($_args)
	{
		
	}


	function blockModal_note_title($_args)
	{
?>    Připomínka ke kroku scénáře
<?php
	}


	function blockModal_note_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 261 */ $_tmp = $this->global->uiControl->getComponent("addNoteForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_note_footer($_args)
	{
		
	}

}
