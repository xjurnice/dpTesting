<?php
// source: C:\xampp\htdocs\dp-testing\app\presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Template5ccb120599 extends Latte\Runtime\Template
{
	public $blocks = [
		'style' => 'blockStyle',
		'_modal' => 'blockModal',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'style' => 'html',
		'_modal' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title><?php
		if (isset($this->blockQueue["title"])) {
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
			?> | <?php
		}
?>TestOne - testovací nástroj</title>
<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('style', get_defined_vars());
?>

</head>

<body>
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content"<?php echo ' id="' . htmlSpecialChars($this->global->snippetDriver->getHtmlId('modal')) . '"' ?>>
<?php $this->renderBlock('_modal', $this->params) ?>
        </div>
    </div>
</div>
<div class="se-pre-con"></div>

<?php
		if ($user->loggedIn) {
			$role = $user->getIdentity()->role_id;
?>




    <div class="w3-sidebar w3-bar-block w3-collapse w3-card" style="width:300px; padding: 1em; background-color: #ECEDEE" id="mySidebar">
                <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Zavřít &times;</button>

                <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Dashboard:default")) ?>"><img src="<?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 81 */ ?>/images/logo.png" class="img-fluid" alt="TestOne - testovací nástroj"> </a>



            <div class="card-body">

<?php
			$this->global->switch[] = ($projectActive);
			if (FALSE) {
			}
			elseif (end($this->global->switch) === (1)) {
?>

<?php
			}
			elseif (end($this->global->switch) === (0)) {
				if ($project<>0) {
?>
                        <p class="bg-danger fail text-white font-weight-bold" style="padding: 1em"><i
                                    class="fa fa-exclamation-circle"></i> Projekt je neaktivní.</p>
<?php
				}
			}
			else {
?>

<?php
			}
			array_pop($this->global->switch);
			$form = $_form = $this->global->formsStack[] = $this->global->uiControl["selectProjectForm"];
			?>                <form class=form-inline<?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
			'class' => NULL,
			), false) ?>>
                    <div class="form-group">

                        <select class="form-control"<?php
			$_input = end($this->global->formsStack)["id"];
			echo $_input->getControlPart()->addAttributes(array (
			'class' => NULL,
			))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary"<?php
			$_input = end($this->global->formsStack)["edit"];
			echo $_input->getControlPart()->addAttributes(array (
			'class' => NULL,
			))->attributes() ?>>
                    </div>
<?php
			echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?>                </form>


            </div>


            <div class="list-group">
<?php
			if ($project==0) {
?>
                    <div class="empty-block"></div>
<?php
			}
			else {
				/* line 117 */
				$this->createTemplate("components/menu.latte", $this->params, "include")->renderToContentType('html');
			}
?>
                <div class="empty-block"></div>
            </div>

        </div>

    <div class="w3-main" style="margin-left:300px">
        <div class="col-md-auto ml-sm-auto col-lg-auto px-3">
            <div class="navbar navbar-expand navbar-light bg-light shadow">
                <button class="w3-button w3-teal w3-xlarge w3-hide-large" style="margin-right:1em " onclick="w3_open()">&#9776;</button>
                <a href="javascript:history.back()"><i class="fa fa-backward"></i> ZPĚT</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <li class="nav-item dropdown form-inline my-2 my-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="fa fa-user-circle"></span> Přihlášen jako <?php echo LR\Filters::escapeHtmlText($user->getIdentity()->username) /* line 145 */ ?>

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:profile", [$user->getIdentity()->id])) ?>">Zobrazit profil</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("User:edit")) ?>">Editace profilu</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>"><i class="fas fa-sign-out-alt"></i> Odhlásit
                                se</a>
                        </div>
                    </li>

                </div>
            </div>
            <br>
