<?php

namespace Rage\ReviewsModule\Comment\Form;


use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormCriteria;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Rage\ReviewsModule\Comment\Form\Command\AddCommentFormFromReference;
use Rage\ReviewsModule\Comment\Form\Command\AddSectionEntryFormFromReference;
use Rage\ReviewsModule\Entry\Form\EntryFormBuilder;
use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Rage\ReviewsModule\Section\SectionRepository;

class CommentSectionEntryFormCriteria extends FormCriteria
{

	use DispatchesJobs;

	protected $builder;
	protected $section;
	protected $reference;

	/**
	 * Set the type.
	 *
	 * @param  SectionInterface $section
	 * @return $this
	 */
	public function setSection(SectionInterface $section)
	{
		$this->parameters['section'] = $section;

		return $this;
	}

	/**
	 * Set the type.
	 *
	 * @param  EntryInterface $reference
	 * @return $this
	 */
	public function setReference(EntryInterface $reference)
	{
		$this->parameters['reference'] = $reference;

		return $this;
	}
}