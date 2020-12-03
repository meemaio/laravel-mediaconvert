<?php

namespace Meema\MediaConvert\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Meema\MediaConvert\Models\MediaConversion;

class ConversionIsProgressing
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;

        if (
            config('media-convert.track_media_conversions')
            && in_array('progressing', config('media-convert.events_to_track'))
        ) {
            MediaConversion::createActivity($message);
        }
    }
}
