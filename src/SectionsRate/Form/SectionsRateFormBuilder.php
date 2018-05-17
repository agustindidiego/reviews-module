<?php namespace Rage\ReviewsModule\SectionsRate\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Rage\ReviewsModule\Section\Contract\SectionInterface;

class SectionsRateFormBuilder extends FormBuilder
{

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
    	'section'
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
    protected $options = [];

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

	protected $section = null;

	/**
	 * Fired when the builder is ready to build.
	 *
	 * @throws \Exception
	 */
	public function onReady()
	{

		if (!$this->getSection() && !$this->getEntry()) {
			throw new \Exception('The $section parameter is required when creating a link.');
		}
	}

	/**
	 * Fired just before saving the entry.
	 */
	public function onSaving()
	{
		$entry  = $this->getFormEntry();

		if (!$entry->section_id && $section = $this->getSection()) {
			$entry->section_id = $section->getId();
		}
	}

	/**
	 * Get the section.
	 *
	 * @return SectionInterface|null
	 */
	public function getSection()
	{
		return $this->section;
	}

	/**
	 * Set the section.
	 *
	 * @param $section
	 * @return $this
	 */
	public function setSection(SectionInterface $section)
	{
		$this->section = $section;

		return $this;
	}

}
