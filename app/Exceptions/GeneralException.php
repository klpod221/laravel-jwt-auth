<?php

namespace App\Exceptions;

use Dingo\Api\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class GeneralException extends HttpException
{
    /**
     * GeneralException constructor.
     * @param null $message
     * @param int $statusCode
     * @param int|null $errorCode
     */
    public function __construct($message = null, int $errorCode = null, int $statusCode = Response::HTTP_BAD_REQUEST)
    {
        if (is_array($message)) {
            $errorCode = $message['code'] ?? null;
            $message = $message['message'] ?? null;
        }

        // Todo: Remove message for production
        parent::__construct($statusCode, $message, null, [], $errorCode);
    }
}
