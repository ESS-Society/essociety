<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Leaguefy\LeaguefyManager\Exceptions\LeaguefyManagerApiException;
use Illuminate\Validation\ValidationException;
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

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is(config('leaguefy-admin.route.prefix').'/*')) {
                session()->flash('toastr', collect([
                    'type' => ['warning'],
                    'message' => [$e->getMessage()],
                ]));
            }
        });

        $this->renderable(function (QueryException $e, $request) {
            if ($request->is(config('leaguefy-admin.route.prefix').'/*')) {
                session()->flash('error', collect([
                    'title' => ['Erro na execução da ação'],
                    'message' => ['Tente novamente ou contate o administrador!'],
                ]));
            }
        });

        $this->renderable(function (Throwable $th, Request $request) {
            if ($request->is(config('leaguefy-manager.route.prefix').'/*')) {
                $exception = new LeaguefyManagerApiException($th);

                return response()->json($exception->render(), $exception->getCode());
            }
        });
    }
}
