<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Plan/detail.latte

use Latte\Runtime as LR;

class Templatebb7e8be5dd extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'modal-addcase-title' => 'blockModal_addcase_title',
		'modal-addcase-body' => 'blockModal_addcase_body',
		'modal-addcase-footer' => 'blockModal_addcase_footer',
		'modal-edit-title' => 'blockModal_edit_title',
		'modal-edit-body' => 'blockModal_edit_body',
		'modal-edit-footer' => 'blockModal_edit_footer',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'content' => 'html',
		'modal-addcase-title' => 'html',
		'modal-addcase-body' => 'html',
		'modal-addcase-footer' => 'html',
		'modal-edit-title' => 'html',
		'modal-edit-body' => 'html',
		'modal-edit-footer' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>






<?php
		$this->renderBlock('scripts', get_defined_vars());
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
    <div class="row">

        <div class="col-xl-4 col-sm-5 col-md-4 col-6">

            <h2><i class="fa fa-map"></i> <?php echo LR\Filters::escapeHtmlText($plan->name) /* line 6 */ ?></h2>

            <h3 class="lead">
<?php
		if ($user->getIdentity()->role_id == 2) {
			?>                <a class="ajax"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit!", ['id'=>$plan->id])) ?>"><span class=" btn btn-warning btn-sm"><i
                                class="fa fa-pencil-alt"></i></span></a>
<?php
		}
		?>                <b>Status: <?php
		$this->global->switch[] = ($plan->status);
		if (FALSE) {
?>

<?php
		}
		elseif (end($this->global->switch) === (0)) {
?>
                Upravený
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
		array_pop($this->global->switch) ?></b>     </h3>
<?php
		if ($caseNumber>0) {
?>
                <div class="progress w-100">
                    <div class="progress-bar progress-bar-striped bg-success font-weight-bold" role="progressbar" aria-valuenow="<?php
			echo LR\Filters::escapeHtmlAttr(call_user_func($this->filters->number, $processNumber/$caseNumber*100, 0)) /* line 23 */ ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss(call_user_func($this->filters->number, $processNumber/$caseNumber*100, 0, ',', ' '))) /* line 23 */ ?>%"><?php
			echo LR\Filters::escapeHtmlText(call_user_func($this->filters->number, $processNumber/$caseNumber*100, 0, ',', ' ')) /* line 23 */ ?> %</div>
                </div>
<?php
		}
?>
        </div>
        <div class="col-xl-2 col-sm-5 col-md-4 col-6">

<?php
		if (isset($next)) {
?>

                <a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Execution:run", ['case_id'=>$next->id, 'plan_id'=>$plan_id])) ?>"><span class=" btn btn-primary"><i
                                class="fa fa-play-circle"></i> Pokračovat v test plánu</span></a>
<?php
		}
		else {
			if (isset($first)) {
				if (!$plan->status==1) {
					?>                        <a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Execution:run", [$first->case_id, 'plan_id'=>$plan_id])) ?>"><span class=" btn btn-primary"><i
                                        class="fa fa-play-circle"></i> Spustit test plán</span></a>
<?php
				}
			}
?>

<?php
		}
?>
        </div>
    </div>
    <br>


    <br>
    <br>
    <table class="table table-striped w-75">

        <tbody>
<?php
		if ($plan->description <> null) {
?>
        <tr>
            <th scope="row">Popis</th>
            <td>  <?php echo LR\Filters::escapeHtmlText($plan->description) /* line 55 */ ?>

            </td>

        </tr>
<?php
		}
?>
        <tr>
            <th scope="row">Pro uživatele</th>
            <td>  <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:profile", [$assign_user->id])) ?>"><?php
		echo LR\Filters::escapeHtmlText($assign_user->username) /* line 62 */ ?></a>
            </td>
        </tr>
        <tr>
            <th scope="row">Vytvořeno</th>
            <td>  <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $plan->create_time, 'd.m.Y H:i:s')) /* line 67 */ ?>

            </td>
        </tr>
        <tr>
            <th scope="row">Plánovaný čas spuštění</th>
            <td>  <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $plan->planed_time, 'd.m.Y')) /* line 72 */ ?>

            </td>
        </tr>

        </tbody>
    </table>
<?php
		if ($isExe) {
?>
        <div class="row">
            <div class="col-6 col-md-4 col-xl-4">
                <div class="card box shadow" style="position: relative;padding: 1em;  width:400px">
                    <div class="h5 chartjs-title align-self-center">Úspěšnost testů</div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="col-7 col-md-9 col-xl-8 ">
                <div class="card box shadow" style="position: relative;padding: 1em; width:600px">
                    <div class="h5 chartjs-title align-self-center">Čas strávený na jednotlivé testy</div>
                    <canvas id="myChart2"></canvas>
                </div>
            </div>

        </div>


<?php
		}
		?>    <h3>Přiřazené testovací případy</h3>     <a class="ajax" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("addCase!")) ?>"><span class=" btn btn-success btn-sm"><i
                class="fa fa-plus-circle"></i> Přidat testovací případy</span></a>
<?php
		/* line 99 */ $_tmp = $this->global->uiControl->getComponent("assignCaseGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>


<?php
	}


	function blockModal_addcase_title($_args)
	{
?>    Přiřazení nového testovacího případu
<?php
	}


	function blockModal_addcase_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 108 */ $_tmp = $this->global->uiControl->getComponent("caseGrid");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_addcase_footer($_args)
	{
		
	}


	function blockModal_edit_title($_args)
	{
?>    Editace Test plánu
<?php
	}


	function blockModal_edit_body($_args)
	{
		extract($_args);
?>

<?php
		/* line 119 */ $_tmp = $this->global->uiControl->getComponent("editPlanForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<?php
	}


	function blockModal_edit_footer($_args)
	{
		
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
		if ($isExe) {
			?>        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 128 */ ?>/js/dashboard-graphs.js"></script>

        <script>


            var ctx = document.getElementById('myChart').getContext('2d');

            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'pie',

                // The data for our dataset
                data: {

                    labels: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($labels)) /* line 142 */ ?>),
                    datasets: [{
                        label: "My First dataset",
                        backgroundColor: ['rgba(40,167,69,0.8)', "rgba(220, 53, 69,0.8)", "rgba(255, 193, 7,0.8)"],

                        data: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($series)) /* line 147 */ ?>)

                    }]
                },

                // Configuration options go here
                options: {
                    responsive: false,
                    maintainAspectRatio: true,
                    title: {
                        display: false,

                    }, legend: {
                        display: false,
                    }
                }
            });

            var ctx = document.getElementById('myChart2').getContext('2d');

            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {

                    labels: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($labelsTime)) /* line 174 */ ?>),
                    datasets: [{
                        label: 'Strávený čas v minutách',
                        backgroundColor: color,

                        data: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($seriesTime)) /* line 179 */ ?>)

                    }]
                },

                // Configuration options go here
                options: {
                    responsive: false,
                    scales: {
                        xAxes: [{
                            stacked: true,
                            beginAtZero: true,

                            ticks: {
                                stepSize: 1,
                                min: 0,
                                autoSkip: false,

                                callback: function (value) {
                                    return value.substr(0, 10) + '...';//truncate
                                },
                            }
                        }],

                    },

                    tooltips: {
                        enabled: true,
                        mode: 'label',
                        callbacks: {
                            title: function (tooltipItems, data) {
                                var idx = tooltipItems[0].index;
                                return data.labels[idx];
                            },

                        },
                    }, legend: {
                        display: false,
                    }
                }
            });
        </script>
<?php
		}
		
	}

}
