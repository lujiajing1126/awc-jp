<?php
class AuthCheckBehavior extends Behavior {
	// 行为参数定义
	protected $options   =  array(
			'USER_AUTH_ON'        =>true,   //是否开启用户认证
			'USER_AUTH_ID'        => 'user_id',   //定义用户的id为权限认证字段
			'USER_AUTH_ROLE'        => 'user_role',//定义用户身份
	);
	// 行为扩展的执行入口必须是run
	public function run(&$return){
		if(C('USER_AUTH_ON')) {
			// 进行权限认证逻辑 如果认证通过
			if(empty($_SESSION["awc_uid"])){
				$return = false;
				redirect(U("Auth/index"));
			}
			$return=TRUE;
			// 否则用halt输出错误信息
		}
	}
}