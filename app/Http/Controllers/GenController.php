<?php

namespace App\Http\Controllers;

class GenController extends Controller {
  public static function filter($v, $type) {
    $v = trim($v);

    switch ($type) {
      case 'id':
        $v = mb_strtolower($v, 'UTF-8');
        $v = $v != '' && $v != 'null' && (int) $v > 0 ? (int) $v : null;
        break;
      case 'U':
        $v = mb_strtoupper($v, 'UTF-8');
        $v = $v == 'NULL' || $v == '' ? null : $v;
        break;
      case 'l':
        $v = mb_strtolower($v, 'UTF-8');
        $v = $v == 'null' || $v == '' ? null : $v;
        break;
      case 'f':
        $v = $v != '' ? (float) $v : 0;
        break;
      case 'i':
        $v = $v != '' ? (int) $v : 0;
        break;
      case 'b':
        $v = mb_strtolower($v, 'UTF-8');
        $v = $v === 'null'
          ? null
          : ($v == '1' || $v == 'true'
            ? true
            : false);
        break;
      case 't':
        $v = mb_strtolower($v, 'UTF-8');
        $v = $v != '' && $v != 'null' && $v != 'undefined' ? $v : null;
        break;
      case 'd':
        $v = mb_strtolower($v, 'UTF-8');
        $v = $v != '' && $v != 'null' && $v != 'undefined' ? $v : null;
        break;
    }

    return $v;
  }

  public static function empty($v) {
    if (empty($v) || mb_strtolower($v, 'UTF-8') == 'null') {
      return true;
    }

    return false;
  }

  public static function trim($v) {
    $v = trim($v);
    return empty($v) ? null : $v;
  }

  public static function valInInterval($val_1, $val_2, $interval) {
    $val_1 = (float) $val_1;
    $val_2 = (float) $val_2;
    $interval = (float) $interval;

    return $val_1 >= ($val_2 - $interval) && $val_1 <= ($val_2 + $interval);
  }

  public static function getFullName($val_1, $val_2, $val_3 = null) {
    return trim(
      $val_1 . ' ' .
      $val_2 . ' ' .
      trim($val_3) . ' '
    );
  }
}
