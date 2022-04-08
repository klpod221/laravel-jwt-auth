<?php

namespace App\Utils;

use App\Exceptions\GeneralException;
use Dingo\Api\Http\Response as HttpStatus;
use Spatie\Fractalistic\ArraySerializer;

class ResponseUtility
{
    /**
     * @param null $data
     * @param string|null $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public static function success($data = null, string $message = null, int $statusCode = HttpStatus::HTTP_OK)
    {
        $response = [
            'status' => config('const.response_success'),
            'data' => $data['data'] ?? $data,
        ];
        if ($data['pagination'] ?? false) {
            $response['pagination'] = $data['pagination'];
        }
        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public static function created(string $message = '')
    {
        return static::success(null, $message, HttpStatus::HTTP_CREATED);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public static function updated(string $message = '')
    {
        return static::success(null, $message, HttpStatus::HTTP_CREATED);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public static function deleted(string $message = '')
    {
        return static::success(null, $message, HttpStatus::HTTP_NO_CONTENT);
    }

    /**
     * @param $data
     * @param null $transformer
     * @return mixed
     */
    public static function data($data, $transformer = null)
    {
        $data = $transformer ? fractal($data, $transformer)->serializeWith(new ArraySerializer())->toArray() : $data;
        return static::success($data);
    }

    /**
     * @param $paginator
     * @param null $transformer
     * @return mixed
     */
    public static function paginate($paginator, $transformer = null)
    {
        return static::success([
            'data' => fractal()->collection($paginator, $transformer)->serializeWith(new ArraySerializer())->toArray(),
            'pagination' => [
                'page' => $paginator->currentPage(),
                'limit' => $paginator->perPage(),
                'total' => $paginator->total(),
                'total_pages' => $paginator->lastPage(),
            ]
        ]);
    }

    /**
     * @param $message
     * @param int $statusCode
     * @param int $errorCode
     */
    public static function error($message = '', $statusCode = HttpStatus::HTTP_BAD_REQUEST, $errorCode = 0)
    {
        throw new GeneralException($message, $errorCode, $statusCode);
    }
}