<?php
			if ($project==0) {
?>
                <center>
                    <div class="fail shadow text-white align-self-center" style="padding: 1em; font-size: 1.2em; font-weight: bold"><i class="fa fa-exclamation-circle"></i> Je
                        třeba vybrat nějaký projekt!
                    </div>

                </center>
<?php
			}
			$iterations = 0;
			foreach ($flashes as $flash) {
				?>            <div<?php if ($_tmp = array_filter(['flash', $flash->type])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><i
                        class="fa fa-check-circle"></i> <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 170 */ ?></div>
<?php
				$iterations++;
			}
?>
            <div class="col pt-3 px-3">
<?php
			if ($project<>0) {
				$this->renderBlock('content', $this->params, 'html');
			}
?>

            </div>
        </div>
    </div>

<?php
		}
		else {
			$iterations = 0;
			foreach ($flashes as $flash) {
				?>    <div<?php if ($_tmp = array_filter(['flash', $flash->type])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><i
                class="fa fa-check-circle"></i> <?php echo LR\Filters::escapeHtmlText($flash->message) /* line 182 */ ?></div>
<?php
				$iterations++;
			}
?>


<?php
			$this->renderBlock('content', $this->params, 'html');
?>

<?php
		}
		$this->renderBlock('scripts', get_defined_vars());
?>
</body>
</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 169, 181');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockStyle($_args)
	{
		extract($_args);
?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 13 */ ?>/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 14 */ ?>/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/css/w3.css">
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 16 */ ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 17 */ ?>/bower_components/flipclock/compiled/flipclock.css">
        <link rel="stylesheet" type="text/css"
              href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 19 */ ?>/bower_components/ublaboo-datagrid/assets/dist/datagrid.css">
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 20 */ ?>/css/style.css">
        <!-- Fontawseome -->
        <link href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 22 */ ?>/fonts/fontawesome/fontawesome-all.css" rel="stylesheet">


        <!-- Use this css for that pretty checkboxes (https://github.com/paveljanda/happy) -->
        <link rel="stylesheet" type="text/css" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 26 */ ?>/bower_components/happy/dist/happy.css">
        <link rel="stylesheet" type="text/css"
              href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 28 */ ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css">



        <!-- Use this css for ajax spinners -->
        <link rel="stylesheet" type="text/css"
              href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 34 */ ?>/bower_components/ublaboo-datagrid/assets/dist/datagrid-spinners.css">

        <!-- Include this css when using FilterMultiSelect (silviomoreto.github.io/bootstrap-select) -->
        <link rel="stylesheet" type="text/css"
              href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 38 */ ?>/bower_components/bootstrap-select/dist/css/bootstrap-select.css">

<?php
	}


	function blockModal($_args)
	{
		extract($_args);
		$this->global->snippetDriver->enter("modal", "static");
		?>            <?php
		if (isset($modal)) {
?>

                <div class="modal-header">

                    <h4 class="modal-title">
                        <?php
			if (isset($this->blockQueue["modal-$modal-title"])) {
				$this->renderBlock("modal-$modal-title", $this->params, 'html');
			}
?>

                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
			if (isset($this->blockQueue["modal-$modal-body"])) {
				$this->renderBlock("modal-$modal-body", $this->params, 'html');
			}
?>

                </div>
<?php
			if (isset($this->blockQueue["modal-$modal-footer"])) {
?>
                    <div class="modal-footer">
<?php
				$this->renderBlock("modal-$modal-footer", $this->params, 'html');
?>
                    </div>
<?php
			}
		}
		$this->global->snippetDriver->leave();
		
	}


	function blockScripts($_args)
	{
		extract($_args);
?>





        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 194 */ ?>/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 195 */ ?>/bower_components/bootstrap/assets/js/vendor/popper.min.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 196 */ ?>/bower_components/bootstrap/dist//js/bootstrap.min.js"></script>


        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 199 */ ?>/bower_components/nette-forms/src/assets/netteForms.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 200 */ ?>/bower_components/nette.ajax.js/nette.ajax.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 201 */ ?>/js/main.js"></script>

        <!-- Use this tiny js for that pretty checkboxes (https://github.com/paveljanda/happy) -->
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 204 */ ?>/bower_components/happy/dist/happy.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 205 */ ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 206 */ ?>/bower_components/jquery-ui-sortable/jquery-ui-sortable.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 207 */ ?>/bower_components/ublaboo-datagrid/assets/dist/datagrid.js"></script>

        <!-- It is recommended to include this JS file with just a few bits. It refreshes URL on non ajax request -->
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 210 */ ?>/bower_components/ublaboo-datagrid/assets/dist/datagrid-instant-url-refresh.js"></script>

        <!-- Use this little extension for ajax spinners -->
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 213 */ ?>/bower_components/ublaboo-datagrid/assets/dist/datagrid-spinners.js"></script>

        <!-- Include bootstrap.js for proper behaviour of ColumnStatus -->
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 216 */ ?>/bower_components/bootstrap/dist/js/bootstrap.js"></script>

        <!-- Include bootstrap-select.js when using FilterMultiSelect (silviomoreto.github.io/bootstrap-select) -->
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 219 */ ?>/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>

        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 221 */ ?>/bower_components/flipclock/compiled/flipclock.js"></script>
        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 222 */ ?>/bower_components/chart.js/dist/Chart.min.js"></script>



        <script>

            function w3_open() {
                document.getElementById("mySidebar").style.display = "block";
            }
            function w3_close() {
                document.getElementById("mySidebar").style.display = "none";
            }
            $(function () {
                $.nette.init();
            });
        </script>
        <script>
            // Wait for window load
            $(window).load(function () {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");
                ;
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
            $(function () {
                $('[data-toggle="popover"]').popover()
                $('#element').popover('enable');

            });
        </script>




<?php
	}

}
