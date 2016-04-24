<?php
/**
 * Created by PhpStorm.
 * User: hx
 * Date: 4/9/16
 * Time: 5:34 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Job extends ActiveRecord
{
//此处不能定义$name,因为会覆盖到自己表中的name字段    
// 	public $name;//工作职位名称
//	public static $fieldNames=['职位id','职位名称：','公司名称','工作城市','薪水下限',
//		                 '薪水上限','公司url','发布时间','技能要求'];

	public function rules()
	{
		return [
			[['name'],'required'],
		];
	}
    
    public static function print_record($record){
			echo "<div>";
			echo "<b>".$record['name']."</b>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "</b><i><a href=".$record['url'].">".$record['company']."</a></i>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<b>".$record['publish_time']."</b>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<b>".$record['city']."</b>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<b>月薪：".($record['min_salary']/1000)."K---".($record['max_salary']/1000)."K"."</b>";
			echo "<br><br>";
			echo  $record['technology_comment'];
			echo "<br><br><br>";
			echo "</div>";
    }

    public function saverecord($model){
        $this->name=$model['name'];
        $this->company=$model['company'];
        $this->city=$model['city'];
        $this->min_salary=$model['min_salary'];
        $this->max_salary=$model['max_salary'];
        $this->url=$model['url'];
        $this->technology_comment=$model['technology_comment'];
        var_dump($this->technology_comment);
        $this->publish_time=date('Y-m-d H:i:s',time());
        $this->validate();
        if($this->hasErrors()){
            echo "data is illegal!";
        }
        $this->save();
    }
}
