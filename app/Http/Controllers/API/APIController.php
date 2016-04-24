<?php 

namespace App\Http\Controllers\API;

use Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class APIController extends Controller
{	
	/**
	 * @var int
	 */
	protected $statusCode = HttpResponse::HTTP_OK;

	/**
	 * @return int
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param int $statusCode 
	 * @return void
	 */
	public function setStatusCode($statusCode) 
	{
		$this->statusCode = $statusCode;
	}

	/**
	 * @return Response
	 */
	public function respondCreated()
	{
		$this->setStatusCode(HttpResponse::HTTP_CREATED);

		return $this->respond();
	}

	/**
	 * @return Response
	 */
	public function respondAccepted()
	{
		$this->setStatusCode(HttpResponse::HTTP_ACCEPTED);

		return $this->respond();
	}

	/**
	 * Send a success response
	 * 
	 * @param array $data 
	 * @param array $headers 
	 * @return Response
	 */
	public function respond($data = [], $headers = [])
	{
		return Response::json([
			'status' => 'success',
			'data'   => $data
		], $this->getStatusCode(), $headers);
	}
}


 ?>