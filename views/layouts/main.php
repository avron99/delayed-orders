<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<script type="text/javascript" src="/web/tablesorter/jquery-latest.js"></script>
		<script type="text/javascript" src="/web/tablesorter/jquery.tablesorter.js"></script>
		<?php $this->head() ?>
	</head>
	<body>

		<?php $this->beginBody() ?>
		<div class="wrap">
			<?php
			NavBar::begin([
				'brandLabel' => 'My Company',
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => [
					['label' => 'Console', 'url' => ['/console/index']],
					['label' => 'Delayed', 'url' => ['/console/delayed']],
					['label' => 'Recalc Delayed', 'url' => ['/console/recalc']],
					Yii::$app->user->isGuest ?
							['label' => 'Login', 'url' => ['/console/login']] :
							['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']],
				],
			]);
			NavBar::end();

			?>

			<div class="container">
				<?=
				Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				])

				?>
				<?= $content ?>
			</div>
		</div>

		<footer class="footer">
			<div class="container">
				<p class="pull-left">&copy; My Company <?= date('Y') ?></p>
				<p class="pull-right"><?= Yii::powered() ?></p>
			</div>
			<script type="text/javascript">

				jQuery(document).ready(function ($)
				{
					$("#tab").tablesorter();
				}
				);

			</script>
		</footer>

		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>
