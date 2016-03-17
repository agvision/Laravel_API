<?php 

namespace App\Http\Controllers\API;

use JWTAuth;
use APIException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UsersController extends APIController
{
	/**
	 * Create a new user account.
	 * 
	 * @param \Request $request 
	 * @return \Response
	 */
	public function register(Request $request)
	{	
		$user = new User;
		$user->register($request);

		return $this->respondCreated();
	}

	/**
	 * Retrieve authentication token.
	 * 
	 * @param \Request $request 
	 * @return type
	 */
	public function login(Request $request)
	{
		$user = new User;

		return $this->respond([
			'token' => $user->login($request)
		]);
	}

	/**
	 * Invalidate current token.
	 *
	 * @param \Request $request
	 */
	public function logout(Request $request)
	{
		$user = new User;
		$user->logout($request);

		return $this->respond();
	}

	public function user()
	{
		dd("aici");
	}
} 

 ?>