<?php 
namespace App\Exception\Suscriber;

use App\Application\Dto\GeneralResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\SerializerInterface;
use  Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use  App\Exception\ProductFound;
use  App\Exception\ProductNotFound;
use App\Application\Dto\ApiError;

class ApiExceptionSubscriber
{
    private $serializer;
    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $data = new ApiError();
        $data->setCode(500);
        $data->setTrigger(get_class($exception));
        $data->setMessage($exception->getMessage());
        $data->setErrors([$exception->getMessage()]);

        
        if ($exception instanceof \TypeError) {
            $data->setCode(400);
        }

        if ($exception instanceof AccessDeniedHttpException) {
            $data->setCode(401);
        }

        

        if ($exception instanceof \InvalidArgumentException) {
            $data->setCode(400);
        }

        if ($exception instanceof ProductFound) {
            $data->setCode(400);
        }

        if ($exception instanceof ProductNotFound) {
            $data->setCode(404);
        }

        $dataResponse = new GeneralResponse($data);
        $dataResponse->setSucess(false);

        $response= new Response(
            $this->serializer->serialize($dataResponse, 'json'),
            $data->getCode(),
            ['Content-Type' => 'application/json;charset=UTF-8']
        );
        $event->setResponse($response);

    }

}
