<?php namespace DevCatch\InstagramFeed;

use Backend;
use System\Classes\PluginBase;

/**
 * InstagramFeed Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'InstagramFeed',
            'description' => 'No description provided yet...',
            'author' => 'DevCatch',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'DevCatch\InstagramFeed\Components\Feed' => 'feed',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'devcatch.instagramfeed.some_permission' => [
                'tab' => 'InstagramFeed',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'instagramfeed' => [
                'label' => 'InstagramFeed',
                'url' => Backend::url('devcatch/instagramfeed/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['devcatch.instagramfeed.*'],
                'order' => 500,
            ],
        ];
    }
}
