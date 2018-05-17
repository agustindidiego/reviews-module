<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class GetStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetStream
{

    /**
     * The page type instance.
     *
     * @var SectionInterface
     */
    protected $section;

    /**
     * Create a new GetStream instance.
     *
     * @param SectionInterface $section
     */
    public function __construct(SectionInterface $section)
    {
        $this->section = $section;
    }

    /**
     * Handle the command.
     *
     * @param  StreamRepositoryInterface                                      $streams
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        return $streams->findBySlugAndNamespace($this->section->getSlug() . '_comments', 'reviews');
    }
}
