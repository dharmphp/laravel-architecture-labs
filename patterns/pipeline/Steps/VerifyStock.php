<?php

namespace App\Pipelines\Steps;

use Closure;
use Exception;

class VerifyStock
{
    public function handle($payload, Closure $next)
    {
        foreach ($payload->items as $item) {
            if ($item->product->stock < $item->quantity) {
                throw new Exception("Product {$item->product->name} is out of stock!");
            }
        }
        return $next($payload);
    }
}
