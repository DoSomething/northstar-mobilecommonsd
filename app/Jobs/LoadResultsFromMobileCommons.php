<?php

namespace App\Jobs;

use App\Services\MobileCommons;
use Carbon\Carbon;

class LoadResultsFromMobileCommons extends Job
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'mobilecommons';

    /**
     * Beginning of time frame that we're loading.
     *
     * @var Carbon
     */
    protected $start;

    /**
     * End of time frame that we're loading.
     *
     * @var Carbon
     */
    protected $end;

    /**
     * The current page of results.
     *
     * @var int
     */
    protected $page;

    /**
     * Create a new job instance.
     * @param Carbon $start
     * @param Carbon $end
     * @param int $page
     */
    public function __construct(Carbon $start, Carbon $end, $page = 1)
    {
        $this->start = $start;
        $this->end = $end;
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @param MobileCommons $mobileCommons
     */
    public function handle(MobileCommons $mobileCommons)
    {
        $response = $mobileCommons->listAllProfiles($this->start, $this->end, $this->page);
        app('log')->debug('Loaded page from MobileCommons: '.$this->start.' to '.$this->end.' ('.$this->page.')');

        // Transform the returned profiles to arrays & send to Northstar
        foreach ($response->profiles->children() as $key => $profile) {
            dispatch(new SendUserToNorthstar((string) $profile->asXML()));
        }

        // Get the number returned from: <profiles num="x">...</profiles>
        // If the number returned matches the limit, chances are there's another page...
        $numReturned = (int) $response->profiles->attributes()->num;
        if ($numReturned === $mobileCommons->getLimit()) {
            dispatch(new self($this->start, $this->end, $this->page + 1));
        }
    }
}