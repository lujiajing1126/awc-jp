<?php
class NewuserModel extends Model{
	protected $tableName = 'user';
	protected $_validate = array(
			array('username', 'require', '用户名不能重复',1,'unique',1),
			array('password', 'require', '密码不能为空',1),
			array('role','require','角色不能为空',1),
	);
}