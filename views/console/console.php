<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Widget;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $model app\models\ConsoleForm */
/* @var $form yii\widgets\ActiveForm */

?>

<script src="jquery.min.js"></script>
<script>
	function updb() {

		$("#consoleform-commands").val(($("#consoleform-commands").val()) + '\n' + ("php cli.php update:kiosk -IG"));
	}
	function dropdb() {

		$("#consoleform-commands").val(($("#consoleform-commands").val()) + '\n' + ("rm /dbs/kiosk.db"));
	}
	function pull() {
		$("#consoleform-commands").val(($("#consoleform-commands").val()) + '\n' + ("rm -rf .hg/store/lock\nhg pull \nhg up -C"));

	}
	function info() {
		$("#consoleform-commands").val(($("#consoleform-commands").val()) + '\n' + ("php cli.php kiosk:info"));
	}
	function grep() {

		$("#consoleform-commands").val(($("#consoleform-commands").val()) + '\n' + ("ls -la /var/www/kiosk-api/data/orders | grep json"));
	}
function fullup() {

		$("#consoleform-commands").val(($("#consoleform-commands").val()) + '\n' + ("echo [paths] >.hg/hgrc \necho default = http://10.0.3.194/repo/kiosk-api >> .hg/hgrc \necho slave = http://repo.terminal.maxus.lan:8080 >> .hg/hgrc\nhg recover\nhg pull slave\nhg up production -C\ncrontab /var/www/kiosk-api/misc/crontab.tpl\nphp cli.php update:kiosk -IG"));
	}

</script>
<button onClick="updb()">собрать базу!</button>
<button onClick="dropdb()">удалить базу</button>
<button onClick="pull()">обновить</button>
<button onClick="info()">info</button>
<button onClick="grep()">grep json</button>
<button onClick="fullup()">full update</button>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'ip')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'except_ip')->textarea(['rows' => 4]) ?>

<?= $form->field($model, 'port')->textInput() ?>

<?= $form->field($model, 'dir')->textInput() ?>

<?= $form->field($model, 'url')->textInput() ?>

<?= $form->field($model, 'commands')->textarea(['rows' => 6]) ?>


<div class="form-group">
<?= Html::submitButton('GO Baby!', ['class' => 'btn btn-success']) ?>
</div>

<?php
if (!empty($model->ip_list)):
	foreach ($model->ip_list as $key):

		?>

		<div class="navbar">



			<h3><a class="brand" href="<?php echo sprintf("http://login:pass@%s:%s/lz.php", $key, $model->port); ?>"><?php echo sprintf("%s", $key); ?></a></h3>
		</div>
		<div class="row">
			<div class="span12">
				<iframe src="<?php echo sprintf("http://login:pass@%s:%d%s", $key, $model->port, (empty($model->url) ? $model->command_url : $model->url)); ?>"
						style="width:100%;" name="frame_<?php echo $key ?>" id="frame<?php echo $key ?>"></iframe>
			</div>
		</div>

	<?php endforeach ?>
<?php endif ?>
<?php ActiveForm::end(); ?>



