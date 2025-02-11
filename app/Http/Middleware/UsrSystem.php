<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;

class UsrSystem {
  public function handle(Request $req, Closure $next) {
    if (
      $req->user()->role_id == 1 ||
      $req->user()->role_id == 2 ||
      $req->user()->role_id == 3
    ) {
      return $next($req);
    }

    return (new Controller)->apiRsp(401, 'No tiene permisos para acceder a este recurso');
  }
}
