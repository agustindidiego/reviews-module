<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class RageModuleReviewsCreateCommentsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'comments'
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
    	'parent',
    	'section',
    	'section_entry',
	    'reference',
	    'name',
	    'email',
	    'ip_address',
        'message' => [
        	'required' => true
        ],
        'approved',
        'poster'
    ];

}
