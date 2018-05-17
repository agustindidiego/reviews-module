<?php namespace Rage\ReviewsModule\Section;

use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class SectionRepository extends EntryRepository implements SectionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var SectionModel
     */
    protected $model;

    /**
     * Create a new SectionRepository instance.
     *
     * @param SectionModel $model
     */
    public function __construct(SectionModel $model)
    {
        $this->model = $model;
    }

	/**
	 * Find a type by it's slug.
	 *
	 * @param $slug
	 * @return SectionInterface
	 */
	public function findBySlug($slug)
	{
		return $this->model->where('slug', $slug)->first();
	}

	/**
	 * Find a type by it's addon.
	 *
	 * @param $addon
	 * @return SectionInterface
	 */
	public function findByAddon($addon)
	{
		return $this->model->where('addon', $addon)->first();
	}
}
