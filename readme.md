# API Starter Pack - Laravel PHP Framework

This project provides some basic functionalities for an API server and comes with built-in structure for different kinds of responses.

## Features

* Users Registration
 
```
#!python

POST request to:
http://your.app/auth/registration
```

* Users Authentication
 
```
#!python

POST request to:
http://your.app/auth/login

The response will provide an JWT token.
```

* Token Invalidation
 
```
#!python

POST request to:
http://your.app/auth/logout
```

* Token Refresh
 
```
#!python

GET request to:
http://your.app/auth/refresh-token
```

* Custom Exception Handling
 
```
#!python

Every time when an APIException will be thrown the PHP process will be stopped and the exception will be send as a response. The first paramether of APIException could be both array and string.

Example:
throw new APIException("invalidCredentials", HttpResponse::HTTP_UNAUTHORIZED);
```

* Automatic validation for Models
 
```
#!php

Just describe in your model's method the rules for validation, and if any received data is invalid the Response containing errors will be automatically created and sent to the Client.


Example for User->register():
public function register($request)
{   
    $this->validate($request, [
        'firstName' => 'required|max:255',
        'lastName'  => 'required|max:255',
        'email'     => 'required|email|unique:users,email|max:255',
        'password'  => 'required|max:255'
    ]);

    // the rest of your logic
```