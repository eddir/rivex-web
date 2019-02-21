<?php

namespace App\Http\Controllers\Back;

use App\ {
    Http\Controllers\Controller,
    Http\Requests\SettingsRequest,
    Repositories\ConfigAppRepository,
    Repositories\EnvRepository,
    Repositories\BugCommentRepository,
    Repositories\OrderRepository,
    Repositories\UptimeRepository,
    Services\PannelAdmin,
    Models\Server
};
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{

    public function __construct(BugCommentRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pannels = [];

        foreach (config('pannels') as $pannel) {

            $panelAdmin = new PannelAdmin($pannel);

            if ($panelAdmin->nbr) {
                $pannels[] = $panelAdmin;
            }
        }

        $bug_comments = $this->repository->getAll(config("app.nbrPages.back.bug_comments"));

        return view('back.index', compact('pannels', 'bug_comments'));
    }

    public function statistics(Server $server, OrderRepository $orderRepository)
    {
        $orders = $orderRepository->getLatest($server->id);
        return view('back.statistics', compact('orders'));
    }

    public function statisticsAjax(Server $server, OrderRepository $orderRepository, UptimeRepository $uptimeRepository)
    {
        $stat = [];

        $online = $uptimeRepository->getOnline($server->port)->toArray();
        $stat['online'] = $this->generateArray($online, 0, 14, 'd', '%d days ago', 'online');

        $system_data = $uptimeRepository->getUptimeData($server->port)->toArray();
        $stat['tps'] = $this->generateArray($system_data, 0, 24, 'H', '%d hours ago', 'tps');
        $stat['tick_usage'] = $this->generateArray($system_data, 1, 24, 'H', '%d hours ago', 'tick_usage');
        $stat['memory'] = $this->generateArray($system_data, 1, 24, 'H', '%d hours ago', 'memory'); 

        $orders = $orderRepository->getLatestDays($server->id)->toArray();
        $stat['orders'] = $this->generateArray($orders, 0, 14, 'd.m', '%d days ago', 'sum');

        return response()->json($stat);
    }

    public function generateArray($data, $min, $max, $format, $time_format, $index)
    {
        $res = [];

        for ($i = $max; $i >= $min; $i--) {
            $date = (new \DateTime(sprintf($time_format, $i)))->format($format);
            $res[$date] = [
                'd' => $date,
                'v' => 0
            ];
        }

        foreach ($data as $val) {
            $res[$val['date']] = [
                 'd' => $val['date'],
                 'v' => $val[$index]
            ];
        }

        return array_values($res);
    }

    /**
     * Show the settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settingsEdit()
    {
        $actualLocale = config ('app.locale');
        $locales = locales();

        $actualDriver = env('MAIL_DRIVER');
        $drivers = [
            'smtp' =>'SMTP',
            'mail' => 'PHP'
        ];

        $actualTimezone = config ('app.timezone');
        $timezones = timezones ();

        $actualCacheDriver = env('CACHE_DRIVER');
        $caches = ['apc', 'array', 'database', 'file', 'memcached', 'redis'];

        $actualConnection = env('DB_CONNECTION');
        $connections = ['mysql', 'sqlite', 'pgsql'];

        return view('back.settings', compact (
            'locales',
            'actualLocale',
            'drivers',
            'actualDriver',
            'timezones',
            'actualTimezone',
            'caches',
            'actualCacheDriver',
            'connections',
            'actualConnection'
        ));
    }

    /**
     * Update settings
     *
     * @param \App\Http\Requests\SettingsRequest $request
     * @param \App\Repositories\ConfigAppRepository $appRepository
     * @param \App\Repositories\EnvRepository $envRepository
     * @return \Illuminate\Http\RedirectResponse
     * @internal param ConfigAppRepository $repository
     */
    public function settingsUpdate(
        SettingsRequest $request,
        ConfigAppRepository $appRepository,
        EnvRepository $envRepository)
    {
        $inputs = $request->except ('_method', '_token', 'page');

        $envRepository->update (array_filter($inputs, function ($key) {
            return strpos ($key, '_');
        }, ARRAY_FILTER_USE_KEY ));

        $appRepository->update(array_filter($inputs, function ($key) {
            return !strpos ($key, '_');
        }, ARRAY_FILTER_USE_KEY ));

        $cache = $this->checkCache () ? ' ' . __('Config cache has been updated.'): '';

        $request->session ()->flash ('ok', __('Settings have been successfully saved. ') . $cache);

        return redirect()->route('settings.edit', ['page' => $request->page]);
    }

    /**
     * Check and refresh cache if exists
     *
     * @return bool
     */
    protected function checkCache ()
    {
        if (file_exists (app()->getCachedConfigPath ())) {
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            return true;
        }
        return false;
    }
}
