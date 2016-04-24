<?php
use app\controllers\JobController;
use app\models\Job;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '职位搜索';
?>

<?php $form = ActiveForm::begin(
	[
		'id' => 'search-form',
		'action' => ['search'],
		'options' => ['class' => 'form-horizontal'],
		'layout'=>'inline'//add essentially to show these forms in the same line as following
	]
);
?>

<br>
<div align="center">
<?php
echo $form->field($model, 'name',
	['labelOptions' => ['label' =>          '']])//去掉标签job，否则会输出job
	->textInput([
	'autofocus' => true
	, 'placeholder'=>'请输入您要搜索的职位'
	,'maxlength' => '120'
	,'autocomplete' => 'on',
	'style' => "background: aliceblue",
]);
echo Html::submitButton('搜   索', ['class' => 'btn btn-primary',
	'name' => 'search-button','maxlength' => '60']);
 ActiveForm::end();
?>
<br><br>

</div>
<?php if(count($query)):;?>
<div style="font-size: medium">
	<?php
		$end=$page->getPageCurrent()*$page->getPagesize();
		$begin=$end-$page->getPagesize();
		$max=$page->getRecordtotal();
		$end=$end<=$max?$end:$max;//防止越界，注意
		$arr=null;
		for($i=$begin;$i<$end;$i+=1){
			$arr[$i]=$query[$i];
		}
		foreach($arr as $rowkey=>$record){
			//print_r($record);
            Job::print_record($record);
        }
	?>
</div>
<?php endif;?>

<?php if($page->getRecordtotal()): ?>
<div>
	<footer class="bottom">
		<?php include 'pages.php';?>
	</footer>
</div>
<?php endif;?>
