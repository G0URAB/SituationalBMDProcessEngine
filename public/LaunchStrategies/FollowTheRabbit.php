<?php

namespace App\LaunchStrategies;

class FollowTheRabbit
{

    const DESCRIPTION =
        "The business has already been established in a small market or closed market. 
    Implement a strategy to offer your value propositions to a broader group of participants.";


    const SCENARIOS =
        [
            1=>"Amazon used to sell books only from select producers. Using this strategy, Amazon opened it's service to all the sellers who wants to sell books and maximized its profit",
            2=>"Facebook started with providing service only in the Harvard campus and later opened it's service to general public",
            3 => "Intel improved its business by introducing wireless technology to the world"
        ];

    const STRATEGIES =
    [
        1=> 'Open your market to new consumers',
        2=> 'Open your market to new producers',
        3=> 'Offer an in-house technology with competitive advantage'
    ];

    public $channels = [];
    public $strategies = [];
}