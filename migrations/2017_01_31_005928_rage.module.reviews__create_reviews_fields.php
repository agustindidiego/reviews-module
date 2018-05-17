<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class RageModuleReviewsCreateReviewsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
	    'slug' => [
		    'type' => 'anomaly.field_type.slug',
		    'config' => [
			    'type' => '-',
			    'slugify' => 'title',
		    ]
	    ],

    	// Section
	    'title' => 'anomaly.field_type.text',
	    'addon' => [
	    	'type' => 'anomaly.field_type.addon',
	        'config' => [
	        	'type' => 'module',
	            'theme_type' => ''
	        ]
	    ],

        // Section Ratings
	    'section'         => [
		    'type'   => 'anomaly.field_type.relationship',
		    'config' => [
			    'related' => 'Rage\ReviewsModule\Section\SectionModel',
		    ],
	    ],
//	    'title' => 'anomaly.field_type.text',
	    'min'   => 'anomaly.field_type.decimal',
        'max'   => 'anomaly.field_type.decimal',
	    'step'   => 'anomaly.field_type.decimal',

    	// Comments
//	    'section'         => [
//		    'type'   => 'anomaly.field_type.relationship',
//		    'config' => [
//			    'related' => 'Rage\CommentsModule\Section\SectionModel',
//		    ],
//	    ],
	    'parent'     => [
		    'type'   => 'anomaly.field_type.relationship',
		    'config' => [
			    'related' => 'Rage\ReviewsModule\Comment\CommentModel',
			    'mode'    => 'lookup',
		    ],
	    ],
	    'section_entry' => 'anomaly.field_type.polymorphic',
	    'reference' => 'anomaly.field_type.polymorphic',
	    'name' => 'anomaly.field_type.text',
	    'email' => 'anomaly.field_type.email',
	    'ip_address' => 'anomaly.field_type.text',
	    'message' => 'anomaly.field_type.textarea',
	    'approved' => [
		    'type' => 'anomaly.field_type.boolean',
		    'config' => [
			    'default_value' => false,
		    ],
	    ],
	    'poster' => [
		    'type' => 'anomaly.field_type.relationship',
		    'config' => [
			    'mode' => 'lookup',
			    'related' => 'Anomaly\UsersModule\User\UserModel',
		    ],
	    ],
    ];

}
