<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap" style="background: aquamarine">
	<?php
	NavBar::begin([
		'brandLabel' => 'We Job',
		'brandUrl' => ['/job/index'],
		'options' => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
	]);
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => [
			['label' => '职位搜索', 'url' => ['/job/search']],
			['label' => '职位管理', 'url' => ['/job/admin']],
			['label' => '关于我们', 'url' => ['/job/about']],
			]
	]);
	NavBar::end();
	?>

	<div class="container">
		<?= $content ?>
	</div>

</div>
<footer class="footer" style="background: lightcyan">
	<div class="container" >
		<p class="pull-left">&copy;We Job IT Company <?= date('Y-m-d') ?></p>

		<p class="pull-right">Powered by Moolighty!</p>
	</div>
</footer>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
