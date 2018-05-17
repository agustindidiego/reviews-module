<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class DeleteStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteStream
{

    /**
     * The publication type instance.
     *
     * @var SectionInterface
     */
    protected $type;

    /**
     * Create a new DeleteStream instance.
     *
     * @param SectionInterface $type
     */
    public function __construct(SectionInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        if (!$this->type->isForceDeleting()) {
            return;
        }
        
        $streams->delete($streams->findBySlugAndNamespace($this->type->getSlug() . '_comments', 'reviews'));
    }
}
