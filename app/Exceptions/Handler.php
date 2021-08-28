<?php

namespace App\Exceptions;

use App\Notifications\Telegram\ErrorReport;
use App\Traits\ErrorExceptionNotify;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ErrorExceptionNotify;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  Throwable  $e
     * @return void
     *
     * @throws Throwable
     */
    public function report(Throwable $e): void
    {
        $this->errorReport($e);
        parent::report($e);
    }

    protected function errorReport(Throwable $exception)
    {
        if (!$this->shouldntReport($exception) && config('app.env', 'production') == 'production' &&
            !str_starts_with(trim($exception), 'Symfony\Component\Console\Exception\CommandNotFoundException') &&
            !str_starts_with(trim($exception), 'Symfony\Component\Console\Exception\NamespaceNotFoundException')) {

            $this->sendTelegramMessage($exception);
        }
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->JsonErrorResponse('404', 404);
            }
            return null;
        });
    }

    /**
     * Render the given HttpException.
     *
     * @param HttpExceptionInterface $e
     * @return Response
     */
//    protected function renderHttpException(HttpExceptionInterface $e): Response
//    {
//        if ($e instanceof NotFoundHttpException) {
//            if (view()->exists($view = $this->getHttpExceptionView($e))) {
//                return response()->view('errors.404', [
//                    'errors' => new ViewErrorBag,
//                    'exception' => $e,
//                ], $e->getStatusCode(), $e->getHeaders());
//            }
//        }
//
//        return parent::renderHttpException($e);
//    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function JsonErrorResponse(string $message, int $status): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $message,
        ], $status);
    }
}
