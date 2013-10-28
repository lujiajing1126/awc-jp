<?php
class AwcmarkAction extends CommonAction {
	public function __construct() {
		parent::__construct();
		parent::authAdmin();
	}

	public function index() {
		$this->display("Mark/index");
	}
}