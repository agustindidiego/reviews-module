<?php namespace Rage\ReviewsModule\SectionsRate\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;
use Rage\ReviewsModule\Section\Contract\SectionInterface;

class SectionsRateTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
    	'title'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The table assets.
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
		if (!$this->getSection()) {
			throw new \Exception('The $section parameter is required.');
		}
	}

	/**
	 * Fired just before starting the query.
	 *
	 * @param Builder $query
	 */
	public function onQuerying(Builder $query)
	{
		$section = $this->getSection();

		$query->where('section_id', $section->getId());
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
