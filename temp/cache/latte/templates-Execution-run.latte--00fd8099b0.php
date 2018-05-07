<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Execution/run.latte

use Latte\Runtime as LR;

class Template00fd8099b0 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'scripts' => 'blockScripts',
		'modal-defect-title' => 'blockModal_defect_title',
		'modal-defect-body' => 'blockModal_defect_body',
		'modal-defect-footer' => 'blockModal_defect_footer',
	];

	public $blockTypes = [
		'content' => 'html',
		'scripts' => 'html',
		'modal-defect-title' => 'html',
		'modal-defect-body' => 'html',
		'modal-defect-footer' => 'html',
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
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['step'])) trigger_error('Variable $step overwritten in foreach on line 39');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>



    <p>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
            Nápověda
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            Pro ovládání funkcí je možné využít kláves (F1 - začít průchod testu znovu, F2 - zastavení běžící časomíry, F3 - spuštění časomíry).
        </div>
    </div>

    <hr>
    <h2><?php echo LR\Filters::escapeHtmlText($case->name) /* line 18 */ ?></h2>
    <p style="padding: 1em" class="w-50 shadow"><b>Popis:</b> <?php echo LR\Filters::escapeHtmlText($case->description) /* line 19 */ ?></p>
    <table class="table noBorder">
        <thead>
        </thead>
        <tbody>
        <tr>
            <div class="row">
                <div class="col-lg-2 col-sm-1 col-md-1 col-xl-1">
                    <b>Krok</b>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-5 col-xl-5">
                    <b>Akce</b>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-5 col-xl-5">
                    <b>Očekávaný výstup</b>
                </div>
            </div><br>
        </tr>


<?php
		$iterations = 0;
		foreach ($iterator = $this->global->its[] = new LR\CachingIterator($steps) as $step) {
?>

            <tr>
                <td class="td_steps"><a class="steps">
                        <div class="row">
                            <div class="col-lg-2 col-sm-1 col-md-1 col-xl-1">
                                <dt class="step_id"><?php echo LR\Filters::escapeHtmlText($iterator->counter) /* line 45 */ ?>. krok</dt>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-5 col-xl-5">
                                <div class="card shadow">
                                    <div class="card-body">

                                        <p class="card-text">    <?php echo LR\Filters::escapeHtmlText($step->action) /* line 51 */ ?></p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-5 col-xl-5">
                                <div class="card shadow">
                                    <div class="card-body">

                                        <p class="card-text">    <?php echo LR\Filters::escapeHtmlText($step->result) /* line 60 */ ?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <span id="defect" class="def hidden"> <a class="btn btn-light text-danger shadow ajax" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("defect!", [$step->id])) ?>"><i class="fa fa-bug"></i> Popsat defekt</a></span>

                </td>
            </tr>
<?php
			$iterations++;
		}
		array_pop($this->global->its);
		$iterator = end($this->global->its);
?>
        <tr> <td class="td_steps" style="height: 1px; padding:0;"><a class="steps"></a></td></tr>
        </tbody>
    </table>


<?php
		/* line 77 */ $_tmp = $this->global->uiControl->getComponent("runExecutionForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
        <div class="row">
        </div>

        <div class="col-2"> <button id="reset" class="btn btn-warning btn-lg" onClick="window.location.reload()">Reset</button></div>
    </div>


    <div class="empty-block"></div><div class="empty-block"></div><div class="empty-block"></div>
    <div class="row footer">
        <div class="col-7 col-sm-4  col-md-5 col-xl-7 align-content-md-start">
            <button id="next" class="btn btn-success">Úspěšný <i class="fa fa-arrow-down"></i></button>
            <button id="fail" class="btn btn-danger">Neúspěšný <i class="fa fa-arrow-right"></i></button>
            <button id="previous" class="btn btn-light">Předchozí <i class="fa fa-arrow-up"></i></button>
            <button id="skip" class="btn btn-warning">Přeskočený <i class="fa fa-arrow-left"></i></button>
            <button id="start_again" class="btn btn-dark">Začít od 1. kroku [F1] </button>

        </div>
        <div class="col-2 col-sm-2 col-md-3 col-xl-2" style="text-align: right">
            <hr>
            <button id="start" class="btn btn-success"><i class="fa fa-play"></i></button>
            <button id="stop" class="btn btn-danger"><i class="fa fa-pause"></i></button>


        </div>
        <div class="col-3 col-sm-6 col-md-4 col-xl-3" >
            <div class="clock"></div>


        </div>

        <hr>

    </div>
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
		?>    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 116 */ ?>/js/run_test.js"></script>

<?php
	}


	function blockModal_defect_title($_args)
	{
?>    Popis defektu
<?php
	}


	function blockModal_defect_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 125 */ $_tmp = $this->global->uiControl->getComponent("defectForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_defect_footer($_args)
	{
		
	}

}
