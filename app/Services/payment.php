<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class payment
{
    private $request_client;
    private $base_url;
    private $headers;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = 'https://apitest.myfatoorah.com';
        $this->headers = [

            'Authorization' => 'Bearer ' . 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL',
            'Content-Type' => 'application/json'
        ];
    }

    public function send_request($url, $method, $headers, $body = [])
    {

        $request = new \GuzzleHttp\Psr7\Request($method, $url, $headers);
        if (!$body) {

            return false;
        }

        $response = $this->request_client->send($request, [
            'json' => $body
        ]);


        if ($response->getStatusCode() != 200) {

            return false;
        }


        // تحويل الاستجابة إلى تنسيق JSON
        $responseData = json_decode($response->getBody(), true);
        return $responseData;

        // الحصول على قيمة InvoiceURL
        // $invoiceURL = $responseData['Data']['InvoiceURL'];

        // return redirect($invoiceURL);

    }
    public function send_payment($data)
    {
        $responseData = $this->send_request('https://apitest.myfatoorah.com/v2/sendpayment', 'post', $this->headers, $data);
        // $invoiceURL = $responseData['Data']['InvoiceURL'];

        // return redirect($invoiceURL);
        return $responseData;
    }
    public function GetPaymentStatus($id)
    {



        return $this->send_request('https://apitest.myfatoorah.com/v2/GetPaymentStatus', 'post', $this->headers, $id);
    }
}
