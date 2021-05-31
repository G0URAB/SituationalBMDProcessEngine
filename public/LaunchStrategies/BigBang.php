<?php

namespace App\LaunchStrategies;

class BigBang
{

    const DESCRIPTION =
        "The business is new with no or less consumer-base and producer-base. To attract users inject a lot of money to always come first in front of audience.
        However this strategy also called a push strategy is not an ideal one and its effectiveness depends on the attractiveness your value-proposition for the customer";

    const SCENARIOS =
        [
            1=>"Twitter spent 11000$ to install giant flat-screen-television in SXSW festival and attracted a lot of users by showing their current twitter-sponsored game status on the television ",
            2=>"Instagram gained thousands of users on the 1st day of it's launch because it spent money to be on the top in Apple's iTunes store"
        ];

    const STRATEGIES =
        [
            1=> 'Invest a money to be on top of Google Ads in your category',
            2=> 'Invest to list your app on top in Google play store or Apple iTunes',
            3=> 'Invest a large sum in Facebook Ads for better impressions',
            4=> 'Run television Ads',
            5=> 'Put your company logo on the jersey of a sports team'
        ];

    public $channels = [];
    public $strategies = [];
}