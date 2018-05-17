<?php namespace Rage\ReviewsModule\Comment\Form;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Rage\ReviewsModule\Comment\Form\Command\AddCommentFormFromReference;
use Rage\ReviewsModule\Comment\Form\Command\AddSectionEntryFormFromReference;
use Rage\ReviewsModule\Entry\Form\EntryFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;

/**
 * Class CommentSectionEntryFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CommentSectionEntryFormBuilder extends MultipleFormBuilder
{

	use DispatchesJobs;

	protected $section;
	protected $reference;

    /**
     * Fired after the entry form is saved.
     *
     * After the entry form is saved take the
     * entry and use it to populate the comment
     * before it saves directly after.
     *
     * @param EntryFormBuilder $builder
     */
    public function onSavedEntry(EntryFormBuilder $builder)
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('comment');

        $comment = $form->getFormEntry();

        $entry = $builder->getFormEntry();

        $comment->section_entry_id   = $entry->getId();
        $comment->section_entry_type = get_class($entry);
    }

    public function onReady(Request $request)
    {
	    if($request->segment(1) != 'admin') {
		    $this->setActions(
			    [
				    'submit'
			    ]
		    );
	    }
    }
	/**
	 * Make the form.
	 *
	 * @param  null $entry
	 * @return $this
	 */
	public function make($entry = null)
	{
		if($this->getSection())
		{
			parent::make($entry);
		}

		return $this;
	}

    /**
     * Get the contextual entry ID.
     *
     * @return int|mixed|null
     */
    public function getContextualId()
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('comment');

        return $form->getContextualId();
    }

	/**
	 * Get the type.
	 *
	 * @return SectionInterface|null
	 */
	public function getSection()
	{
		return $this->section;
	}

	/**
	 * Set the type.
	 *
	 * @param  SectionInterface $section
	 * @return $this
	 */
	public function setSection(SectionInterface $section)
	{
		$this->section = $section;

		return $this;
	}

	/**
	 * Get the type.
	 *
	 * @return EloquentModel|null
	 */
	public function getReference()
	{
		return $this->reference;
	}

	/**
	 * Set the type.
	 *
	 * @param  EntryInterface $reference
	 * @return $this
	 */
	public function setReference(EntryInterface $reference)
	{
		$this->reference = $reference;

//		$section = $sections->find(1);
//
//		$this->addForm('comment', $comment_builder->setSection($section));
//		$this->addForm('entry', $entry_builder->setModel($section->getEntryModelName()));

		$this->dispatch(new AddSectionEntryFormFromReference($this, $reference));
		$this->dispatch(new AddCommentFormFromReference($this, $reference));

		return $this;
	}
}
