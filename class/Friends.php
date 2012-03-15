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
		$aWeaveMgr = WeaveManager::singleton() ;
		AOP::singleton()->register('org\\opencomb\\friends\\aspect\\NameCardAspect') ;
	}
}