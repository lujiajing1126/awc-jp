<?php
class CommonAction extends Action {
	public function _initialize(){
		B('AuthCheck');
	}
}