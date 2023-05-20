<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Redis;
use App\Repositories\Interfaces\VisitRepository;
use JetBrains\PhpStorm\NoReturn;

class RedisVisitRepository implements VisitRepository
{
    public function incrementVisit($countryCode): void
    {
        Redis::command('INCR', ["visits:$countryCode"]);
    }

    #[NoReturn] public function getStatistics(): array
    {
        $keys = Redis::command('KEYS', ['visits:*']);

        if (empty($keys)) {
            return [];
        }

        $statistics = [];
        $redisPrefix = $this->getRedisPrefix();

        foreach ($keys as $key) {
            if (str_starts_with($key, $redisPrefix)) {
                $key = str_replace($redisPrefix, '', $key);
            }

            $statistics[substr($key, 7)] = (int)Redis::command('GET', [$key]);
        }

        return $statistics;
    }

    private function getRedisPrefix(): string
    {
        return config('database.redis.options.prefix');
    }
}
