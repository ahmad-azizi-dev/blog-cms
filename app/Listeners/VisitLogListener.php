<?php

namespace App\Listeners;

use App\Events\VisitLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\If_;
use Stevebauman\Location\Facades\Location;

class VisitLogListener implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';


    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 20;


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param VisitLogEvent $event
     * @return void
     */
    public function handle(VisitLogEvent $event)
    {
        $location = Location::get($event->visit->ip);   // get ip from saved row positions table

        if ($location) {

            $event->visit->countryName = $location->countryName;
            $event->visit->countryCode = Str::lower($location->countryCode);
            $event->visit->regionCode = $location->regionCode;
            $event->visit->regionName = $location->regionName;
            $event->visit->cityName = $location->cityName;
            $event->visit->zipCode = $location->zipCode;
            $event->visit->isoCode = $location->isoCode;
            $event->visit->postalCode = $location->postalCode;
            $event->visit->latitude = $location->latitude;
            $event->visit->longitude = $location->longitude;
            $event->visit->metroCode = $location->metroCode;
            $event->visit->areaCode = $location->areaCode;
            $event->visit->driver = $location->driver;

            // fill other columns of saved row positions table
            $event->visit->save();
        }
    }
}
