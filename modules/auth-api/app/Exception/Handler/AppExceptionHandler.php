<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Constants\StatusCode;
use App\Kernel\ResponseCreater;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{

    /**
     * @var RequestInterface
     */
    protected $request;
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        echo "===========>asd";
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());
        //return ResponseCreater::error($this->request, $response, $throwable->getStatusCode(), $throwable->getMessage(), $throwable->getData());
        return ResponseCreater::error($this->request,$response, StatusCode::ServerError);
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
