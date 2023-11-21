<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $msisdn = $requestData['MSISDN'];
        $hashedMsisdn = Hash::make($msisdn);

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

    public function simulateC2B(Request $request){

        $firstName = $request->input('FirstName');
        $transAmount = $request->input('TransAmount');
        $transID = $request->input('TransID');
        $msisdn = $request->input('MSISDN');

        $response = [
            'TransactionType' => 'Pay Bill',
            'TransID' => $transID ?? 'RKH51ZAOX7',
            'TransTime' => now()->format('YmdHis'),
            'TransAmount' => $transAmount ?? '600.00',
            'BusinessShortCode' => '600954',
            'BillRefNumber' => '0712929959',
            'InvoiceNumber' => '',
            'OrgAccountBalance' => '5873.00',
            'ThirdPartyTransID' => '',
            'MSISDN' => $msisdn ?? '94c392c311d522da950619227b3361752a42042db7e1e699b26e628305c68a88',
            'FirstName' => $firstName ?? 'NICHOLAS',
            'MiddleName' => '',
            'LastName' => ''
        ];

        // Return the simulated response as JSON
    return response()->json($response);

    }
}
