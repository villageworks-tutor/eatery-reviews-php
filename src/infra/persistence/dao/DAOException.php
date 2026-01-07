<?php
namespace App\infra\persistence\dao;

use Exception;
use Throwable;

/**
 * DAOクラスで発生する例外を統一して管理するための独自例外
 */
class DAOException extends Exception {

  /**
   * コンストラクタ
   */
  public function __construct(string $message, ?Throwable $previous = null) {
    parent::__construct($message, $previous);
  }
}
