<?php namespace Rage\ReviewsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class ReviewsModule extends Module
{
    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
//	    'reviews',

	    'sections' => [
		    'buttons' => [
			    'new_section' => [
				    'href'        => 'admin/reviews/sections/create',
			    ],
		    ],
		    'sections' => [
			    'assignments' => [
				    'href'    => 'admin/reviews/sections/assignments/{request.route.parameters.section}',
				    'buttons' => [
					    'assign_fields' => [
						    'data-toggle' => 'modal',
						    'data-target' => '#modal',
						    'href'        => 'admin/reviews/sections/assignments/{request.route.parameters.section}/choose',
					    ],
				    ],
			    ],
		    ],
	    ],

		'fields'       => [
			'buttons' => [
				'new_field' => [
					'data-toggle' => 'modal',
					'data-target' => '#modal',
					'href'        => 'admin/reviews/fields/choose',
				],
			],
		],

	    'comments' => [
		    'buttons' => [
			    'new_comment' => [
				    'data-toggle' => 'modal',
				    'data-target' => '#modal',
				    'href'        => 'admin/reviews/ajax/choose_type',
			    ],
		    ],
	    ],
    ];

	protected $icon = 'dashboard';
}
