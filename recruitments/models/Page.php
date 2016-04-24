<?php
/**
 * Created by PhpStorm.
 * User: hx
 * Date: 4/10/16
 * Time: 3:25 PM
 */

namespace app\models;


class Page
{
	private $pagesize=2;//默认页数记录条目大小
	private $pagenum=0;//总页数
	private $pagecurrent=0;//当前页
	private $recordtotal=0;//总记录数

	const PAGE_PARAMETES="pageParameters";

	private static $page;
	/**
	 * @return int
	 */
	public function getPagesize()
	{
		return $this->pagesize;
	}

	/**
	 * @param int $pagesize
	 */
	public function setPagesize($pagesize)
	{
		$this->pagesize = $pagesize;
	}

	/**
	 * @return int
	 */
	public function getPagenum()
	{
		return $this->pagenum;
	}

	/**
	 * @param int $pagenum
	 */
	public function setPagenum($pagenum)
	{
		$this->pagenum = $pagenum;
	}

	/**
	 * @return int
	 */
	public function getPagecurrent()
	{
		return $this->pagecurrent;
	}

	/**
	 * @param int $pagecurrent
	 */
	public function setPagecurrent($pagecurrent)
	{
		$this->pagecurrent = $pagecurrent;
	}

	/**
	 * @return int
	 */
	public function getRecordtotal()
	{
		return $this->recordtotal;
	}

	/**
	 * @param int $recordtotal
	 */
	public function setRecordtotal($recordtotal)
	{
		$this->recordtotal = $recordtotal;
	}//每页大小


	private function __construct(){}

	public static function getPage(){
		if(!(self::$page instanceof self)){
			self::$page=new Page();
		}
		return self::$page;
	}

	public function setPageParams($recordtotal){
		$this->recordtotal=$recordtotal;
		//注意可能产生小数，一定要转换为整形！
		$this->pagenum=(int)(($recordtotal+$this->pagesize-1)/$this->pagesize);
		$this->pagecurrent=1;
	}

	public function hasRecord(){
		return $this->recordtotal!=0;
	}

	//在web程序中，页面的跳转，分页对象将不一致
	public function setCachePageParameters(){//缓存分页相关信息以便共享
		$arr=[$this->pagecurrent,$this->pagenum,$this->pagesize,$this->recordtotal];
		$cache=\Yii::$app->cache;
		$cache->set(Page::PAGE_PARAMETES,$arr);
	}

	public function getCachePageParameters(){
		$cache=\Yii::$app->cache;
		$arr=$cache->get(Page::PAGE_PARAMETES);
		if(count($arr)==4){//还原分页信息
			$this->pagecurrent=$arr[0];
			$this->pagenum=$arr[1];
			$this->pagesize=$arr[2];
			$this->recordtotal=$arr[3];
		}
	}
}