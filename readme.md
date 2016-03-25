# API Starter Pack - Laravel PHP Framework

This project provides some basic functionalities for an API server and comes with built-in structure for different kinds of responses.

## Features

* Built-in Response Structure
 
```
#!php
For a success Response:

{
    status: success,
    data: your-data
}
```


```
#!php
For an error Response:

{
    status: error,
    errors: [errors]
}
```

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

Will send the following response with code 401:

{
    status: error,
    errors: ["invalidCredentials"]
}
```

* Automatic validation for Models
 
```
#!python

Just describe in your model method the rules for validation, and if any received data is invalid the Response containing errors will be automatically created and sent to the Client.


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

The errors are camelcase formatted:

{
    status: error,
    errors: ["requiredFirstName", "invalidEmail"]
}
```

# Installation

1. Clone our repository:
```
#!python
git clone https://mihaicracan@bitbucket.org/agvision/laravel_api.git
```

2. Create the following tabel into your database:

```
#!python

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```
 
 