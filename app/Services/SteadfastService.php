<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SteadfastService
{
    public function createOrder($order)
    {
        $response = Http::withHeaders([
            'Api-Key' => env('STEADFAST_API_KEY'),
            'Secret-Key' => env('STEADFAST_SECRET_KEY'),
            'Content-Type' => 'application/json',
        ])->post(env('STEADFAST_BASE_URL') . '/create_order', [

            'invoice' => 'INV-' . $order->id,
            'recipient_name' => $order->name,
            'recipient_phone' => $order->phone,
            'recipient_address' => $order->address,
            'cod_amount' => $order->total_amount,
            'note' => $order->note ?? '',
            'item_description' => 'Order from website',
        ]);

        return $response->json();
    }
}