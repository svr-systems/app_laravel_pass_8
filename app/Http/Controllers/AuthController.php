<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller {
  public function login(Request $req) {
    try {
      if (
        !Auth::attempt([
          'email' => GenController::filter($req->email, 'l'),
          'password' => trim($req->password)
        ])
      ) {
        return $this->apiRsp(422, 'Datos de acceso inválidos', null);
      }

      if (!boolval(Auth::user()->active)) {
        return $this->apiRsp(422, 'Cuenta inactiva', null);
      }

      if (is_null(Auth::user()->email_verified_at)) {
        return $this->apiRsp(422, 'E-mail pendiente de verificación, revisa tu bandeja de entrada', null);
      }

      return $this->apiRsp(
        200,
        'Datos de acceso validos',
        [
          'auth' => [
            'token' => Auth::user()->createToken('authToken')->accessToken,
            'user' => User::getItemAuth(Auth::id())
          ]
        ]
      );
    } catch (Throwable $err) {
      return $this->apiRsp(500, null, $err);
    }
  }

  public function logout(Request $req) {
    try {
      $req->user()->token()->revoke();

      return $this->apiRsp(
        200,
        'Sesión finalizada correctamente'
      );
    } catch (Throwable $err) {
      return $this->apiRsp(500, null, $err);
    }
  }
}
