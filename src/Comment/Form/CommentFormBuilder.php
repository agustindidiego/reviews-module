<?php namespace Rage\ReviewsModule\Comment\Form;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Rage\ReviewsModule\Section\Contract\SectionInterface;

class CommentFormBuilder extends FormBuilder
{

	/**
	 * The comment section.
	 *
	 * @var null|SectionInterface
	 */
	protected $section = null;

	/**
	 * The comment reference.
	 *
	 * @var null|EloquentModel
	 */
	protected $reference = null;

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [
	    'section',
	    'section_entry',
    ];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
    	'captcha' => true
    ];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

	/**
	 * Fired when the builder is ready to build.
	 *
	 * @throws \Exception
	 */
	public function onReady(Guard $auth, Request $request)
	{
		if (!$this->getSection() && !$this->getSectionEntry()) {
			throw new \Exception('The $type parameter is required when creating a comment.');
		}

		if($request->segment(1) != 'admin')
		{

			$this->setSkips(
				[
					'approved',
					'ip_address',
					'parent',
					'reference',
					'section',
					'section_entry',
					'poster',
				]
			);
			if ($auth->check()) {
				$this
					->skipField('email')
					->skipField('name');
			}
			if ($auth->guest()) {
				$this->setFields(
					[
						'name'  => [
							'required' => true,
						],
						'email' => [
							'required' => true,
						],
						'*',
					]
				);
			}
		}
	}

	/**
	 * Fired just before saving the form.
	 */
	public function onSaving()
	{
		$entry  = $this->getFormEntry();
		$section   = $this->getSection();
		$reference   = $this->getReference();

		if (!$entry->section_id) {
			$entry->section_id = $section->getId();
		}

		if(!$entry->reference_id && !is_null($reference)) {
			$entry->reference_id = $reference->getId();
			$entry->reference_type = get_class($reference);
		}
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
	 * Get the reference.
	 *
	 * @return EloquentModel|null
	 */
	public function getReference()
	{
		return $this->reference;
	}

	/**
	 * Set the reference.
	 *
	 * @param  EloquentModel $reference
	 * @return $this
	 */
	public function setReference(EloquentModel $reference)
	{
		$this->reference = $reference;

		return $this;
	}

}
