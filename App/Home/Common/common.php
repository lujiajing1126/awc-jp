<?php
function secret_password($passwd){
	return md5($passwd);
}