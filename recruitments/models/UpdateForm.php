<?php
  namespace app\models;
  use yii\base\Model;

  class UpdateForm extends Model{
      public $id;
      public $name;
      public $company;
      public $city;
      public $min_salary;
      public $max_salary;
      public $url;
      public $technology_comment;
     //时间字段自动生成
      public function rules(){
          return [
                [['id','name','company','city','min_salary','max_salary','url','technology_comment'],'required'],
              ];
      }

      //读取一行记录
      public function read($record){
          $this->id=$record['id'];
          $this->name=$record['name'];
          $this->company=$record['company'];
          $this->city=$record['city'];
          $this->min_salary=$record['min_salary'];
          $this->max_salary=$record['max_salary'];
          $this->url=$record['url'];
          $this->technology_comment=$record['technology_comment'];
      }
  }
