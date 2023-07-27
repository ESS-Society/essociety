<?php

return [
    'route' => [
        'prefix' => env('LEAGUEFY_ROUTE_PREFIX', 'api/leaguefy/v1'),
        'middleware' => ['auth:sanctum'],
    ],

    'database' => [
        'connection' => '',

        'tables' => [
            'games' => 'ess_games',
            'teams' => 'ess_teams',
            'tournaments' => 'ess_tournaments',
            'tournaments_teams' => 'ess_tournaments_teams',
            'configs' => 'ess_tournament_configs',
            'stages' => 'ess_stages',
            'stage_parents' => 'ess_stage_parents',
            'matches' => 'ess_matches',
        ],
    ],
];
