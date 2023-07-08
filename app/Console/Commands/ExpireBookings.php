<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Carbon\Carbon;

class ExpireBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire pending bookings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredBookings = Transaction::where('status', 'pending')
            ->where('expired_at', '<=', Carbon::now())
            ->get();

        foreach ($expiredBookings as $booking) {
            $booking->status = 'expired';
            $booking->save();
        }

        $this->info('Expired bookings have been updated.');

        return 0;
    }
}
