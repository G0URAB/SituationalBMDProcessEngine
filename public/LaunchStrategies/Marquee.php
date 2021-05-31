<?php

namespace App\LaunchStrategies;

class Marquee
{

    const DESCRIPTION =
        "Marquee users can be consumers or producers whose presence in the platform attracts the other side of users";

    const SCENARIOS =
        [
            1=>"PayPal acquired a lot of consumers with incentives which then attracted consumers to open account with PayPal",
            2=>"Microsoft acquired the HALO franchise which attracted a lot of gamers both on XBOX and PC platform",
            3=>"Youtube attracted inidie band producers from MySpace whose video contents attracted a lot of audience"
        ];

    const STRATEGIES =
        [
            1=> 'Invite a producer who can create values for your business'
        ];

    public $channels = [];
    public $strategies = [];
}