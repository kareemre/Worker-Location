<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as ResponseNotFoundHttpException;
class NotFoundHttpException extends Handler

{
    
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ResponseNotFoundHttpException $e) {
            return response()->json(['success' => false, 'message' => 'object not found', 'data' => null], 404);
        });
    }
}