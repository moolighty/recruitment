<?php
  namespace app\models;
  use yii\base\Model;

  class AddForm extends Model{
      public $name;
      public $company;
      public $city;
      public $min_salary;
      public $max_salary;
      public $url;
      public $technology_comment;

      public function rules(){
          return [
                [['name','company','city','min_salary','max_salary','url','technology_comment'],'required'],
              ];
      }
  }

