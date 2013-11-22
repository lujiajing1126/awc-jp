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
		$ProjListInfo = D('Project');
		$res2 = $ProjListInfo->select();
		$this->assign("projlist",$res2);
		$pid = $_GET["_URL_"][2]?$_GET["_URL_"][2]:"1";
		$this->assign("current_pid",$pid);
		$Model = new Model();
		$sql = "SELECT paid,pa.pid,projects.pname,pa.aid,club.`name`,adminrec.total AS `awc_rec`,AVG(record.total) AS `voter_rec` FROM pa
LEFT JOIN club ON pa.aid = club.aid
LEFT JOIN adminrec ON pa.aid = adminrec.aid
LEFT JOIN record ON pa.pid = record.pid AND pa.aid = record.aid
LEFT JOIN projects ON pa.pid = projects.pid
WHERE pa.pid = ".$pid."
GROUP BY paid";
		$res = $Model->query($sql);
		$this->assign ( 'list', $res );
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
			$data ['aid'] = $value;
			if (! $InserRec->create ( $data )) {
				// 如果创建失败 表示自动验证没有通过 输出错误提示信息
				$ret ["error"] = $InserRec->getError ();
				$this->ajaxReturn ( $ret, 'JSON' );
			} else {
				// 验证通过 进行Insert操作，并返回成功信息
				$InserRec->data ( $data )->add ();
			}
		}
		$result = array (
				"res" => "success"
		);
		$this->ajaxReturn ( $result, 'JSON' );
	}
	public function adduser() {
		// post example:
		// username=""&role=""
		$InserRec = D ( "Newuser" );
		$data['username'] = $_POST['username'];
		$data['password'] = md5("123456");
		$data['role'] = $_POST['role'];
		if (! $InserRec->create ($data)) {
			// 如果创建失败 表示自动验证没有通过 输出错误提示信息
			$ret ["error"] = $InserRec->getError ();
			$this->ajaxReturn ( $ret, 'JSON' );
		} else {
			// 验证通过 进行Insert操作，并返回成功信息
			$InserRec->add ();
		}
		$result = array (
				"res" => "success",
				"passwd" => "123456",
		);
		$this->ajaxReturn ( $result, 'JSON' );
	}
	public function showrec() {
		$ProjListInfo = D('Project');
		$res2 = $ProjListInfo->select();
		$this->assign("projlist",$res2);
		$Rec = D ( "Record" );
		$pid = $_GET["_URL_"][2]?$_GET["_URL_"][2]:"1";
		$where = array("pid"=>$pid);
		$res = $Rec->where($where)->select ();
		$this->assign ( 'list', $res );
		$this->display('Proj/showrec');
	}
	public function delrec() {
		$Rec = D ( "Record" );
		if (! $Rec->create ()) {
			$ret ["error"] = $Rec->getError ();
			$this->ajaxReturn ( $ret, 'JSON' );
		} else {
			// 验证通过 进行DELECT操作，并返回成功信息
			$Rec->delete();
			$result = array (
					"res" => "success"
			);
			$this->ajaxReturn ( $result, 'JSON' );
		}
	}
	public function chuser() {
		$Rec = D ( "Edituser" );
		$uid = (int)$_POST['uid'];
		$data['role'] = $_POST['role'];
		if($uid==null || $uid=="")  {
			$ret ["error"] = "评委编号不能为空";
			$this->ajaxReturn ( $ret, 'JSON' );
		}
		$password = $_POST['passwd'];
		if($password!=null && $password!="")  {
			$data['password'] = md5($password);
		}
		if (! $Rec->create ($data)) {
			$ret ["error"] = $Rec->getError ();
			$this->ajaxReturn ( $ret, 'JSON' );
		} else {
			// 验证通过 进行DELECT操作，并返回成功信息
			$Rec->where('uid='.$uid)->save($data);
			$result = array (
					"res" => "success",
					"redirect" =>($_SESSION['awc_uid']==$uid)?1:0,
			);
			if($password!=null && $password!="")  {
				$result["passwd"] = $password;
			}
			$this->ajaxReturn ( $result, 'JSON' );
		}
	}

}