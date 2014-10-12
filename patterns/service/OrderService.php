<?php

namespace App\Services;

use App\Repositories\OrderRepositoryInterface;
use App\Services\Payment\PaymentGatewayInterface;
use Exception;

class OrderService
{
    protected $orderRepo;
    protected $paymentGateway;

    public function __construct(OrderRepositoryInterface $orderRepo, PaymentGatewayInterface $paymentGateway)
    {
        $this->orderRepo = $orderRepo;
        $this->paymentGateway = $paymentGateway;
    }

    public function placeOrder(array $cartItems, $customerId, $paymentToken)
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $charge = $this->paymentGateway->charge($paymentToken, $total);
        if (!$charge['success']) {
            throw new Exception("Payment failed: " . $charge['error']);
        }

        return $this->orderRepo->create([
            'customer_id' => $customerId,
            'total_amount' => $total,
            'transaction_id' => $charge['transaction_id'],
            'status' => 'paid'
        ]);
    }
}
