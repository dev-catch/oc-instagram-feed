<?php namespace DevCatch\InstagramFeed\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Log;
use Instagram\Storage\CacheManager as InstagramCache;
use Instagram\Api as InstagramApi;

class Feed extends ComponentBase
{
    public $instagram_feed;

    public function componentDetails()
    {
        return [
            'name' => 'Feed Component',
            'description' => "Display a given user's Instagram feed"
        ];
    }

    public function defineProperties()
    {
        return [
            'username' => [
                'title' => 'Instagram Username',
                'type' => 'string'
            ],
            'limit' => [
                'title' => 'Max items',
                'description' => 'The max number of images to load from Instagram',
                'default' => 24,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items property can contain only numeric symbols'
            ]
        ];
    }

    public function onRun()
    {
        $this->instagram_feed = $this->page['instagram_feed'] = $this->loadInstagramFeed();
    }

    protected function loadInstagramFeed()
    {
        $cache = new InstagramCache(storage_path('app/instagramCache'));
        $api = new InstagramApi($cache);
        $api->setUserName($this->property('username'));
        $limit = $this->property('limit');
        $feedArray = [];

        try {
            $feed = $api->getFeed();

            if ($feed->mediaCount <= $limit) {
                return collect($feed->medias);
            }
            else {
                $imagesFetched = 0;

                while ($imagesFetched < $limit) {
                    $imagesFetched += count($feed->medias);
                    $feedArray = array_merge($feedArray, $feed->medias);
                    $endCursor = $feed->getEndCursor();
                    $api->setEndCursor($endCursor);
                    $feed = $api->getFeed();
                }
            }

            return collect($feedArray)->take($limit);
        } catch (\Exception $e) {
            trace_log($e);

            return collect($feedArray);
        }
    }
}
