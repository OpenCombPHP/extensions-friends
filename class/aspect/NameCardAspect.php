<?php
namespace org\opencomb\friends\aspect;

use org\jecat\framework\auth\IdManager;

use org\jecat\framework\mvc\controller\Request;

use org\opencomb\oauth_userstate_adapter\PushState;

use org\jecat\framework\bean\BeanFactory;
use org\jecat\framework\lang\aop\jointpoint\JointPointMethodDefine;

class NameCardAspect
{	
	/**
	 * @advice around
	 * @for pointcutNameCardAspect
	 */
	private function model()
	{
		// 调用原始原始函数
		$model = aop_call_origin() ;
		
		if(IdManager::singleton()->currentId())
		{
		    $aId = IdManager::singleton()->currentId() ;
		    
		    $aModel = \org\jecat\framework\bean\BeanFactory::singleton()->createBean( $conf=array(
		            'class' => 'model' ,
		            'orm' => array(
		                    'table' => 'friends:subscription' ,
        		            'keys'=>array('from','to'),
		                    'where' => array( '`from` = @1 and `to` = @2' , $aId->userId() , $model->uid ) ,
		            ) ,
		    ), 'NameCardAspect' ) ;
		    $aModel->load() ;
		    
		    $model->addChild($aModel,'subscription');
		}
		
		return $model;
	}
}
?>