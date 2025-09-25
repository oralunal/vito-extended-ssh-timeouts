<?php

namespace App\Vito\Plugins\OralUnal\IncreaseQueueTimeForVito;

use App\Plugins\AbstractPlugin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class Plugin extends AbstractPlugin
{
    protected string $name = 'Increase Queue Time For Vito';

    protected string $description = 'This plugin increases the queue limits for Vito. When working with large databases, this can be useful.';

    public function boot(): void
    {
        Config::set('queue.connections.redis.retry_after', 3050);
        Config::set('horizon.defaults.ssh.timeout', 3000);
    }

    public function enable(): void
    {
        Artisan::call('optimize');
        Artisan::call('horizon:terminate');
    }
}
