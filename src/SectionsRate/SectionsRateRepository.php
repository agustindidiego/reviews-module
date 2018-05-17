<?php namespace Rage\ReviewsModule\SectionsRate;

use Rage\ReviewsModule\SectionsRate\Contract\SectionsRateRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class SectionsRateRepository extends EntryRepository implements SectionsRateRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var SectionsRateModel
     */
    protected $model;

    /**
     * Create a new SectionsRateRepository instance.
     *
     * @param SectionsRateModel $model
     */
    public function __construct(SectionsRateModel $model)
    {
        $this->model = $model;
    }
}
