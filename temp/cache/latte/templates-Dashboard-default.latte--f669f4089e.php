<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/Dashboard/default.latte

use Latte\Runtime as LR;

class Templatef669f4089e extends Latte\Runtime\Template
{
	public $blocks = [
		'style' => 'blockStyle',
		'content' => 'blockContent',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'style' => 'html',
		'content' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('style', get_defined_vars());
?>

<?php
		$this->renderBlock('content', get_defined_vars());
		$this->renderBlock('scripts', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['event'])) trigger_error('Variable $event overwritten in foreach on line 114');
		if (isset($this->params['r'])) trigger_error('Variable $r overwritten in foreach on line 150');
		if (isset($this->params['pl'])) trigger_error('Variable $pl overwritten in foreach on line 177');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockStyle($_args)
	{
		extract($_args);
		$this->renderBlockParent('style', get_defined_vars());
?>


<?php
	}


	function blockContent($_args)
	{
		extract($_args);
		$role = $user->getIdentity()->role_id;
?>

    <div class="row">
<?php
		if ($project<>0) {
?>

<?php
			if ($role==2) {
?>
            <div class="col-lg-4 col-sm-6 col-md-7 col-xl-4">

                <div class="card box shadow" style="padding: 1em">
                    <div class="h5 chartjs-title align-self-center">Počet test. případů na projekt</div>
                    <canvas id="myChart" width="600" height="400"></canvas>

                    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Project:add")) ?>">
                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>
                            Přidat nový projekt
                        </button>
                    </a>
                </div>

            </div>
<?php
			}
?>

<?php
			if ($role==2 OR $role==3) {
?>
            <div class="col-lg-4 col-sm-6 col-md-7 col-xl-4">
                <div class="card box shadow" style="padding: 1em">
                    <div class="h5 chartjs-title align-self-center">Celkový čas strávený testováním dle uživatele</div>
                    <hr>
                    <canvas id="sumTime" width="600" height="400"></canvas>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-md-7 col-xl-4">
                <div class="card box shadow" style="padding: 1em">
                    <div class="h5 chartjs-title align-self-center">Spuštených testů dle uživatele</div>
                    <canvas id="runByTester" width="600" height="400"></canvas>
                </div>

            </div>
<?php
			}
?>

        </div>
        <div class="row">

            <div class="col-lg-4 col-md-5 col-xl-4 ">


                <div class="card text-white bg-primary box shadow skip" style="padding: 1em">
                    <h4 style=" text-align: center"><i class="fa fa-map fa-2x"></i> Počet test plánů <span
                                class="count"><?php echo LR\Filters::escapeHtmlText($plan) /* line 56 */ ?></span></h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-3 col-md-6 col-xl-4 ">
                <div class="card text-white bg-success box shadow step" style="padding: 1em">
                    <h4 style="text-align: center"><i class="fa fa-check-circle fa-2x"></i> Počet úspěšných testů <span
                                class="count"><?php echo LR\Filters::escapeHtmlText($sucess) /* line 62 */ ?></span></h4>
                </div>

            </div>

            <div class="col-lg-4 col-sm-6 col-md-7 col-xl-4">


                <div class="card text-white bg-danger box shadow fail" style="padding: 1em">
                    <h4 style=" text-align: center"><i class="fa fa-bug fa-2x"></i> Počet neúspěšných testů: <span
                                class="count"><?php echo LR\Filters::escapeHtmlText($defect) /* line 72 */ ?></span></h4>
                </div>

            </div>
            <div class="col-lg-4 col-sm-6 col-md-7 col-xl-4">


                <div class="card text-white bg-info box shadow fail" style="padding: 1em">
                    <h4 style=" text-align: center"><i class="fa fa-clock fa-2x"></i> Celkově stráveno testováním:
                        <span class="count"><?php echo LR\Filters::escapeHtmlText($sumTime->s) /* line 81 */ ?></span> minut</h4>
                </div>

            </div>
            <div class="col-lg-4 col-sm-6 col-md-7 col-xl-4">


                <div class="card text-white bg-warning box shadow fail" style="padding: 1em">
                    <h4 style=" text-align: center"><i class="fa fa-angle-double-right fa-2x"></i> Počet vynechaných
                        testů: <span class="count"><?php echo LR\Filters::escapeHtmlText($skip) /* line 90 */ ?></span></h4>
                </div>

            </div>

            <div class="col-lg-4 col-sm-6 col-md-7 col-xl-4">


                <div class="card text-white bg-dark box shadow fail" style="padding: 1em">
                    <h4 style=" text-align: center"><i class="fa fa-users fa-2x"></i> Počet uživatelů: <span
                                class="count"><?php echo LR\Filters::escapeHtmlText($users) /* line 100 */ ?></span></h4>
                </div>

            </div>
        </div>
        <div class="row">


<?php
			if ($role==3 OR $role==4 OR $role==2) {
?>
            <div class="col-lg-4 col-md-5 col-xl-4 ">
                <div class="card box shadow">
                    <h5 class="card-header">Poslední aktivity</h5>
                    <div class="card-body">

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
						?>                                    <i class="fa fa-plus-circle"></i><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:detail", [$event->object_id])) ?>">
                                    Vytvořené
                                    test. případu </a>
<?php
					}
					elseif (end($this->global->switch) === (3)) {
						?>                                    <i class="fa fa-play-circle"></i><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:detail", [$event->object_id])) ?>"> Spuštění
                                    test. případu</a>
<?php
					}
					elseif (end($this->global->switch) === (4)) {
?>
                                    <i class="fa fa-arrow-alt-circle-left"></i>
                                    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Case:detail", [$event->object_id])) ?>"> Změna statusu test. případu</a>

<?php
					}
					else {
?>
                                    Neznámý
<?php
					}
					array_pop($this->global->switch) ?>                                (<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $event->event_time, 'd.m.Y H:i:s')) /* line 133 */ ?>) -
                                <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:profile", [$event->user_id])) ?>"><?php
					echo LR\Filters::escapeHtmlText($event->username) /* line 134 */ ?></a></p>
<?php
					$iterations++;
				}
				?>                        <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("all")) ?>">
                            <button type="button" class="btn btn-primary">Zobrazit všechny aktivity</button>
                        </a>

                    </div>
                </div>
