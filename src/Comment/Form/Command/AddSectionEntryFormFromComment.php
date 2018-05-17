<?php namespace Rage\ReviewsModule\Comment\Form\Command;

use Rage\ReviewsModule\Entry\Form\EntryFormBuilder;
use Rage\ReviewsModule\Comment\Contract\CommentInterface;
use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddSectionEntryFormFromComment
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddSectionEntryFormFromComment
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
     * Create a new AddSectionEntryFormFromComment instance.
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
     * @param EntryFormBuilder $builder
     */
    public function handle(EntryFormBuilder $builder)
    {
        $section = $this->comment->getSection();

	    $this->builder->setSection($section);
        $builder->setModel($section->getEntryModelName());
        $builder->setEntry($this->comment->getSectionEntryId());

        $this->builder->addForm('entry', $builder);
    }
}
