<?php
namespace App\application\service;

use App\application\service\BaseService;

class AuthService extebds BaseService {

	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct(MemberDAO::class);
	}

	public function login():void {
		
	}
	
}