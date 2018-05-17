<?php namespace Rage\ReviewsModule\Comment\Form\Command;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Rage\ReviewsModule\Entry\Form\EntryFormBuilder;
use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class AddSectionEntryFormFromReference
 *
 */
class AddSectionEntryFormFromReference
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var CommentSectionEntryFormBuilder
     */
    protected $builder;

	protected $reference;

    /**
     * Create a new AddSectionEntryFormFromRequest instance.
     *
     * @param CommentSectionEntryFormBuilder $builder
     * @param EntryInterface $reference
     */
    public function __construct(CommentSectionEntryFormBuilder $builder, EntryInterface $reference)
    {
        $this->builder = $builder;
	    $this->reference = $reference;
    }

    /**
     * Handle the command.
     *
     * @param SectionRepositoryInterface $sections
     * @param EntryFormBuilder        $builder
     * @param AddonCollection $addons
     */
    public function handle(SectionRepositoryInterface $sections, EntryFormBuilder $builder, AddonCollection $addons)
    {
//        $section = $sections->find($this->reference->getId());
	    $addon = $addons->findBySlug($this->reference->getStreamNamespace());
	    $section = $sections->findByAddon($addon->getNamespace());

	    if($section)
	    {
		    $this->builder->addForm('entry', $builder->setModel($section->getEntryModelName()));
	    }
    }
}
