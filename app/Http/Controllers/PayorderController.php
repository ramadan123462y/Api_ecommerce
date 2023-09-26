<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\Transaction;
use App\Services\payment;
use Illuminate\Http\Request;

class PayorderController extends Controller
{
    private $payment;
    use ApiResponse;
    public function __construct(payment $fatoorah)
    {
        $this->payment = $fatoorah;

    }

    // payment before save order in data base-------------------

    public function order(Request $request)
    {

        $data = [
            'NotificationOption' => 'Lnk',
            'InvoiceValue'       => $request->InvoiceValue,
            'CustomerName'       => $request->CustomerName,
            'CustomerEmail'      => $request->CustomerEmail,
            'CallBackUrl'        => 'http://127.0.0.1:8000/api/url_back',
            'ErrorUrl'           => 'https://www.google.com/doodles',
            'Language'           => 'en',
            'DisplayCurrencyIso' => 'KWD',
        ];

        return  $this->payment->send_payment($data);
    }
    // get status when back-----------------------not used payment im api use in myfatoraa to redirect

    public function GetPaymentStatus(Request $request)
    {
        $data = [

            'Key'     => $request->paymentId,
            'KeyType' => 'paymentId'
        ];


        return  $this->payment->GetPaymentStatus($data);
    }


    // ------store transection after payment final step------------
    public function store_transection(Request $request)
    {

        Transaction::create([

            'InvoiceId' => $request->InvoiceId,
            'InvoiceStatus' => $request->InvoiceStatus,
            'PaymentGateway' => $request->PaymentGateway,
            'DueValue' => $request->DueValue,
            'order_id' => $request->order_id,
        ]);
        return response([], 200, ["transection paid Sucessfullly"]);
    }
    public function gettransections()
    {

        $transections = Transaction::all();
        return $this->api($transections, 200, []);
    }
    public function getOneTransaction($id)
    {
        if (empty( Transaction::find($id)->id)) {
            return $this->api([], 400, ["transection not found "]);
        }
        $transction =Transaction::find($id);
        return $this->api($transction, 200, []);
    }
}
