<?php
class ProjectModel extends Model{
	protected $tableName = "projects";
	protected $_validate = array(
		array('pname','','场次名称已经存在！',0,'unique',1),
		array('expiredate','require','截止日期必须填写！',0,'',1),
		array('expiretime','require','截止时间必须填写！',0,'',1),
	);
}
