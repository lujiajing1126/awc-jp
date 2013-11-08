<?php
class ProjmgrAction extends CommonAction {
	public function __construct() {
		parent::__construct ();
		parent::authAdmin ();
	}
	public function editassn() {
		$ClubsInfo = D ( 'Club' );
		$res = $ClubsInfo->select ();
		$this->assign ( 'list', $res );
		$this->display ( "Proj/editassn" );
	}
	public function editmarks() {
		$ProjsInfo = D ( 'Project' );
		$res = $ProjsInfo->select ();
		$this->assign ( 'list', $res );
		$this->display ( "Proj/editmarks" );
	}
	public function showresult() {
		$this->display ( "Proj/showret" );
	}
	public function editsch() {
		// 获取社团列表
		$ClubsInfo = D ( 'Club' );
		$res3 = $ClubsInfo->select ();
		$this->assign ( 'list3', $res3 );
		// 获取项目列表
		$ProjsInfo2 = D ( 'Project' );
		$res = $ProjsInfo2->select ();
		$this->assign ( 'list2', $res );
		// 获取项目计划表并做关联查询
		$ProjsInfo = D ( 'Schedule' );
		$res2 = $ProjsInfo->relation ( true )->Select ();
		$this->assign ( 'list', $res2 );
		$this->display ( "Proj/editsch" );
	}
	public function edituser() {
		$UsersInfo = D ( 'User' );
		$res = $UsersInfo->select ();
		$this->assign ( 'list', $res );
		$this->display ( "Proj/edituser" );
	}
	public function addproject() {
		// post example:
		// pname=""&expiredate=""&expiretime=""
		$InserRec = D ( "Project" );
		if (! $InserRec->create ()) {
			// 如果创建失败 表示自动验证没有通过 输出错误提示信息
			$ret ["error"] = $InserRec->getError ();
			$this->ajaxReturn ( $ret, 'JSON' );
		} else {
			// 验证通过 进行Insert操作，并返回成功信息
			$InserRec->add ();
			$result = array (
					"res" => "success"
			);
			$this->ajaxReturn ( $result, 'JSON' );
		}
	}
	public function addschedule() {
		// post example:
		// pname=""&aids[]=""&aids[]=""
		$InserRec = D ( "Schedule" );
		$data ['pid'] = $_POST ['pid'];
		$aids = $_POST ['aids'];
		foreach ( $aids as $value ) {
			$data['aid'] = $value;
			if (! $InserRec->create ($data)) {
				// 如果创建失败 表示自动验证没有通过 输出错误提示信息
				$ret ["error"] = $InserRec->getError ();
				$this->ajaxReturn ( $ret, 'JSON' );
			} else {
				// 验证通过 进行Insert操作，并返回成功信息
				$InserRec->data($data)->add();
			}
		}
		$result = array (
				"res" => "success"
		);
		$this->ajaxReturn ( $result, 'JSON' );
	}
}