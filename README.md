# Vito Extended SSH Timeouts

A Vito server management plugin that extends 'ssh' queue timeout limits to prevent long-running operations like database backups from failing due to timeout issues.

## Problem

By default, Vito's 'ssh' queue operations have relatively short timeout limit, 600 seconds. This causes issues when running:
- Large database backups
- Long-running maintenance scripts (maybe)
- Extended server operations (maybe)

Workers timeout before these operations can complete, leading to failed tasks, maybe incomplete backups. 

## Solution

This plugin extends the timeout configuration to more generous limits:
- **Redis Queue Retry After**: 3050 seconds (~51 minutes)
- **Horizon 'ssh' Queue Timeout**: 3000 seconds (50 minutes)

## How It Works

The plugin modifies Laravel's configuration at runtime:

```php
Config::set('queue.connections.redis.retry_after', 7250);
Config::set('horizon.defaults.ssh.timeout', 7200);
Config::set('horizon.defaults.ssh-unique.timeout', 7200);
```

When enabled, it runs:

```bash
php artisan optimize && php artisan horizon:terminate
```

This ensures the new timeout values are applied immediately.

## Important Notes

- **Resource Requirements**: Ensure your server can handle 50+ minute operations
- **Monitoring**: Keep an eye on server resources during extended operations
- **Backup Strategy**: This extends timeout but doesn't replace proper backup strategies

## License

MIT License - Feel free to modify and distribute as needed.
