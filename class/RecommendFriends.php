<?php
namespace org\opencomb\friends;

use org\jecat\framework\db\sql\Order;
use org\opencomb\coresystem\mvc\controller\Controller;

class RecommendFriends extends Controller
{
/**
 * @example /MVC模式/模型/查询/随机排序
 * 
 */
	public function createBeanConfig()
	{
		return array(
			'title'=>'推荐好友',
			'view:recommendFriends'=>array(
				'template'=>'RecommendFriends.html',
				'class'=>'view',
				'model'=>'users',
			),
			'model:users'=>array(
				'class' => 'model' ,
				'list'=>true,
				'orm'=>array(
					'orderRand'=>Order::rand,   //随机排序
					'table'=>'coresystem:user',
					'limit'=>4,
				)
			),
		);
	}

	public function process()
	{
		$this->users->load();
	}
}
?>