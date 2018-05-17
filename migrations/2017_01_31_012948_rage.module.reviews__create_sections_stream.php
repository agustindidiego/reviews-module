<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class RageModuleReviewsCreateSectionsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'sections',
        'title_column' => 'title',
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
    	'title' => [
		    'translatable' => true,
		    'required'     => true,
		    'unique'       => true,
		    'config'       => [
			    'max' => 50,
		    ],
	    ],
	    'slug'         => [
		    'required' => true,
		    'unique'   => true,
		    'config'   => [
			    'slugify' => 'title',
			    'type'    => '_',
			    'max'     => 50,
		    ],
	    ],
        'addon',
    ];

}
