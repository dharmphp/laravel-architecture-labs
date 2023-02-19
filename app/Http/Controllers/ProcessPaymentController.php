<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProcessPaymentController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_id' => ['required', 'integer'],
            'payment_method' => ['required', 'string'],
        ]);

        return response()->json([
            'status' => 'success',
            'order_id' => (int) $validated['order_id'],
            'processed_at' => now()->toIso8601String(),
        ]);
    }
}
