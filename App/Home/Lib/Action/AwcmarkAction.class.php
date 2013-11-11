<?php
class AwcmarkAction extends CommonAction {
	public function __construct() {
		parent::__construct();
		parent::authAdmin();
	}

	public function index() {
		$ClubListInfo = D('Club');
		$res2 = $ClubListInfo->select();
		$this->assign("list",$res2);
		//$pid = $_GET["_URL_"][2]?$_GET["_URL_"][2]:"1";
		//$ClubsInfo = D('Schedule');
		//$res = $ClubsInfo->where('pid='.$pid)->relation(true)->Select();
		$this->display("Awcmark/index");
	}
	public function getScore(){
		$aid = $_GET["_URL_"][2];
		$uid = $_SESSION["awc_uid"];
		$record = D('Adminrecord');
		$data  = array(
				'aid'	=>$aid,
		);
		$res = $record->where($data)->select();
		$this->ajaxReturn($res,'JSON');
	}
	public function addAdminScore(){
		//postexample:
		//aid=FD-H-USS-GJ002&
		//dxtshd=&xxhd=&cghd=&njsc=&cxda=&cwcwfzr=&cwcwfb=&njsczm=&wlxxh=&szdh=
		//&szsl=&qtbmhz=&tshdcg=&pjdbh=&qxdy=&fgbmpf=&szpf=
		$InserRec = D("Adminrecord");
		if (!$InserRec->create()){
			// 如果创建失败 表示自动验证没有通过 输出错误提示信息
			$this->ajaxReturn($InserRec->getError(),'JSON');
		}else{
			// 验证通过 进行Insert操作，并返回成功信息
			$InserRec->add();
			$result = array("res"=>"success");
			$this->ajaxReturn($result,'JSON');
		}
	}
}