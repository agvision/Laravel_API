<?php 

namespace App\Listeners;

use APIException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class JWTEventListener { 

    /**
     * Handle token absent event. 
     */ 
    public function onTokenAbsent() {

        throw new APIException("absentToken", HttpResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Handle token absent event. 
     */ 
    public function onTokenExpired() {

        throw new APIException("expiredToken", HttpResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Handle token absent event. 
     */ 
    public function onTokenInvalid() {
        throw new APIException("invalidToken", HttpResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Handle token absent event. 
     */ 
    public function onUserNotFound() {

        throw new APIException("invalidToken", HttpResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Handle user logout events.
     */
    // public function onUserLogout($event) {}
    
    public function subscribe($events)
    {
        $events->listen(
            'tymon.jwt.absent',
            'App\Listeners\JWTEventListener@onTokenAbsent'
        );
    
        $events->listen(
            'tymon.jwt.expired',
            'App\Listeners\JWTEventListener@onTokenExpired'
        );

        $events->listen(
            'tymon.jwt.invalid',
            'App\Listeners\JWTEventListener@onTokenInvalid'
        );

        $events->listen(
            'tymon.jwt.user_not_found',
            'App\Listeners\JWTEventListener@onUserNotFound'
        );
    }
}