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
	 * @pointcut
	 */
	public function pointcutNameCardAspect()
	{
		return array(
			new JointPointMethodDefine('org\\opencomb\\coresystem\\widget\\NameCard','model') ,
		) ;
	}
	
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
		                    'where' => array(
		                            array('eq','from',$aId->userId()) ,
		                            array('eq','to',$model->uid) ,
		                    ) ,
		            ) ,
		    ), 'NameCardAspect' ) ;
		    $aModel->load() ;
		    
		    $model->addChild($aModel,'subscription');
		}
		
		return $model;
	}
}
?>