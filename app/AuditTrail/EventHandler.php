<?php namespace App\AuditTrail;

use App\AuditTrail\Activity\RepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class EventHandler {

    /**
     * @var RepositoryInterface
     */
    private $activity;

    function __construct(RepositoryInterface $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            [
                'agenda.created', 'agenda.updated', 'agenda.deleted',
                'document.created', 'document.updated', 'document.deleted',
                'halaman.created', 'halaman.updated', 'halaman.deleted',
                'posts.created', 'posts.updated', 'posts.removed',
                'media.created', 'media.updated', 'media.removed',
                'album.created', 'album.updated', 'album.deleted',
                'post.created', 'post.updated', 'post.deleted',
                
                
            ],
            'App\AuditTrail\EventHandler@auditTrail'
        );
    }

    public function auditTrail($loggable)
    {
        $user = Auth::user();

        $activity = $this->activity->insert($user, Event::firing(), $loggable);

        if($activity)
        {
            $loggable->setActivityId($activity->id);
            $loggable->postSave();
        }
    }

}