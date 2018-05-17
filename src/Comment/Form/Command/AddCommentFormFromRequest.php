<?php namespace Rage\ReviewsModule\Comment\Form\Command;

use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;
use Rage\ReviewsModule\Comment\Form\CommentFormBuilder;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class AddCommentFormFromRequest
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddCommentFormFromRequest
{

    /**
     * The multiple form builder.
     *
     * @var CommentSectionEntryFormBuilder
     */
    protected $builder;

    /**
     * Create a new AddCommentFormFromRequest instance.
     *
     * @param CommentSectionEntryFormBuilder $builder
     */
    public function __construct(CommentSectionEntryFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param SectionRepositoryInterface $sections
     * @param CommentFormBuilder         $builder
     * @param Request                 $request
     */
    public function handle(SectionRepositoryInterface $sections, CommentFormBuilder $builder, Request $request)
    {
	    $section = $sections->find($request->get('section'));
	    $this->builder->setSection($section);
        $this->builder->addForm('comment', $builder->setSection($section));
    }
}
