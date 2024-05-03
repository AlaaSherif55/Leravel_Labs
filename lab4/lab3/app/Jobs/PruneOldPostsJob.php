<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\posts;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PruneOldPostsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Calculate the timestamp for 1 hour ago
        $oneHourAgo = Carbon::now()->subHour();

        // Delete posts older than 1 hour
        posts::where('created_at', '<', $oneHourAgo)->delete();
    }
}
