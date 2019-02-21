<?php

namespace App\Http\ViewComposers;

use Illuminate\ {
    View\View,
    Support\Facades\Route
};

use App\Models\Server;

class HeaderComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Breadcrumb
        $elements = config ('breadcrumbs');
        $segments = request()->segments();

        foreach ($segments as $segment) {
            if (!is_numeric($segment)) {
                $elements[$segment]['name'] = __('admin.breadcrumbs.' . $elements[$segment]['name'] . '-name');
                if($segment === end($segments)) {
                    $elements[$segment]['url'] = '#';
                }
                $breadcrumbs[] = $elements[$segment];
            }
        }

        // Title
        $title = config('titles.' . Route::currentRouteName());
        $title = __('admin.titles.' . $title);

        // Notifications
        $countNotifications = auth()->user()->unreadNotifications()->count();

        // Servers
        $servers = array();
        foreach (Server::all() as $server) {
            $servers[] = [
                'route' => route('stat', $server->id),
                'command' => $server->port,
                'color' => 'blue'
            ];
        }

        $view->with(compact('breadcrumbs', 'title', 'countNotifications', 'servers'));
    }
}
