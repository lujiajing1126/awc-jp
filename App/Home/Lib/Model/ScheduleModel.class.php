<?php
class ScheduleModel extends RelationModel{
	//创建关联模型
	protected $tableName = 'pa';
	protected $_link = array(
			'MyClub'=>array(
					'mapping_type'    =>BELONGS_TO,
					'foreign_key'	=>'aid',
					'class_name'    =>'club',
					'mapping_fields'	=>'name,star,department,type,leader',
					'parent_key'	=>'aid',
					'as_fields' => 'name,star,department,type,leader',
					// 定义更多的关联属性
			),
			'MyProject'=>array(
					'mapping_type'    =>BELONGS_TO,
					'foreign_key'	=>'pid',
					'class_name'    =>'projects',
					'mapping_fields'	=>'pname,expiredate',
					'parent_key'	=>'pid',
					'as_fields' => 'pname,expiredate',
			),
	);
	protected $_validate = array(
		//多字段验证
		array('pid,aid','checkifexist','在该场次中已经存在该社团！',1,'callback',1),
	);
	protected function checkifexist($data){
		$map = $data;
		if($this->where($map)->find())
			return false;
		else
			return TRUE;
	}
}