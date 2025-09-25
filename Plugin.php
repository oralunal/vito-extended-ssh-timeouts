<?php

namespace App\Vito\Plugins\OralUnal\IncreaseQueueTimeForVito;

use App\Plugins\AbstractPlugin;
use Illuminate\Support\Facades\Config;

class Plugin extends AbstractPlugin
{
    protected string $name = 'Plugin Template';

    protected string $description = 'An example plugin template for vito plugins';

    public function boot(): void
    {
        Config::set('horizon.defaults.ssh.timeout', 2400);
        Config::set('horizon.defaults.ssh.memory', 2048);
        Config::set('horizon.defaults.ssh-unique.timeout', 2400);
        Config::set('horizon.defaults.ssh-unique.memory', 2048);
    }
}
