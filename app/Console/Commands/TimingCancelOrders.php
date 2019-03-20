<?php

namespace App\Console\Commands;

use App\Logic\OrderLogic;
use Illuminate\Console\Command;

class TimingCancelOrders extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timing:cancel-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时取消订单';

    /**
     * TimingCancelOrders constructor.
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app()->make(OrderLogic::class)->batchCancelOrder();
    }
}