<?php
			}
?>
            </div>
<?php
			if ($role==3 OR $role==4 OR $role==2) {
?>
                <div class="col-lg-4 col-md-5 col-xl-4 ">
                    <div class="card box shadow">
                        <h5 class="card-header">Požadavky</h5>
                        <div class="card-body">

<?php
				$iterations = 0;
				foreach ($request as $r) {
?>
                                <p class="card-text">
                                    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Request:detail", [$r->id])) ?>"> <?php
					echo LR\Filters::escapeHtmlText($r->name) /* line 152 */ ?></a>
                                    <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $r->create_time, 'd.m.Y H:i:s')) /* line 153 */ ?> - Status:
                                    <b><?php
					$this->global->switch[] = ($r->status);
					if (FALSE) {
?>

<?php
					}
					elseif (end($this->global->switch) === (0)) {
?>
                                            <span class="text-info">zadaný</span>
<?php
					}
					elseif (end($this->global->switch) === (1)) {
?>
                                            <span class="text-success">splněný</span>
<?php
					}
					else {
?>
                                            Vytvořený
                                        <?php
					}
					array_pop($this->global->switch) ?></b>

                                </p>
<?php
					$iterations++;
				}
?>


                        </div>
                    </div>
                </div>
<?php
			}
			if ($role==3) {
?>
                <div class="col-lg-4 col-md-5 col-xl-4 ">
                    <div class="card box shadow">
                        <h5 class="card-header">Mé test plány</h5>
                        <div class="card-body">

<?php
				$iterations = 0;
				foreach ($plansUser as $pl) {
?>
                                <p class="card-text">


                                    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Plan:detail", [$pl->id])) ?>"><?php
					echo LR\Filters::escapeHtmlText($pl->name) /* line 181 */ ?></a>
                                    | <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $pl->planed_time, 'd.m.Y H:i:s')) /* line 182 */ ?> |
                                    <b>Status: <?php
					$this->global->switch[] = ($pl->status);
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
					array_pop($this->global->switch) ?></b>

                                </p>
<?php
					$iterations++;
				}
?>


                        </div>
                    </div>
                </div>
<?php
			}
?>

        </div>
<?php
		}
		
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>

    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 207 */ ?>/js/dashboard-graphs.js"></script>
<?php
		if ($project<>0) {
?>
        <script>
            $('.count').each(function () {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 1000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });


            Chart.defaults.global.responsive = true;


            var ctx = document.getElementById('runByTester').getContext('2d');

            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'doughnut',

                // The data for our dataset
                data: {

                    labels: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($labelsTesters)) /* line 235 */ ?>),
                    datasets: [{
                        label: "Testovací případy",
                        backgroundColor: color,

                        data: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($seriesTesters)) /* line 240 */ ?>)

                    }]
                },

                // Configuration options go here
                options: {
                    animation: {
                        easing: "easeInOutBack"
                    },
                    responsive: true,

                    legend: {
                        display: true,
                    }
                }
            });

            var ctx = document.getElementById('sumTime').getContext('2d');

            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {

                    labels: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($labelsTesters)) /* line 267 */ ?>),
                    datasets: [{
                        label: "Strávený čas v minutách",
                        backgroundColor: color2,

                        data: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($sumTimeTesters)) /* line 272 */ ?>)

                    }]
                },

                // Configuration options go here
                options: {
                    animation: {
                        easing: "easeInOutBack"
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                            beginAtZero: true,

                            ticks: {
                                stepSize: 1,
                                min: 0,
                                autoSkip: false
                            }
                        }]
                    },
                    legend: {
                        display: false,
                    }
                }
            });

            var ctx = document.getElementById('myChart').getContext('2d');

            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {

                    labels: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($labels)) /* line 310 */ ?>),
                    datasets: [{
                        label: "Testovací případy",
                        backgroundColor: color3,

                        data: JSON.parse(<?php echo LR\Filters::escapeJs(json_encode($series)) /* line 315 */ ?>)

                    }]
                },

                // Configuration options go here
                options: {
                    animation: {
                        easing: "easeInOutBack"
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                            beginAtZero: true,

                            ticks: {
                                stepSize: 1,
                                min: 0,
                                autoSkip: false
                            }
                        }]
                    },
                    legend: {
                        display: false,
                    }
                }
            });

        </script>
<?php
		}
		
	}

}
