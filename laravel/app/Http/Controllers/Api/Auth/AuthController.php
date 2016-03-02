<?php
/**
 * Created by PhpStorm.
 * User: ash
 * Date: 01/03/2016
 * Time: 17:20
 */

namespace app\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    use Helpers;

    public function postLogin(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials)) {
                throw new UnauthorizedHttpException("Email address / password do not match");
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            throw new HttpException("Unable to login");
        }

        // all good so return the token
        return $this->response->array(compact('token'));
    }

}