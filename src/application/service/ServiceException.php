<?php
namespace App\infra\persistence\dao;

use Exception;
use Throwable;

/**
 * Servicweクラスで発生する例外を統一して管理するための独自例外
 */
class ServiceException extends Exception {

  /**
   * コンストラクタ
   */
  public function __construct(string $message, ?Throwable $previous = null) {
    parent::__construct($message, $previous);
  }
}
