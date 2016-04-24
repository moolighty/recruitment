<?php
/**
 * User: hx
 * Date: 4/9/16
 * Time: 2:23 PM
 */

namespace app\controllers;

use app\models\Page;
use app\models\SearchJob;
use yii\web\Controller;
use app\models\Job;
use yii\data\ActiveDataProvider;
use app\models\AddForm;
use app\models\UpdateForm;
use yii\web\Request;

class JobController extends  Controller
{
	const PAGE_QUERY_RESULT="page_query_result";
    const MODEL="MODEL";
    const UPDATE_ID='update_form_id';
	public $layout='common';//views/layout/common.php->layout view's name

	//结果缓存
	public static function setQueryCache($query){
		$cache=\Yii::$app->cache;
		$cache->set(JobController::PAGE_QUERY_RESULT,$query);
	}

	public static function getQueryCache(){
		$cache=\Yii::$app->cache;
		$query=$cache->get(JobController::PAGE_QUERY_RESULT);
		return $query;
	}

	public function actionIndex(){
		return $this->render('index');
		//$content(index.php content tranformed to layout view commom.php,saved by $content)
	}

	public function actionAbout(){
		return $this->render('about');
		//$content(index.php content tranformed to layout view commom.php,saved by $content)
	}

    public function actionAdmin(){
        $model=new Job();
        $dataProvider=new ActiveDataProvider(
            [ 'query' => Job::find(), ]
        );

		return $this->render('admin',['model'=>$model, 'dataProvider' =>$dataProvider, ]);
	}

	//对应SearchJob model,对应视图search.php
	public function actionSearch(){
		$model = new Job();
		$query=[];
		$n=0;
		//$model->load is very important to collect datas
		if ($model->load(\Yii::$app->request->post())&& $model->validate()){
			$query=Job::find()->where(['like','name',$model->name])->asArray()->all();
			$n=count($query);
		}
		$page=Page::getPage();
		$page->setPageParams($n);

		$page->setCachePageParameters();
		$this->setQueryCache($query);

		return $this->render('search',
			['model' => $model,'query'=>$query,'page'=>$page]);
			//把model数据转为数组传递过去，这样树图可以通过key，即$model可以访问到job的数据
	}

	public function actionPage(){//翻页
		$model=new Job();
		$model->load(\Yii::$app->request->get());
		$request = \Yii::$app->request;
		$value=$request->get("page");
		$page=Page::getPage();
		$page->getCachePageParameters();
		if($page->hasRecord()){//设置当前页
			$pagecurrent=$page->getPagecurrent();
			if($value==-1){
				$pagecurrent-=1;
				if($pagecurrent<=0)
					$pagecurrent=1;
			}else{
				$pagecurrent+=1;
				if($pagecurrent>$page->getPagenum())
					$pagecurrent=$page->getPagenum();
			}
			$page->setPagecurrent($pagecurrent);
			$page->setCachePageParameters();
		}
		$query=JobController::getQueryCache();

	return $this->render('search',['model'=>$model,'query'=>$query,'page'=>$page]);
	}

    public function actionView()
    {
        $id=$_GET['id'];
        $record=Job::find()->where(['id'=>$id])->asArray()->one();

        return $this->render('view',['record' => $record]);
    }

    public function actionUpdate(){
        $model=new UpdateForm();
        $request=\Yii::$app->request;
        $cache=\Yii::$app->cache;
        if($request->isGet){
           $id=$_GET['id'];
           $cache->set(JobController::UPDATE_ID,$id);//缓存要修改记录id
           $record=Job::find()->where(['id'=>$id])->asArray()->one();
           $model->read($record);
           //print_r($model);
           return $this->render('update',['model' => $model,'record' => $record]);
        }
        if($request->isPost){//从表单收集收据
            //todo something specially
            if($model->load($request->post()) &&$model->validate()){
                $cache_id=$cache->get(JobController::UPDATE_ID);
                if($cache_id==$model['id']){
                    //更新数据即可
                    $record=Job::find()->where(['id'=>$cache_id])->one();
                    $record->name=$model['name'];
                    $record->company=$model['company'];
                    $record->city=$model['city'];
                    $record->min_salary=$model['min_salary'];
                    $record->max_salary=$model['max_salary'];
                    $record->url=$model['url'];
                    $record->technology_comment=$model['technology_comment'];
                    $record->updated_at=date('Y-m-d H:i:s',time());
                    $record->save();
                    return $this->render('update_result',['record'=>$record]);
                }else{
                    //先插入新数据，后删除旧数据
                    $job=new Job();
                    $job->id=$model['id'];
                    $job->saverecord($model);
                    $record_old=Job::find()->where(['id'=>$cache_id])->one();
                    $record_old->delete();
                    $record=Job::find()->where(['id'=>$model['id']])->asArray()->one();
                    return $this->render('update_result',['record'=>$record]); 
                }
            }
        }
    }

    public function actionDelete($id){
        $record=Job::find()->where(['id'=>$id])->one();
        $record->delete();
        return $this->actionAdmin();
    }

    public function actionAdd(){
        $model=new AddForm();
        if($model->load(\Yii::$app->request->post()) &&$model->validate()){
            //显示表单数据或者操作数据，如存入到数据库中
            $job=new Job();
            $job->saverecord($model);
            $record=Job::find()->where(['id'=>$job->id])->asArray()->one();
            return $this->render('add_result',['model' => $model,'record'=>$record ]);
        }else{
            //开始从表单收集数据
            return $this->render('add',['model'=>$model]);
        }
    }
}
