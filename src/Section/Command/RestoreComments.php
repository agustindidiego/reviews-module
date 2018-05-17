<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Comment\Contract\CommentRepositoryInterface;
use Rage\ReviewsModule\Section\Contract\SectionInterface;


/**
 * Class RestorePublications
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RestoreComments
{

    /**
     * The publication type instance.
     *
     * @var SectionInterface
     */
    protected $type;

    /**
     * Create a new RestorePublications instance.
     *
     * @param SectionInterface $type
     */
    public function __construct(SectionInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param CommentRepositoryInterface $repository
     */
    public function handle(CommentRepositoryInterface $repository)
    {
        foreach ($this->type->comments()->onlyTrashed()->get() as $model) {
	        $repository->restore($model);
        }
    }
}
