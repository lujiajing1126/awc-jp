<?php
class AdminCheckBehavior extends Behavior {
	// 行为参数定义
	protected $options   =  array(
			'ADMIN_AUTH_ON'        =>true,   //是否开启用户认证
			'ADMIN_AUTH_ROLE'        => 'admin',//定义用户身份
	);
	// 行为扩展的执行入口必须是run
	public function run(&$return){
		if(C('ADMIN_AUTH_ON')) {
			// 进行权限认证逻辑 如果认证通过
			if(empty($_SESSION["awc_uid"])){
				$return = false;
				redirect(U("Auth/index"));
			}
			if ($_SESSION['roleId'] !== "admin") {
				halt("对不起，您不是管理员！");
			}
			$return=TRUE;
			// 否则用halt输出错误信息
		}
	}
}