<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use yii\widgets\ActiveField;
?>
<?php $form =ActiveForm::begin();?>
   <?=$form->field($model,'name')?> 
   <?=$form->field($model,'company')?>
   <?=$form->field($model,'city')?>
   <?=$form->field($model,'min_salary')?>
   <?=$form->field($model,'max_salary')?>
   <?=$form->field($model,'url')?>
   <?=$form->field($model,'technology_comment')->textarea(['rows'=>15 ,])?>
   <div class="form-group">
      <?=Html::submitButton('提交',['class'=> 'btn btn-primary'])?>
   </div>
<?php ActiveForm::end();?>
