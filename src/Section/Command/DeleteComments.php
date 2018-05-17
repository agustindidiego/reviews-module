<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Comment\Contract\CommentRepositoryInterface;
use Rage\ReviewsModule\Section\Contract\SectionInterface;


/**
 * Class DeletePublications
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteComments
{

    /**
     * The page type instance.
     *
     * @var SectionInterface
     */
    protected $type;

    /**
     * Create a new DeletePublications instance.
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
        foreach ($this->type->getComments() as $comment) {
	        $repository->delete($comment);
        }
    }
}
