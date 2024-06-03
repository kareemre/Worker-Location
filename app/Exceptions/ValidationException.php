<?php
namespace App\Exceptions;

use Illuminate\Validation\ValidationException as ResponseValidationException;

class ValidationException extends Handler
{

     /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ResponseValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors(), 'data' => null], 401);
        });
    }
}