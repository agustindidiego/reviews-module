<?php namespace Rage\ReviewsModule\Comment\Form\Command;

use Rage\ReviewsModule\Entry\Form\EntryFormBuilder;
use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class AddSectionEntryFormFromRequest
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddSectionEntryFormFromRequest
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var CommentSectionEntryFormBuilder
     */
    protected $builder;

    /**
     * Create a new AddSectionEntryFormFromRequest instance.
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
     * @param EntryFormBuilder        $builder
     * @param Request                 $request
     */
    public function handle(SectionRepositoryInterface $sections, EntryFormBuilder $builder, Request $request)
    {
        $section = $sections->find($request->get('section'));

        $this->builder->addForm('entry', $builder->setModel($section->getEntryModelName()));
    }
}
