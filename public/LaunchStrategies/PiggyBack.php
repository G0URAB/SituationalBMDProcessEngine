<?php

namespace App\LaunchStrategies;

class PiggyBack
{

    const DESCRIPTION =
        "The business is new with no consumer-base and producer-base. Collect consumers and producers by piggybacking on another platform by offering both or one-side an incentive";

    const SCENARIOS =
        [
            1=>"AirBnB collected it's early producers from CraigList",
            2=>"PayPal collected it's early consumers and producers from Ebay by providing incentives to both parties",
            3 => "Youtube attracted a large set of producers from MySpace by providing easy tools to upload videos"
        ];

    const STRATEGIES =
        [
            1=> 'Collect users from Facebook with attractive ads',
            2=> 'Collect producers from EbayKleinAnzeigen by offering them some incentives',
            3=> 'Upload a video in Youtube and direct consumers to your website'
        ];

    public $channels = [];
    public $strategies = [];
}