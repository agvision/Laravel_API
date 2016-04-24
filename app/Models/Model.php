<?php 

namespace App\Models;

use Eloquent;
use Response;
use APIException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Model extends Eloquent
{   

    use ValidatesRequests;

    /**
     * Custom validation messages for API errors status
     *
     * @var array
     */
    private $messages = array(
        'required' => 'required   :attribute',
        'email'    => 'invalid    :attribute',
        'min'      => 'tooShort   :attribute',
        'max'      => 'tooLong    :attribute',
        'numeric'  => 'notNumeric :attribute',
        'unique'   => 'duplicated :attribute',
    );

    /**
     * Validate the given request with the given rules
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     */
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {   
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $this->messages, $customAttributes);

        if ($validator->fails()) {
            $errors = $this->formatValidationErrors($validator);

            throw new APIException($errors, HttpResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Format the validation errors to be returned
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return array
     */
    protected function formatValidationErrors(Validator $validator)
    {   
        $errors = $validator->errors()->all();
        $result = array();

        foreach ($errors as $error) {
            $result[] = Str::camel($error);
        }

        return $result;
    }
}