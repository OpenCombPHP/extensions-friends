<?php
namespace org\opencomb\friends;

use org\jecat\framework\auth\IdManager;

use org\jecat\framework\db\sql\Order;
use org\opencomb\coresystem\mvc\controller\Controller;

class CreateFriend extends Controller
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
	    
	    $this->friends->setData("from",$aId->userId());
	    $this->friends->setData("to",$this->params['uid']);
		$this->friends->save(true);
	}
}
?>