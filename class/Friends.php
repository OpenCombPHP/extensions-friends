<?php 
namespace org\opencomb\friends ;

use org\jecat\framework\lang\aop\AOP;

use org\jecat\framework\ui\xhtml\weave\WeaveManager;

use org\opencomb\platform\ext\Extension ;

class Friends extends Extension 
{
	/**
	 * 载入扩展
	 */
	public function load()
	{
		// AOP 注册
		AOP::singleton()
			->registerBean(array(
					// jointpoint
					'org\\opencomb\\coresystem\\widget\\NameCard::model()' ,
					// advice
					array('org\\opencomb\\friends\\aspect\\NameCardAspect','model')						
			),__CLASS__) ;
	}
}