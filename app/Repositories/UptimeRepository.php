<?php

namespace App\Repositories;

use App\Models\Uptime;

class UptimeRepository
{

        public function getOnline($server, $days = 14)
        {
                return Uptime::where('server', $server)->where('created_at', '>', new \DateTime("$days days ago"))
                        ->select(array(
                            \DB::raw('max(online) AS online'),
                            \DB::raw("DATE_FORMAT(min(created_at), '%d') AS date")
                        ))->groupBy(\DB::raw("UNIX_TIMESTAMP(created_at) DIV 86400"))
                        ->get();
 
        }

        public function getUptimeData($server, $days = 1, $interval = 3600)
        {
                return Uptime::where('server', $server)->where('created_at', '>', new \DateTime("$days days ago"))

                        ->select(array(
                            \DB::raw('min(tps) AS tps'),
                            \DB::raw('max(tick_usage) AS tick_usage'),
                            \DB::raw('max(memory) AS memory'),
                            \DB::raw("DATE_FORMAT(min(created_at), '%H') AS date")
                        ))->groupBy(\DB::raw("UNIX_TIMESTAMP(created_at) DIV $interval"))
                        ->get();
        }

}
