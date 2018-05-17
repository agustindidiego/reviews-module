<?php namespace Rage\ReviewsModule\Comment\Form;

use Rage\ReviewsModule\Comment\CommentModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class CommentSectionEntryFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CommentSectionEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param CommentSectionEntryFormBuilder $builder
     */
    public function handle(CommentSectionEntryFormBuilder $builder)
    {
        $builder->setSections(
            [
                'ratings'  => [
                	'rows' => [
                		[
			                'columns' => function (CommentSectionEntryFormBuilder $builder) {
				                return array_map(
					                function (FieldType $field) {
						                return [
							                'classes' => ['col-lg-12'],
							                'fields' => ['entry_' . $field->getField()]
						                ];
					                },
					                array_filter(
						                $builder->getFormFields()->base()->all(),
						                function (FieldType $field) {
							                return (!$field->getEntry() instanceof CommentModel);
						                }
					                )
				                );
			                },
		                ],
	                ],
//                    'fields' =>
                ],
                'general' => [
	                'fields' => [
		                'comment_message',
//		                'captcha',
		                'comment_poster',
	                    'comment_name',
	                    'comment_email',
	                    'comment_approved',
	                ],
                ],
//                'seo'     => [
//                    'fields' => [
//                        'comment_meta_title',
//                        'comment_meta_keywords',
//                        'comment_meta_description',
//                    ],
//                ],
//                'options' => [
//                    'fields' => [
//                    	'comment_poster',
//	                    'comment_name',
//	                    'comment_email',
//	                    'comment_approved',
//                    ],
//                ],
            ]
        );
    }
}
