<?php
namespace App\application\service;
use App\infra\persistence\dao\BaseDao;

/**
 * すべてのサービスクラスが継承する基底サービス
 */
class BaseService {

	/**
	 * フィールド
	 */
	protected BaseDAO $dao;

	/**
	 * コンストラクタ
	 */
	protected function __construct(string $daoClass) {
		$this->dao = new $daoClass();
	}

	/**
	 * DAOを設定する
	 * @param $dao 設定するDAOインスタンス
	 */
	protected function setDao(BaseDAO $dao):void {
		$this->dao = $dao;
	}

}