<?php

namespace App\Entity\Country;

abstract class CountryData
{
    const NAME = "name";
    const ALPHA2 = "alpha2";
    const ALPHA3 = "alpha3";

    /**
     * [
     *      Country,
     *      Alpha-2 code,
     *      Alpha-3 code,
     * ]
     */
    const DATA = [
        [
            self::NAME => "Afghanistan",
            self::ALPHA2 => "AF",
            self::ALPHA3 => "AFG"
        ],
        [
            self::NAME => "Albania",
            self::ALPHA2 => "AL",
            self::ALPHA3 => "ALB"
        ],
        [
            self::NAME => "Algeria",
            self::ALPHA2 => "DZ",
            self::ALPHA3 => "DZA"
        ],
        [
            self::NAME => "American Samoa",
            self::ALPHA2 => "AS",
            self::ALPHA3 => "ASM"
        ],
        [
            self::NAME => "Andorra",
            self::ALPHA2 => "AD",
            self::ALPHA3 => "AND"
        ],
        [
            self::NAME => "Angola",
            self::ALPHA2 => "AO",
            self::ALPHA3 => "AGO"
        ],
        [
            self::NAME => "Anguilla",
            self::ALPHA2 => "AI",
            self::ALPHA3 => "AIA"
        ],
        [
            self::NAME => "Antarctica",
            self::ALPHA2 => "AQ",
            self::ALPHA3 => "ATA"
        ],
        [
            self::NAME => "Antigua and Barbuda",
            self::ALPHA2 => "AG",
            self::ALPHA3 => "ATG"
        ],
        [
            self::NAME => "Argentina",
            self::ALPHA2 => "AR",
            self::ALPHA3 => "ARG"
        ],
        [
            self::NAME => "Armenia",
            self::ALPHA2 => "AM",
            self::ALPHA3 => "ARM"
        ],
        [
            self::NAME => "Aruba",
            self::ALPHA2 => "AW",
            self::ALPHA3 => "ABW"
        ],
        [
            self::NAME => "Australia",
            self::ALPHA2 => "AU",
            self::ALPHA3 => "AUS"
        ],
        [
            self::NAME => "Austria",
            self::ALPHA2 => "AT",
            self::ALPHA3 => "AUT"
        ],
        [
            self::NAME => "Azerbaijan",
            self::ALPHA2 => "AZ",
            self::ALPHA3 => "AZE"
        ],
        [
            self::NAME => "Bahamas",
            self::ALPHA2 => "BS",
            self::ALPHA3 => "BHS"
        ],
        [
            self::NAME => "Bahrain",
            self::ALPHA2 => "BH",
            self::ALPHA3 => "BHR"
        ],
        [
            self::NAME => "Bangladesh",
            self::ALPHA2 => "BD",
            self::ALPHA3 => "BGD"
        ],
        [
            self::NAME => "Barbados",
            self::ALPHA2 => "BB",
            self::ALPHA3 => "BRB"
        ],
        [
            self::NAME => "Belarus",
            self::ALPHA2 => "BY",
            self::ALPHA3 => "BLR"
        ],
        [
            self::NAME => "Belgium",
            self::ALPHA2 => "BE",
            self::ALPHA3 => "BEL"
        ],
        [
            self::NAME => "Belize",
            self::ALPHA2 => "BZ",
            self::ALPHA3 => "BLZ"
        ],
        [
            self::NAME => "Benin",
            self::ALPHA2 => "BJ",
            self::ALPHA3 => "BEN"
        ],
        [
            self::NAME => "Bermuda",
            self::ALPHA2 => "BM",
            self::ALPHA3 => "BMU"
        ],
        [
            self::NAME => "Bhutan",
            self::ALPHA2 => "BT",
            self::ALPHA3 => "BTN"
        ],
        [
            self::NAME => "Bolivia, Plurinational State of",
            self::ALPHA2 => "BO",
            self::ALPHA3 => "BOL"
        ],
        [
            self::NAME => "Bolivia",
            self::ALPHA2 => "BO",
            self::ALPHA3 => "BOL"
        ],
        [
            self::NAME => "Bosnia and Herzegovina",
            self::ALPHA2 => "BA",
            self::ALPHA3 => "BIH"
        ],
        [
            self::NAME => "Botswana",
            self::ALPHA2 => "BW",
            self::ALPHA3 => "BWA"
        ],
        [
            self::NAME => "Bouvet Island",
            self::ALPHA2 => "BV",
            self::ALPHA3 => "BVT"
        ],
        [
            self::NAME => "Brazil",
            self::ALPHA2 => "BR",
            self::ALPHA3 => "BRA"
        ],
        [
            self::NAME => "British Indian Ocean Territory",
            self::ALPHA2 => "IO",
            self::ALPHA3 => "IOT"
        ],
        [
            self::NAME => "Brunei Darussalam",
            self::ALPHA2 => "BN",
            self::ALPHA3 => "BRN"
        ],
        [
            self::NAME => "Brunei",
            self::ALPHA2 => "BN",
            self::ALPHA3 => "BRN"
        ],
        [
            self::NAME => "Bulgaria",
            self::ALPHA2 => "BG",
            self::ALPHA3 => "BGR"
        ],
        [
            self::NAME => "Burkina Faso",
            self::ALPHA2 => "BF",
            self::ALPHA3 => "BFA"
        ],
        [
            self::NAME => "Burundi",
            self::ALPHA2 => "BI",
            self::ALPHA3 => "BDI"
        ],
        [
            self::NAME => "Cambodia",
            self::ALPHA2 => "KH",
            self::ALPHA3 => "KHM"
        ],
        [
            self::NAME => "Cameroon",
            self::ALPHA2 => "CM",
            self::ALPHA3 => "CMR"
        ],
        [
            self::NAME => "Canada",
            self::ALPHA2 => "CA",
            self::ALPHA3 => "CAN"
        ],
        [
            self::NAME => "Cape Verde",
            self::ALPHA2 => "CV",
            self::ALPHA3 => "CPV"
        ],
        [
            self::NAME => "Cayman Islands",
            self::ALPHA2 => "KY",
            self::ALPHA3 => "CYM"
        ],
        [
            self::NAME => "Central African Republic",
            self::ALPHA2 => "CF",
            self::ALPHA3 => "CAF"
        ],
        [
            self::NAME => "Chad",
            self::ALPHA2 => "TD",
            self::ALPHA3 => "TCD"
        ],
        [
            self::NAME => "Chile",
            self::ALPHA2 => "CL",
            self::ALPHA3 => "CHL"
        ],
        [
            self::NAME => "China",
            self::ALPHA2 => "CN",
            self::ALPHA3 => "CHN"
        ],
        [
            self::NAME => "Christmas Island",
            self::ALPHA2 => "CX",
            self::ALPHA3 => "CXR"
        ],
        [
            self::NAME => "Cocos (Keeling) Islands",
            self::ALPHA2 => "CC",
            self::ALPHA3 => "CCK"
        ],
        [
            self::NAME => "Colombia",
            self::ALPHA2 => "CO",
            self::ALPHA3 => "COL"
        ],
        [
            self::NAME => "Comoros",
            self::ALPHA2 => "KM",
            self::ALPHA3 => "COM"
        ],
        [
            self::NAME => "Congo",
            self::ALPHA2 => "CG",
            self::ALPHA3 => "COG"
        ],
        [
            self::NAME => "Congo, the Democratic Republic of the",
            self::ALPHA2 => "CD",
            self::ALPHA3 => "COD"
        ],
        [
            self::NAME => "Cook Islands",
            self::ALPHA2 => "CK",
            self::ALPHA3 => "COK"
        ],
        [
            self::NAME => "Costa Rica",
            self::ALPHA2 => "CR",
            self::ALPHA3 => "CRI"
        ],
        [
            self::NAME => "Côte d'Ivoire",
            self::ALPHA2 => "CI",
            self::ALPHA3 => "CIV"
        ],
        [
            self::NAME => "Ivory Coast",
            self::ALPHA2 => "CI",
            self::ALPHA3 => "CIV"
        ],
        [
            self::NAME => "Croatia",
            self::ALPHA2 => "HR",
            self::ALPHA3 => "HRV"
        ],
        [
            self::NAME => "Cuba",
            self::ALPHA2 => "CU",
            self::ALPHA3 => "CUB"
        ],
        [
            self::NAME => "Cyprus",
            self::ALPHA2 => "CY",
            self::ALPHA3 => "CYP"
        ],
        [
            self::NAME => "Czech Republic",
            self::ALPHA2 => "CZ",
            self::ALPHA3 => "CZE"
        ],
        [
            self::NAME => "Denmark",
            self::ALPHA2 => "DK",
            self::ALPHA3 => "DNK"
        ],
        [
            self::NAME => "Djibouti",
            self::ALPHA2 => "DJ",
            self::ALPHA3 => "DJI"
        ],
        [
            self::NAME => "Dominica",
            self::ALPHA2 => "DM",
            self::ALPHA3 => "DMA"
        ],
        [
            self::NAME => "Dominican Republic",
            self::ALPHA2 => "DO",
            self::ALPHA3 => "DOM"
        ],
        [
            self::NAME => "Ecuador",
            self::ALPHA2 => "EC",
            self::ALPHA3 => "ECU"
        ],
        [
            self::NAME => "Egypt",
            self::ALPHA2 => "EG",
            self::ALPHA3 => "EGY"
        ],
        [
            self::NAME => "El Salvador",
            self::ALPHA2 => "SV",
            self::ALPHA3 => "SLV"
        ],
        [
            self::NAME => "Equatorial Guinea",
            self::ALPHA2 => "GQ",
            self::ALPHA3 => "GNQ"
        ],
        [
            self::NAME => "Eritrea",
            self::ALPHA2 => "ER",
            self::ALPHA3 => "ERI"
        ],
        [
            self::NAME => "Estonia",
            self::ALPHA2 => "EE",
            self::ALPHA3 => "EST"
        ],
        [
            self::NAME => "Ethiopia",
            self::ALPHA2 => "ET",
            self::ALPHA3 => "ETH"
        ],
        [
            self::NAME => "Falkland Islands (Malvinas)",
            self::ALPHA2 => "FK",
            self::ALPHA3 => "FLK"
        ],
        [
            self::NAME => "Faroe Islands",
            self::ALPHA2 => "FO",
            self::ALPHA3 => "FRO"
        ],
        [
            self::NAME => "Fiji",
            self::ALPHA2 => "FJ",
            self::ALPHA3 => "FJI"
        ],
        [
            self::NAME => "Finland",
            self::ALPHA2 => "FI",
            self::ALPHA3 => "FIN"
        ],
        [
            self::NAME => "France",
            self::ALPHA2 => "FR",
            self::ALPHA3 => "FRA"
        ],
        [
            self::NAME => "French Guiana",
            self::ALPHA2 => "GF",
            self::ALPHA3 => "GUF"
        ],
        [
            self::NAME => "French Polynesia",
            self::ALPHA2 => "PF",
            self::ALPHA3 => "PYF"
        ],
        [
            self::NAME => "French Southern Territories",
            self::ALPHA2 => "TF",
            self::ALPHA3 => "ATF"
        ],
        [
            self::NAME => "Gabon",
            self::ALPHA2 => "GA",
            self::ALPHA3 => "GAB"
        ],
        [
            self::NAME => "Gambia",
            self::ALPHA2 => "GM",
            self::ALPHA3 => "GMB"
        ],
        [
            self::NAME => "Georgia",
            self::ALPHA2 => "GE",
            self::ALPHA3 => "GEO"
        ],
        [
            self::NAME => "Germany",
            self::ALPHA2 => "DE",
            self::ALPHA3 => "DEU"
        ],
        [
            self::NAME => "Ghana",
            self::ALPHA2 => "GH",
            self::ALPHA3 => "GHA"
        ],
        [
            self::NAME => "Gibraltar",
            self::ALPHA2 => "GI",
            self::ALPHA3 => "GIB"
        ],
        [
            self::NAME => "Greece",
            self::ALPHA2 => "GR",
            self::ALPHA3 => "GRC"
        ],
        [
            self::NAME => "Greenland",
            self::ALPHA2 => "GL",
            self::ALPHA3 => "GRL"
        ],
        [
            self::NAME => "Grenada",
            self::ALPHA2 => "GD",
            self::ALPHA3 => "GRD"
        ],
        [
            self::NAME => "Guadeloupe",
            self::ALPHA2 => "GP",
            self::ALPHA3 => "GLP"
        ],
        [
            self::NAME => "Guam",
            self::ALPHA2 => "GU",
            self::ALPHA3 => "GUM"
        ],
        [
            self::NAME => "Guatemala",
            self::ALPHA2 => "GT",
            self::ALPHA3 => "GTM"
        ],
        [
            self::NAME => "Guernsey",
            self::ALPHA2 => "GG",
            self::ALPHA3 => "GGY"
        ],
        [
            self::NAME => "Guinea",
            self::ALPHA2 => "GN",
            self::ALPHA3 => "GIN"
        ],
        [
            self::NAME => "Guinea-Bissau",
            self::ALPHA2 => "GW",
            self::ALPHA3 => "GNB"
        ],
        [
            self::NAME => "Guyana",
            self::ALPHA2 => "GY",
            self::ALPHA3 => "GUY"
        ],
        [
            self::NAME => "Haiti",
            self::ALPHA2 => "HT",
            self::ALPHA3 => "HTI"
        ],
        [
            self::NAME => "Heard Island and McDonald Islands",
            self::ALPHA2 => "HM",
            self::ALPHA3 => "HMD"
        ],
        [
            self::NAME => "Holy See (Vatican City State)",
            self::ALPHA2 => "VA",
            self::ALPHA3 => "VAT"
        ],
        [
            self::NAME => "Honduras",
            self::ALPHA2 => "HN",
            self::ALPHA3 => "HND"
        ],
        [
            self::NAME => "Hong Kong",
            self::ALPHA2 => "HK",
            self::ALPHA3 => "HKG"
        ],
        [
            self::NAME => "Hungary",
            self::ALPHA2 => "HU",
            self::ALPHA3 => "HUN"
        ],
        [
            self::NAME => "Iceland",
            self::ALPHA2 => "IS",
            self::ALPHA3 => "ISL"
        ],
        [
            self::NAME => "India",
            self::ALPHA2 => "IN",
            self::ALPHA3 => "IND"
        ],
        [
            self::NAME => "Indonesia",
            self::ALPHA2 => "ID",
            self::ALPHA3 => "IDN"
        ],
        [
            self::NAME => "Iran, Islamic Republic of",
            self::ALPHA2 => "IR",
            self::ALPHA3 => "IRN"
        ],
        [
            self::NAME => "Iraq",
            self::ALPHA2 => "IQ",
            self::ALPHA3 => "IRQ"
        ],
        [
            self::NAME => "Ireland",
            self::ALPHA2 => "IE",
            self::ALPHA3 => "IRL"
        ],
        [
            self::NAME => "Isle of Man",
            self::ALPHA2 => "IM",
            self::ALPHA3 => "IMN"
        ],
        [
            self::NAME => "Israel",
            self::ALPHA2 => "IL",
            self::ALPHA3 => "ISR"
        ],
        [
            self::NAME => "Italy",
            self::ALPHA2 => "IT",
            self::ALPHA3 => "ITA"
        ],
        [
            self::NAME => "Jamaica",
            self::ALPHA2 => "JM",
            self::ALPHA3 => "JAM"
        ],
        [
            self::NAME => "Japan",
            self::ALPHA2 => "JP",
            self::ALPHA3 => "JPN"
        ],
        [
            self::NAME => "Jersey",
            self::ALPHA2 => "JE",
            self::ALPHA3 => "JEY"
        ],
        [
            self::NAME => "Jordan",
            self::ALPHA2 => "JO",
            self::ALPHA3 => "JOR"
        ],
        [
            self::NAME => "Kazakhstan",
            self::ALPHA2 => "KZ",
            self::ALPHA3 => "KAZ"
        ],
        [
            self::NAME => "Kenya",
            self::ALPHA2 => "KE",
            self::ALPHA3 => "KEN"
        ],
        [
            self::NAME => "Kiribati",
            self::ALPHA2 => "KI",
            self::ALPHA3 => "KIR"
        ],
        [
            self::NAME => "Korea, Democratic People's Republic of",
            self::ALPHA2 => "KP",
            self::ALPHA3 => "PRK"
        ],
        [
            self::NAME => "Korea, Republic of",
            self::ALPHA2 => "KR",
            self::ALPHA3 => "KOR"
        ],
        [
            self::NAME => "South Korea",
            self::ALPHA2 => "KR",
            self::ALPHA3 => "KOR"
        ],
        [
            self::NAME => "Kuwait",
            self::ALPHA2 => "KW",
            self::ALPHA3 => "KWT"
        ],
        [
            self::NAME => "Kyrgyzstan",
            self::ALPHA2 => "KG",
            self::ALPHA3 => "KGZ"
        ],
        [
            self::NAME => "Lao People's Democratic Republic",
            self::ALPHA2 => "LA",
            self::ALPHA3 => "LAO"
        ],
        [
            self::NAME => "Latvia",
            self::ALPHA2 => "LV",
            self::ALPHA3 => "LVA"
        ],
        [
            self::NAME => "Lebanon",
            self::ALPHA2 => "LB",
            self::ALPHA3 => "LBN"
        ],
        [
            self::NAME => "Lesotho",
            self::ALPHA2 => "LS",
            self::ALPHA3 => "LSO"
        ],
        [
            self::NAME => "Liberia",
            self::ALPHA2 => "LR",
            self::ALPHA3 => "LBR"
        ],
        [
            self::NAME => "Libyan Arab Jamahiriya",
            self::ALPHA2 => "LY",
            self::ALPHA3 => "LBY"
        ],
        [
            self::NAME => "Libya",
            self::ALPHA2 => "LY",
            self::ALPHA3 => "LBY"
        ],
        [
            self::NAME => "Liechtenstein",
            self::ALPHA2 => "LI",
            self::ALPHA3 => "LIE"
        ],
        [
            self::NAME => "Lithuania",
            self::ALPHA2 => "LT",
            self::ALPHA3 => "LTU"
        ],
        [
            self::NAME => "Luxembourg",
            self::ALPHA2 => "LU",
            self::ALPHA3 => "LUX"
        ],
        [
            self::NAME => "Macao",
            self::ALPHA2 => "MO",
            self::ALPHA3 => "MAC"
        ],
        [
            self::NAME => "Macedonia, the former Yugoslav Republic of",
            self::ALPHA2 => "MK",
            self::ALPHA3 => "MKD"
        ],
        [
            self::NAME => "Madagascar",
            self::ALPHA2 => "MG",
            self::ALPHA3 => "MDG"
        ],
        [
            self::NAME => "Malawi",
            self::ALPHA2 => "MW",
            self::ALPHA3 => "MWI"
        ],
        [
            self::NAME => "Malaysia",
            self::ALPHA2 => "MY",
            self::ALPHA3 => "MYS"
        ],
        [
            self::NAME => "Maldives",
            self::ALPHA2 => "MV",
            self::ALPHA3 => "MDV"
        ],
        [
            self::NAME => "Mali",
            self::ALPHA2 => "ML",
            self::ALPHA3 => "MLI"
        ],
        [
            self::NAME => "Malta",
            self::ALPHA2 => "MT",
            self::ALPHA3 => "MLT"
        ],
        [
            self::NAME => "Marshall Islands",
            self::ALPHA2 => "MH",
            self::ALPHA3 => "MHL"
        ],
        [
            self::NAME => "Martinique",
            self::ALPHA2 => "MQ",
            self::ALPHA3 => "MTQ"
        ],
        [
            self::NAME => "Mauritania",
            self::ALPHA2 => "MR",
            self::ALPHA3 => "MRT"
        ],
        [
            self::NAME => "Mauritius",
            self::ALPHA2 => "MU",
            self::ALPHA3 => "MUS"
        ],
        [
            self::NAME => "Mayotte",
            self::ALPHA2 => "YT",
            self::ALPHA3 => "MYT"
        ],
        [
            self::NAME => "Mexico",
            self::ALPHA2 => "MX",
            self::ALPHA3 => "MEX"
        ],
        [
            self::NAME => "Micronesia, Federated States of",
            self::ALPHA2 => "FM",
            self::ALPHA3 => "FSM"
        ],
        [
            self::NAME => "Moldova, Republic of",
            self::ALPHA2 => "MD",
            self::ALPHA3 => "MDA"
        ],
        [
            self::NAME => "Monaco",
            self::ALPHA2 => "MC",
            self::ALPHA3 => "MCO"
        ],
        [
            self::NAME => "Mongolia",
            self::ALPHA2 => "MN",
            self::ALPHA3 => "MNG"
        ],
        [
            self::NAME => "Montenegro",
            self::ALPHA2 => "ME",
            self::ALPHA3 => "MNE"
        ],
        [
            self::NAME => "Montserrat",
            self::ALPHA2 => "MS",
            self::ALPHA3 => "MSR"
        ],
        [
            self::NAME => "Morocco",
            self::ALPHA2 => "MA",
            self::ALPHA3 => "MAR"
        ],
        [
            self::NAME => "Mozambique",
            self::ALPHA2 => "MZ",
            self::ALPHA3 => "MOZ"
        ],
        [
            self::NAME => "Myanmar",
            self::ALPHA2 => "MM",
            self::ALPHA3 => "MMR"
        ],
        [
            self::NAME => "Burma",
            self::ALPHA2 => "MM",
            self::ALPHA3 => "MMR"
        ],
        [
            self::NAME => "Namibia",
            self::ALPHA2 => "NA",
            self::ALPHA3 => "NAM"
        ],
        [
            self::NAME => "Nauru",
            self::ALPHA2 => "NR",
            self::ALPHA3 => "NRU"
        ],
        [
            self::NAME => "Nepal",
            self::ALPHA2 => "NP",
            self::ALPHA3 => "NPL"
        ],
        [
            self::NAME => "Netherlands",
            self::ALPHA2 => "NL",
            self::ALPHA3 => "NLD"
        ],
        [
            self::NAME => "Netherlands Antilles",
            self::ALPHA2 => "AN",
            self::ALPHA3 => "ANT"
        ],
        [
            self::NAME => "New Caledonia",
            self::ALPHA2 => "NC",
            self::ALPHA3 => "NCL"
        ],
        [
            self::NAME => "New Zealand",
            self::ALPHA2 => "NZ",
            self::ALPHA3 => "NZL"
        ],
        [
            self::NAME => "Nicaragua",
            self::ALPHA2 => "NI",
            self::ALPHA3 => "NIC"
        ],
        [
            self::NAME => "Niger",
            self::ALPHA2 => "NE",
            self::ALPHA3 => "NER"
        ],
        [
            self::NAME => "Nigeria",
            self::ALPHA2 => "NG",
            self::ALPHA3 => "NGA"
        ],
        [
            self::NAME => "Niue",
            self::ALPHA2 => "NU",
            self::ALPHA3 => "NIU"
        ],
        [
            self::NAME => "Norfolk Island",
            self::ALPHA2 => "NF",
            self::ALPHA3 => "NFK"
        ],
        [
            self::NAME => "Northern Mariana Islands",
            self::ALPHA2 => "MP",
            self::ALPHA3 => "MNP"
        ],
        [
            self::NAME => "Norway",
            self::ALPHA2 => "NO",
            self::ALPHA3 => "NOR"
        ],
        [
            self::NAME => "Oman",
            self::ALPHA2 => "OM",
            self::ALPHA3 => "OMN"
        ],
        [
            self::NAME => "Pakistan",
            self::ALPHA2 => "PK",
            self::ALPHA3 => "PAK"
        ],
        [
            self::NAME => "Palau",
            self::ALPHA2 => "PW",
            self::ALPHA3 => "PLW"
        ],
        [
            self::NAME => "Palestinian Territory, Occupied",
            self::ALPHA2 => "PS",
            self::ALPHA3 => "PSE"
        ],
        [
            self::NAME => "Panama",
            self::ALPHA2 => "PA",
            self::ALPHA3 => "PAN"
        ],
        [
            self::NAME => "Papua New Guinea",
            self::ALPHA2 => "PG",
            self::ALPHA3 => "PNG"
        ],
        [
            self::NAME => "Paraguay",
            self::ALPHA2 => "PY",
            self::ALPHA3 => "PRY"
        ],
        [
            self::NAME => "Peru",
            self::ALPHA2 => "PE",
            self::ALPHA3 => "PER"
        ],
        [
            self::NAME => "Philippines",
            self::ALPHA2 => "PH",
            self::ALPHA3 => "PHL"
        ],
        [
            self::NAME => "Pitcairn",
            self::ALPHA2 => "PN",
            self::ALPHA3 => "PCN"
        ],
        [
            self::NAME => "Poland",
            self::ALPHA2 => "PL",
            self::ALPHA3 => "POL"
        ],
        [
            self::NAME => "Portugal",
            self::ALPHA2 => "PT",
            self::ALPHA3 => "PRT"
        ],
        [
            self::NAME => "Puerto Rico",
            self::ALPHA2 => "PR",
            self::ALPHA3 => "PRI"
        ],
        [
            self::NAME => "Qatar",
            self::ALPHA2 => "QA",
            self::ALPHA3 => "QAT"
        ],
        [
            self::NAME => "Reunion",
            self::ALPHA2 => "RE",
            self::ALPHA3 => "REU"
        ],
        [
            self::NAME => "Romania",
            self::ALPHA2 => "RO",
            self::ALPHA3 => "ROU"
        ],
        [
            self::NAME => "Russia",
            self::ALPHA2 => "RU",
            self::ALPHA3 => "RUS"
        ],
        [
            self::NAME => "Rwanda",
            self::ALPHA2 => "RW",
            self::ALPHA3 => "RWA"
        ],
        [
            self::NAME => "Saint Helena, Ascension and Tristan da Cunha",
            self::ALPHA2 => "SH",
            self::ALPHA3 => "SHN"
        ],
        [
            self::NAME => "Saint Kitts and Nevis",
            self::ALPHA2 => "KN",
            self::ALPHA3 => "KNA"
        ],
        [
            self::NAME => "Saint Lucia",
            self::ALPHA2 => "LC",
            self::ALPHA3 => "LCA"
        ],
        [
            self::NAME => "Saint Pierre and Miquelon",
            self::ALPHA2 => "PM",
            self::ALPHA3 => "SPM"
        ],
        [
            self::NAME => "Saint Vincent and the Grenadines",
            self::ALPHA2 => "VC",
            self::ALPHA3 => "VCT"
        ],
        [
            self::NAME => "Saint Vincent and the Grenadines",
            self::ALPHA2 => "VC",
            self::ALPHA3 => "VCT"
        ],
        [
            self::NAME => "St. Vincent and the Grenadines",
            self::ALPHA2 => "VC",
            self::ALPHA3 => "VCT"
        ],
        [
            self::NAME => "Sierra Leone",
            self::ALPHA2 => "SL",
            self::ALPHA3 => "SLE"
        ],
        [
            self::NAME => "Slovenia",
            self::ALPHA2 => "SI",
            self::ALPHA3 => "SVN"
        ],
        [
            self::NAME => "Solomon Islands",
            self::ALPHA2 => "SB",
            self::ALPHA3 => "SLB"
        ],
        [
            self::NAME => "Somalia",
            self::ALPHA2 => "SO",
            self::ALPHA3 => "SOM"
        ],
        [
            self::NAME => "South Africa",
            self::ALPHA2 => "ZA",
            self::ALPHA3 => "ZAF"
        ],
        [
            self::NAME => "South Georgia and the South Sandwich Islands",
            self::ALPHA2 => "GS",
            self::ALPHA3 => "SGS"
        ],
        [
            self::NAME => "South Sudan",
            self::ALPHA2 => "SS",
            self::ALPHA3 => "SSD"
        ],
        [
            self::NAME => "Spain",
            self::ALPHA2 => "ES",
            self::ALPHA3 => "ESP"
        ],
        [
            self::NAME => "Sri Lanka",
            self::ALPHA2 => "LK",
            self::ALPHA3 => "LKA"
        ],
        [
            self::NAME => "Sudan",
            self::ALPHA2 => "SD",
            self::ALPHA3 => "SDN"
        ],
        [
            self::NAME => "Suriname",
            self::ALPHA2 => "SR",
            self::ALPHA3 => "SUR"
        ],
        [
            self::NAME => "Svalbard and Jan Mayen",
            self::ALPHA2 => "SJ",
            self::ALPHA3 => "SJM"
        ],
        [
            self::NAME => "Swaziland",
            self::ALPHA2 => "SZ",
            self::ALPHA3 => "SWZ"
        ],
        [
            self::NAME => "Sweden",
            self::ALPHA2 => "SE",
            self::ALPHA3 => "SWE"
        ],
        [
            self::NAME => "Switzerland",
            self::ALPHA2 => "CH",
            self::ALPHA3 => "CHE"
        ],
        [
            self::NAME => "Syrian Arab Republic",
            self::ALPHA2 => "SY",
            self::ALPHA3 => "SYR"
        ],
        [
            self::NAME => "Taiwan, Province of China",
            self::ALPHA2 => "TW",
            self::ALPHA3 => "TWN"
        ],
        [
            self::NAME => "Taiwan",
            self::ALPHA2 => "TW",
            self::ALPHA3 => "TWN"
        ],
        [
            self::NAME => "Tajikistan",
            self::ALPHA2 => "TJ",
            self::ALPHA3 => "TJK"
        ],
        [
            self::NAME => "Tanzania, United Republic of",
            self::ALPHA2 => "TZ",
            self::ALPHA3 => "TZA"
        ],
        [
            self::NAME => "Thailand",
            self::ALPHA2 => "TH",
            self::ALPHA3 => "THA"
        ],
        [
            self::NAME => "Timor-Leste",
            self::ALPHA2 => "TL",
            self::ALPHA3 => "TLS"
        ],
        [
            self::NAME => "Togo",
            self::ALPHA2 => "TG",
            self::ALPHA3 => "TGO"
        ],
        [
            self::NAME => "Tokelau",
            self::ALPHA2 => "TK",
            self::ALPHA3 => "TKL"
        ],
        [
            self::NAME => "Tonga",
            self::ALPHA2 => "TO",
            self::ALPHA3 => "TON"
        ],
        [
            self::NAME => "Trinidad and Tobago",
            self::ALPHA2 => "TT",
            self::ALPHA3 => "TTO"
        ],
        [
            self::NAME => "Tunisia",
            self::ALPHA2 => "TN",
            self::ALPHA3 => "TUN"
        ],
        [
            self::NAME => "Turkey",
            self::ALPHA2 => "TR",
            self::ALPHA3 => "TUR"
        ],
        [
            self::NAME => "Turkmenistan",
            self::ALPHA2 => "TM",
            self::ALPHA3 => "TKM"
        ],
        [
            self::NAME => "Turks and Caicos Islands",
            self::ALPHA2 => "TC",
            self::ALPHA3 => "TCA"
        ],
        [
            self::NAME => "Tuvalu",
            self::ALPHA2 => "TV",
            self::ALPHA3 => "TUV"
        ],
        [
            self::NAME => "Uganda",
            self::ALPHA2 => "UG",
            self::ALPHA3 => "UGA"
        ],
        [
            self::NAME => "Ukraine",
            self::ALPHA2 => "UA",
            self::ALPHA3 => "UKR"
        ],
        [
            self::NAME => "United Arab Emirates",
            self::ALPHA2 => "AE",
            self::ALPHA3 => "ARE"
        ],
        [
            self::NAME => "United Kingdom",
            self::ALPHA2 => "GB",
            self::ALPHA3 => "GBR"
        ],
        [
            self::NAME => "United States",
            self::ALPHA2 => "US",
            self::ALPHA3 => "USA"
        ],
        [
            self::NAME => "United States Minor Outlying Islands",
            self::ALPHA2 => "UM",
            self::ALPHA3 => "UMI"
        ],
        [
            self::NAME => "Uruguay",
            self::ALPHA2 => "UY",
            self::ALPHA3 => "URY"
        ],
        [
            self::NAME => "Uzbekistan",
            self::ALPHA2 => "UZ",
            self::ALPHA3 => "UZB"
        ],
        [
            self::NAME => "Vanuatu",
            self::ALPHA2 => "VU",
            self::ALPHA3 => "VUT"
        ],
        [
            self::NAME => "Venezuela, Bolivarian Republic of",
            self::ALPHA2 => "VE",
            self::ALPHA3 => "VEN"
        ],
        [
            self::NAME => "Venezuela",
            self::ALPHA2 => "VE",
            self::ALPHA3 => "VEN"
        ],
        [
            self::NAME => "Viet Nam",
            self::ALPHA2 => "VN",
            self::ALPHA3 => "VNM"
        ],
        [
            self::NAME => "Vietnam",
            self::ALPHA2 => "VN",
            self::ALPHA3 => "VNM"
        ],
        [
            self::NAME => "Virgin Islands, British",
            self::ALPHA2 => "VG",
            self::ALPHA3 => "VGB"
        ],
        [
            self::NAME => "Virgin Islands, U.S.",
            self::ALPHA2 => "VI",
            self::ALPHA3 => "VIR"
        ],
        [
            self::NAME => "Wallis and Futuna",
            self::ALPHA2 => "WF",
            self::ALPHA3 => "WLF"
        ],
        [
            self::NAME => "Western Sahara",
            self::ALPHA2 => "EH",
            self::ALPHA3 => "ESH"
        ],
        [
            self::NAME => "Yemen",
            self::ALPHA2 => "YE",
            self::ALPHA3 => "YEM"
        ],
        [
            self::NAME => "Zambia",
            self::ALPHA2 => "ZM",
            self::ALPHA3 => "ZMB"
        ],
        [
            self::NAME => "Samoa",
            self::ALPHA2 => "WS",
            self::ALPHA3 => "WSM"
        ],
        [
            self::NAME => "San Marino",
            self::ALPHA2 => "SM",
            self::ALPHA3 => "SMR"
        ],
        [
            self::NAME => "Sao Tome and Principe",
            self::ALPHA2 => "ST",
            self::ALPHA3 => "STP"
        ],
        [
            self::NAME => "Saudi Arabia",
            self::ALPHA2 => "SA",
            self::ALPHA3 => "SAU"
        ],
        [
            self::NAME => "Senegal",
            self::ALPHA2 => "SN",
            self::ALPHA3 => "SEN"
        ],
        [
            self::NAME => "Serbia",
            self::ALPHA2 => "RS",
            self::ALPHA3 => "SRB"
        ],
        [
            self::NAME => "Seychelles",
            self::ALPHA2 => "SC",
            self::ALPHA3 => "SYC"
        ],
        [
            self::NAME => "Singapore",
            self::ALPHA2 => "SG",
            self::ALPHA3 => "SGP"
        ],
        [
            self::NAME => "Slovakia",
            self::ALPHA2 => "SK",
            self::ALPHA3 => "SVK"
        ],

    ];
}
