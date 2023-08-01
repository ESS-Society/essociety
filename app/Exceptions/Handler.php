<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Leaguefy\LeaguefyAdmin\Exceptions\LeaguefyAdminException;
use Leaguefy\LeaguefyManager\Exceptions\LeaguefyManagerApiException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $th, Request $request) {
            $exception = new Exception($th);

            if ($request->is(config('leaguefy-admin.route.prefix').'/*')) {
                $exception = new LeaguefyAdminException($th);

                return $exception->render($request);
            }

            if ($request->is(config('leaguefy-manager.route.prefix').'/*')) {
                $exception = new LeaguefyManagerApiException($th);

                return $exception->render();
            }

            return $exception;
        });
    }
}
