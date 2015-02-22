<?php

namespace App\Commands;

use App\Models\Customer;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmailCommand implements SelfHandling, ShouldQueue
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function handle()
    {
        // send mail via Mandrill / SES
    }
}
