<?php


namespace App\Entity\Competitor;


class Teams
{
    const NAME = 'name';
    const ALPHA3 = 'alpha3';

    static array $footballTeams = [
        [
            self::NAME => "FC Bayern Munich",
            self::ALPHA3 => "DEU"
        ],
        [
            self::NAME => "Manchester United F.C.",
            self::ALPHA3 => "GBR",
        ],
        [
            self::NAME => "FC Barcelona",
            self::ALPHA3 => "ESP"
        ],
        [
            self::NAME => "Juventus F.C.",
            self::ALPHA3 => "ITA",
        ],
        [
            self::NAME => "Paris Saint-Germain F.C.",
            self::ALPHA3 => "FRA",
        ],
        [
            self::NAME => "Inter Milan",
            self::ALPHA3 => "ITA"
        ],
        [
            self::NAME => "LA Galaxy",
            self::ALPHA3 => "USA",
        ],
        [
            self::NAME => "GNK Dinamo Zagreb",
            self::ALPHA3 => "HRV",
        ],
        [
            self::NAME => "HNK Hajduk Split",
            self::ALPHA3 => "HRV"
        ],
        [
            self::NAME => "Liverpoll F.C.",
            self::ALPHA3 => "GBR",
        ],
        [
            self::NAME => "Real Madrid C.F.",
            self::ALPHA3 => "ESP",
        ],
        [
            self::NAME => "SK Slavia Prague",
            self::ALPHA3 => "CZE",
        ]
    ];

    static array $basketballTeams = [
        [
            self::NAME => "Los Angeles Lakers",
            self::ALPHA3 => "USA"
        ],
        [
            self::NAME => "Toronto Huskies",
            self::ALPHA3 => "CAN"
        ],
        [
            self::NAME => "Capitanes de Ciudad de Mexico",
            self::ALPHA3 => "MEX"
        ],
        [
            self::NAME => "CSKA Moscow",
            self::ALPHA3 => "RUS"
        ],
        [
            self::NAME => "Olympiacos",
            self::ALPHA3 => "GRC"
        ],
        [
            self::NAME => "Bayern Munich",
            self::ALPHA3 => "DEU"
        ],
        [
            self::NAME => "Galatasaray",
            self::ALPHA3 => "TUR"
        ],
        [
            self::NAME => "KK Cedevita",
            self::ALPHA3 => "HRV"
        ],
        [
            self::NAME => "Andorra",
            self::ALPHA3 => "ESP"
        ],
        [
            self::NAME => "ASVEL",
            self::ALPHA3 => "FRA"
        ],
        [
            self::NAME => "Chicago Bulls",
            self::ALPHA3 => "USA"
        ],
        [
            self::NAME => "Miami Heat",
            self::ALPHA3 => "USA"
        ]
    ];
}