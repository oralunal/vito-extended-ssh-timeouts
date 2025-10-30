<?php

namespace App\Vito\Plugins\OralUnal\VitoExtendedSshTimeouts;

use App\Models\User;
use App\Plugins\AbstractPlugin;
use Illuminate\Support\Facades\Config;

class Plugin extends AbstractPlugin
{
    protected string $name = 'Vito Extended SSH Timeouts';

    protected string $description = 'Extends \'ssh\' queue timeout limits in Vito server management to prevent long-running operations from timing out.';

    public function boot(): void
    {
        Config::set('queue.connections.redis.retry_after', 7250);
        Config::set('horizon.defaults.ssh.timeout', 7200);
        Config::set('horizon.defaults.ssh-unique.timeout', 7200);
    }

    public function enable(): void
    {
        exec('cd '.base_path().' && php artisan optimize && php artisan horizon:terminate');
    }

    public function disable(): void
    {
        exec('cd '.base_path().' && php artisan optimize && php artisan horizon:terminate');
    }
}
