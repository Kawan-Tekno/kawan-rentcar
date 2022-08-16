<?php

namespace App\Console\Commands;

use App\Models\CarAppointment;
use Illuminate\Console\Command;

class CarAppointmentClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carappointment:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear pass car appointments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        CarAppointment::whereDate('date_end', '<=', now())
            ->delete();
    }
}
