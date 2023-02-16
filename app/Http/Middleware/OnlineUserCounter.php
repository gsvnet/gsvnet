<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Users\User;
use Closure;
use Illuminate\Contracts\Redis\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * The idea is that there are two sets:
 * gsv_online = {user_id_1, user_id_2, user_id_3}
 * gsv_online_old = {user_id_4, user_id_1}
 * After x minutes, gsv_online_old := gsv_online, and gsv_online := {empty_set}
 * The size of the intersection of gsv_online with gsv_online_old gives the number of online members
 *
 * Class OnlineUserCounter
 */
class OnlineUserCounter
{
    public static $key = 'gsv_online';

    /**
     * @var Database
     */
    protected $redis;

    /**
     * OnlineUserCounter constructor.
     *
     * @param  Database  $redis
     */
    public function __construct(Database $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param $request
     * @param  Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $guard = null): Response
    {
        $user = Auth::guard($guard)->user();

        // Skip over non-members
        if (is_null($user) || ! $user->isMemberOrReunist()) {
            return $next($request);
        }

        $this->informRedis($user);

        return $next($request);
    }

    private function informRedis(User $user)
    {
        $this->redis->command('sadd', [self::$key, $user->id]);
    }
}
