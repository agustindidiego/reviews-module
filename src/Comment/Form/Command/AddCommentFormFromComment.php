<?php namespace Rage\ReviewsModule\Comment\Form\Command;

use RAge\ReviewsModule\Comment\Contract\CommentInterface;
use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;
use Rage\ReviewsModule\Comment\Form\CommentFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddCommentFormFromComment
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddCommentFormFromComment
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var CommentSectionEntryFormBuilder
     */
    protected $builder;

    /**
     * The comment instance.
     *
     * @var CommentInterface
     */
    protected $comment;

    /**
     * Create a new AddCommentFormFromComment instance.
     *
     * @param CommentSectionEntryFormBuilder $builder
     * @param CommentInterface        $comment
     */
    public function __construct(CommentSectionEntryFormBuilder $builder, CommentInterface $comment)
    {
        $this->builder = $builder;
        $this->comment    = $comment;
    }

    /**
     * Handle the command.
     *
     * @param CommentFormBuilder $builder
     */
    public function handle(CommentFormBuilder $builder)
    {
	    $builder->setSection($this->comment->getSection());
        $builder->setEntry($this->comment->getId());

        $this->builder->addForm('comment', $builder);
    }
}
