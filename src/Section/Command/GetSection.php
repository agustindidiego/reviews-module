<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\Streams\Platform\Support\Presenter;


/**
 * Class GetType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetSection
{

    /**
     * The type identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetType instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param  SectionRepositoryInterface $sections
     * @return SectionInterface|null
     */
    public function handle(SectionRepositoryInterface $sections)
    {
        if (is_numeric($this->identifier)) {
            return $sections->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $sections->findBySlug($this->identifier);
        }

        if ($this->identifier instanceof Presenter) {
            return $this->identifier->getObject();
        }

        if ($this->identifier instanceof SectionInterface) {
            return $this->identifier;
        }

        return null;
    }
}
