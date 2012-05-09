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
		
		//已经移动到wonei扩展
// 		AOP::singleton()
// 			->registerBean(array(
// 					// jointpoint
// 					'org\\opencomb\\coresystem\\namecard\\NameCardExtension::process()' ,
// 					// advice
// 					array('org\\opencomb\\friends\\aspect\\NameCardAspect','process')						
// 			),__FILE__) ;
	}
}