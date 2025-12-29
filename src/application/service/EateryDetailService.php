<?php
namespace App\application\service;

use App\infra\persistence\dao\EateryDetailDAO;
use App\application\entity\EateryDetail;
use App\application\form\dto\EateryDetailDTO;
use App\application\service\BaseService;
use App\application\service\ServiceException;

/**
 * レストラン詳細に関する処理を実行するクラス
 */
class EateryDetailService extends BaseService {

	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct(EateryDetailDAO::class);
	}

	/**
	 * レストラン詳細を取得する
	 * @param  $id レストランID
	 * @return レストラン詳細
	 */
	public function getDetail(int $id):EateryDetailDTO {
		try {
			$result = $this->dao->findById($id);
			if ($result === null) {
				throw new NotFoundException();
			}
			$eateryDetail = $this->convertResultToEntity($result);
			$eateryDetailDto = $this->convertEntityToDto($eateryDetail);
			return $eateryDetailDto;
		} catch (DAOException $e) {
			throw new ServiceException("レストラン詳細情報作成に失敗しました\n" . $e->getMessage() , $e);
		}
	}

	/**
	 * 結果セットをentityに変換する
	 * @param  $result 結果セット
	 * @return EateryDetailインスタンス
	 */
	public function convertResultToEntity(array $result):EateryDetail {
		$entity = new EateryDetail(
			id:          $result["id"], 
			areaId:      $result["area_id"],
			areaName:    $result["area_name"], 
			name:        $result["name"], 
			address:     $result["address"], 
			description: $result["description"], 
			image:       $result["image"]
		);
		return $entity;
	}

	/**
	 * entityからDTOに変換する
	 * @param  $entity EateryDetailインスタンス
	 * @return EateryDetailDTOインスタンス
	 */
	private function convertEntityToDto(EateryDetail $entity):EateryDetailDTO {
		$dto = new EateryDetailDTO(
			areaName:    $entity->getAreaName(),
			name:        $entity->getName(),
			address:     $entity->getAddress(),
			description: $entity->getDescription(),
			image:       $entity->getImage()
		);
		return $dto;
	}
}