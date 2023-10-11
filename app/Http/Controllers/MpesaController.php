<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{
    //

    /**
     ** @param Request $request The incoming request containing payment data (JSON payload).
     * @return \Illuminate\Http\JsonResponse A JSON response confirming the payment.
     * This function logs the data from the incoming request.
     * 
     */

    public function confirmPayment(Request $request)
    {

        $requestData = $request->getContent();

        $logFilePath = storage_path('logs/confirmation.log');
        file_put_contents($logFilePath, $requestData . PHP_EOL, FILE_APPEND);

        return response()->json(['message' => 'Payment received successfully'], 200);
    }

    /**
     * Handle payment validation.
     *
     * @param Request $request The incoming request containing payment data (JSON payload).
     * @return \Illuminate\Http\JsonResponse A JSON response confirming successful validation.
     *
     * This function logs the payment validation data from the incoming request.
     * 
     */
    public function validatePayment(Request $request)
    {
        
        $requestData = $request->getContent();

        $logFilePath = storage_path('logs/validation.log');

        file_put_contents($logFilePath, $requestData . PHP_EOL, FILE_APPEND);

        return response()->json(['message' => 'Validated successfully'], 200);
    }
}
