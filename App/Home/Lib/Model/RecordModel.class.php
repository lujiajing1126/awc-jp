<?php
class RecordModel extends Model{
	protected $tableName = "record";
	protected $_validate = array(
		array('cwgl','number','值必须是数字',0),
	);
	protected $_map = array(
		'xnjl' =>'styxnsthzqk',
		'xwjl' =>'styxwsthzqk',
	);
}