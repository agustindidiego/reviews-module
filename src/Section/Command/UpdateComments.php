<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Comment\Contract\CommentInterface;
use Rage\ReviewsModule\Comment\Contract\CommentRepositoryInterface;
use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdatePublications
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdateComments
{

    use DispatchesJobs;

    /**
     * The publication type instance.
     *
     * @var SectionInterface
     */
    protected $type;

    /**
     * Update a new UpdatePublications instance.
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
     * @param SectionRepositoryInterface $types
     * @param CommentRepositoryInterface $repository
     */
    public function handle(SectionRepositoryInterface $types, CommentRepositoryInterface $repository)
    {
        /* @var SectionInterface $type */
        $type = $types->find($this->type->getId());

        /* @var CommentInterface $model */
        foreach ($type->getComments() as $model) {
	        $repository->save($model->setAttribute('entry_type', $this->type->getEntryModelName()));
        }
    }
}
