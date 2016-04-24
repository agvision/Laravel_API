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
	 * Create a new user account
	 * 
	 * @param Request $request 
	 * @return Response
	 */
	public function register(Request $request)
	{	
		$user = new User;
		$user->register($request);

		return $this->respondCreated();
	}

	/**
	 * Retrieve authentication token
	 * 
	 * @param Request $request 
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
	 * Invalidate current token
	 *
	 * @param Request $request
	 */
	public function logout(Request $request)
	{
		$user = new User;
		$user->logout($request);

		return $this->respond();
	}

	/**
	 * Refresh an authentication token
	 * 
	 * @param Request $request 
	 */
	public function refreshToken(Request $request)
	{
		$user = new User;
		
		return $this->respond([
			'token' => $user->refreshToken($request)
		]);
	}

	/**
	 * Get language for current Request
	 * 
	 * @param Request $request 
	 */
	public function getLanguage(Request $request)
	{
		return $this->respond([
			'language' => 'en'
		]);
	}

	/**
	 * Method protected by authentication for testing purpose
	 * 
	 * @param Request $request 
	 */
	public function getProtected(Request $request) 
	{
		return $this->respondAccepted();
	}

	public function user(Request $request)
	{	
		return $this->respond([
			'user' => User::getAuthenticated($request)
		]);
	}
} 

 ?>