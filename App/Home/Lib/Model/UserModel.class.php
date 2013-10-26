<?php
class UserModel extends Model{
protected $tableName = 'user';
protected $_validate = array(
		array('username', 'require', '用户名不能为空', 1),
		array('password', 'require', '密码不能为空')
);

public function login($data)
{
	if ( ! $this->create($data))
	{
		return array('error' => $this->getError());
	}

	$where = array('username' => $data['username']);
	$info = $this->where($where)->find();
	if (empty($info))
	{
		return array('error' => '用户不存在');
	}

	if ($info['password'] !== secret_password($data['password']))
	{
		return array('error' => '用户密码有误');
	}

	$_SESSION = array(
			'awc_uid'  => $info['uid'],
			'username' => $info['username'],
			'roleId'   => $info['role'],
	);

	return TRUE;
}
}