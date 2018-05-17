<?php namespace Rage\ReviewsModule\Comment\Form\Command;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;
use Rage\ReviewsModule\Comment\Form\CommentFormBuilder;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class AddCommentFormFromReference
 *
 */
class AddCommentFormFromReference
{

	/**
	 * The multiple form builder.
	 *
	 * @var CommentSectionEntryFormBuilder
	 */
	protected $builder;
	protected $reference;

	/**
	 * Create a new AddCommentFormFromRequest instance.
	 *
	 * @param CommentSectionEntryFormBuilder $builder
	 */
	public function __construct(CommentSectionEntryFormBuilder $builder, EntryInterface $reference)
	{
		$this->builder   = $builder;
		$this->reference = $reference;
	}

	/**
	 * Handle the command.
	 *
	 * @param SectionRepositoryInterface $sections
	 * @param CommentFormBuilder $builder
	 * @param AddonCollection $addons
	 * @param Request $request
	 */
	public function handle(SectionRepositoryInterface $sections, CommentFormBuilder $builder, AddonCollection $addons, Request $request)
	{
//	    $section = $sections->find($this->reference->getId());
		$addon   = $addons->findBySlug($this->reference->getStreamNamespace());
		$section = $sections->findByAddon($addon->getNamespace());

		if ($section) {
//			$builder->setSkips([
//				                   'section',
//				                   'section_entry',
//				                   'reference',
//				                   'approved',
//				                   'poster',
//			                   ]);

			$this->builder->setSection($section);
			$this->builder->addForm('comment', $builder->setSection($section)->setReference($this->reference));
		}

	}
}
