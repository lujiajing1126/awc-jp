<?php
class EdituserModel extends Model{
	protected $tableName = 'user';
	protected $_validate = array(
		array('role', 'require', '用户角色不能为空',1),
);
}