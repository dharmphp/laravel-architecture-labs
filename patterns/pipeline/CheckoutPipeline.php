<?php

namespace App\Pipelines;

use Illuminate\Pipeline\Pipeline;
use App\Pipelines\Steps\VerifyStock;
use App\Pipelines\Steps\ApplyDiscount;
use App\Pipelines\Steps\CalculateTax;
use App\Pipelines\Steps\ChargeCard;

class CheckoutPipeline
{
    protected $pipeline;

    public function __construct(Pipeline $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    public function process(OrderPayload $payload)
    {
        $pipes = [
            VerifyStock::class,
            ApplyDiscount::class,
            CalculateTax::class,
            ChargeCard::class,
        ];

        return $this->pipeline
            ->send($payload)
            ->through($pipes)
            ->then(function ($payload) {
                $payload->order->save();
                return $payload;
            });
    }
}
