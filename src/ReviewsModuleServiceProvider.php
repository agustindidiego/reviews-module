<?php namespace Rage\ReviewsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentModel;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Rage\ReviewsModule\Comment\CommentModel;
use Rage\ReviewsModule\Comment\Form\CommentFormBuilder;
use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;

class ReviewsModuleServiceProvider extends AddonServiceProvider
{

	protected $plugins = [];

	protected $commands = [];

	protected $routes = [
		'admin/reviews/'                                      => 'Rage\ReviewsModule\Http\Controller\Admin\ReviewsController@index',
		'admin/reviews/sections'                              => 'Rage\ReviewsModule\Http\Controller\Admin\SectionsController@index',
		'admin/reviews/sections/create'                       => 'Rage\ReviewsModule\Http\Controller\Admin\SectionsController@create',
		'admin/reviews/sections/edit/{id}'                    => 'Rage\ReviewsModule\Http\Controller\Admin\SectionsController@edit',
		'admin/reviews/sections/assignments/{section}'           => 'Rage\ReviewsModule\Http\Controller\Admin\AssignmentsController@index',
		'admin/reviews/sections/assignments/{section}/choose'    => 'Rage\ReviewsModule\Http\Controller\Admin\AssignmentsController@choose',
		'admin/reviews/sections/assignments/{section}/create'    => 'Rage\ReviewsModule\Http\Controller\Admin\AssignmentsController@create',
		'admin/reviews/sections/assignments/{section}/edit/{id}' => 'Rage\ReviewsModule\Http\Controller\Admin\AssignmentsController@edit',
		'admin/reviews/fields'                                => 'Rage\ReviewsModule\Http\Controller\Admin\FieldsController@index',
		'admin/reviews/fields/choose'                         => 'Rage\ReviewsModule\Http\Controller\Admin\FieldsController@choose',
		'admin/reviews/fields/create'                         => 'Rage\ReviewsModule\Http\Controller\Admin\FieldsController@create',
		'admin/reviews/fields/edit/{id}'                      => 'Rage\ReviewsModule\Http\Controller\Admin\FieldsController@edit',
		'admin/reviews/ajax/choose_type'                      => 'Rage\ReviewsModule\Http\Controller\Admin\AjaxController@chooseType',
		'admin/reviews/ajax/choose_field/{id}'                => 'Rage\ReviewsModule\Http\Controller\Admin\AjaxController@chooseField',

		'admin/reviews/comments'           => 'Rage\ReviewsModule\Http\Controller\Admin\CommentsController@index',
		'admin/reviews/comments/create'    => 'Rage\ReviewsModule\Http\Controller\Admin\CommentsController@create',
		'admin/reviews/comments/edit/{id}' => 'Rage\ReviewsModule\Http\Controller\Admin\CommentsController@edit',

		'admin/reviews/comments/rates'           => 'Rage\ReviewsModule\Http\Controller\Admin\CommentsRatesController@index',
		'admin/reviews/comments/rates/create'    => 'Rage\ReviewsModule\Http\Controller\Admin\CommentsRatesController@create',
		'admin/reviews/comments/rates/edit/{id}' => 'Rage\ReviewsModule\Http\Controller\Admin\CommentsRatesController@edit',
	];

	protected $middleware = [];

	protected $listeners = [];

	protected $aliases = [];

	protected $bindings = [
		'reviews'                                                            => CommentSectionEntryFormBuilder::class,
		'Anomaly\Streams\Platform\Model\Reviews\ReviewsCommentsEntryModel' => 'Rage\ReviewsModule\Comment\CommentModel',
	];

	protected $providers = [];

	protected $singletons = [
		'Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface' => 'Rage\ReviewsModule\Section\SectionRepository',
		'Rage\ReviewsModule\Comment\Contract\CommentRepositoryInterface' => 'Rage\ReviewsModule\Comment\CommentRepository',
	];

	protected $overrides = [];

	protected $mobile = [];

	public function register(EloquentModel $model)
	{
		$model->bind(
			'reviews',
			function () {
				/* @var EloquentModel $this */
				return $this->morphMany(CommentModel::class, 'reference', 'reference_type')->approved();
			}
		);
		$model->bind(
			'overallRating',
			function () {
				/* @var EloquentModel $this */
				$comments = $this->morphMany(CommentModel::class, 'reference', 'reference_type')->approved()->get();

				$overall = 0;
				$count = 0;
				$value = 0;

				/** @var CommentModel $comment */
				foreach($comments as $comment)
				{
					/** @var AssignmentModel $assignmment */
					foreach($comment->getSectionEntry()->getStream()->getAssignments() as $assignmment)
					{
						$slug = $assignmment->getFieldSlug();
						$value += $comment->getSectionEntry()->{$slug};
						$count++;
					}
				}
				if($count > 0)
				{
					$overall = $value / $count;
				}
				return $overall;
			}
		);
		$model->bind(
			'get_reviews',
			function () {
				/* @var EloquentModel $this */
				return $this->reviews()->get();
			}
		);
	}

	public function map()
	{
	}

}
