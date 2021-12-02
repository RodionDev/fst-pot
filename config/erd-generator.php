<?php
return [
    'directories' => [
        base_path('app'),
    ],
    'ignore' => [
    ],
    'recursive' => true,
    'use_db_schema' => true,
    'use_column_types' => true,
    'table' => [
        'header_background_color' => '#d3d3d3',
        'header_font_color' => '#333333',
        'row_background_color' => '#ffffff',
        'row_font_color' => '#333333',
    ],
    'graph' => [
        'style' => 'filled',
        'bgcolor' => '#FFFFFF',
        'fontsize' => 12,
        'labelloc' => 't',
        'concentrate' => true,
        'splines' => 'polyline',
        'overlap' => false,
        'nodesep' => 1,
        'rankdir' => 'LR',
        'pad' => 0.5,
        'ranksep' => 2,
        'esep' => true,
        'fontname' => 'Nunito',
    ],
    'node' => [
        'margin' => 0,
        'shape' => 'rectangle',
        'fontname' => 'Nunito'
    ],
    'edge' => [
        'color' => '#333333',
        'penwidth' => 1,
        'fontname' => 'Nunito'
    ],
    'relations' => [
        'HasOne' => [
            'dir' => 'both',
            'color' => '#2ECC40',
            'arrowhead' => 'tee',
            'arrowtail' => 'none',
        ],
        'BelongsTo' => [
            'dir' => 'both',
            'color' => '#39CCCC',
            'arrowhead' => 'tee',
            'arrowtail' => 'crow',
        ],
        'HasMany' => [
            'dir' => 'both',
            'color' => '#FF851B',
            'arrowhead' => 'crow',
            'arrowtail' => 'none',
        ],
        'BelongsToMany' => [
            'dir' => 'both',
            'color' => '#F012BE',
            'arrowhead' => 'tee',
            'arrowtail' => 'none',
        ],
    ]
];
