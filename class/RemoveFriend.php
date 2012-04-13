<?php
namespace org\opencomb\friends;

use org\jecat\framework\db\DB;

use org\jecat\framework\auth\IdManager;

use org\jecat\framework\db\sql\Order;
use org\opencomb\coresystem\mvc\controller\Controller;

class RemoveFriend extends Controller
{
/**
 * @example /MVC模式/模型/查询/随机排序
 * 
 */
	public function createBeanConfig()
	{
		return array(
			'model:friends'=>array(
				'class' => 'model' ,
				'orm'=>array(
					'table'=>'friends:subscription',
                    'keys'=>array('from','to') ,
				)
			),
		);
	}

	public function process()
	{
	    $aId = IdManager::singleton()->currentId() ;
	    
	    $this->friends->loadSql('from = @1 and to = @2' , $aId->userId() , $this->params['uid']);
	    $this->friends->delete();
	}
}