<?php

/*
 * This file is part of paytabs.
 *
 * (c) Walaa Elsaeed <w.elsaeed@paytabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'profile_id'  => env('PAYTABS_PROFILE_ID', 'your_profile_id'),
    'server_key'  => env('PAYTABS_SERVER_KEY', 'your_server_key'),
    'region'      => env('PAYTABS_REGION', 'SAU'),
    'currency'    => env('PAYTABS_CURRENCY', 'SAR'),
];