<?php
namespace org\opencomb\friends;

use org\jecat\framework\db\DB;

use org\jecat\framework\auth\IdManager;

use org\opencomb\coresystem\mvc\controller\Controller;
use org\jecat\framework\message\Message;

class RecommendFriends extends Controller
{
	public function createBeanConfig()
	{
		return array(
			'title'=>'推荐好友',
			'view:recommendFriends'=>array(
				'template'=>'RecommendFriends.html',
				'class'=>'view',
			),
		);
	}

	public function process()
	{
		$sUidWhere = '';
		if($aCurrentId = IdManager::singleton()->currentId()){
			$sUidWhere.=' WHERE `uid`<>'.$aCurrentId->userId();
		}
		
		$arrUsers = array();
		$aDriver = DB::singleton()->driver(true);
		$aRecordset = $aDriver->query("SELECT * from `coresystem_user` $sUidWhere order by rand() limit 3 ");
		foreach($aRecordset as $arrPurviewRow)
		{
			$arrUsers[] = $arrPurviewRow;
		}
		
		$this->viewRecommendFriends->variables()->set('arrUsers',$arrUsers) ;
	}
}
?>