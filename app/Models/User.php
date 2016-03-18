<?php

namespace App\Models;

use JWTAuth;
use Exception;
use APIException;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{   
    use Authenticatable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Add a new user into database.
     * 
     * @param \Request $request
     */
    public function register($request)
    {   
        $this->validate($request, [
            'firstName' => 'required|max:255',
            'lastName'  => 'required|max:255',
            'email'     => 'required|email|unique:users,email|max:255',
            'password'  => 'required|max:255'
        ]);

        $this->first_name = $request->input("firstName");
        $this->last_name  = $request->input("lastName");
        $this->email      = $request->input("email");
        $this->password   = bcrypt($request->input("password"));

        $this->save();
    }

    /**
     * Generate a new authentication token
     * 
     * @param \Request $request 
     * @return string
     */
    public function login($request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($token = JWTAuth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            return $token;
        }
        
        throw new APIException("invalidCredentials", HttpResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Invalidate user token.
     *
     * @param  \Request  $request
     */
    public function logout($request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (Exception $e) {
            # If Exceptions are thrown this is ok.
            # It means that token is already invalid.
        }
    }

    /**
     * Try to refresh received token.
     * 
     * @param \Request $request 
     * @return string
     */
    public function refreshToken($request)
    {
        try {
            return JWTAuth::refresh(JWTAuth::getToken());
        } catch (Exception $e) {
            throw new APIException("invalidToken", HttpResponse::HTTP_UNAUTHORIZED);
        }
    }
}
