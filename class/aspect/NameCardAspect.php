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
	 * @for pointcutProcess
	 */
	private function process()
	{
		// 调用原始原始函数
		aop_call_origin() ;
		
		if(\org\jecat\framework\auth\IdManager::singleton()->currentId())
		{
		    $aId = \org\jecat\framework\auth\IdManager::singleton()->currentId() ;
		    
		    $aSubscriptionModel = \org\jecat\framework\bean\BeanFactory::singleton()->createBean( $conf=array(
		            'class' => 'model' ,
		            'orm' => array(
		                    'table' => 'friends:subscription' ,
        		            'keys'=>array('from','to'),
		                    'where' => array( '`from` = @1 and `to` = @2' , $aId->userId() , $this->aModel->uid ) ,
		            ) ,
		    ), 'NameCardAspect' ) ;
		    $aSubscriptionModel->load() ;
		    
		    $this->aModel->addChild($aSubscriptionModel,'subscription');
		    $this->view->variables()->set('aModel',$this->aModel) ;
		}
	}
}