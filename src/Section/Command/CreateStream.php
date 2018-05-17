<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CreateStream
{

    use DispatchesJobs;

    /**
     * The page type instance.
     *
     * @var SectionInterface
     */
    protected $type;

    /**
     * Create a new CreateStream instance.
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
     * @param Repository                $config
     */
    public function handle(StreamRepositoryInterface $streams, Repository $config)
    {
        $streams->create(
            [
                $config->get('app.fallback_locale') => [
                    'name'        => $this->type->getTitle(),
//                    'description' => $this->type->getDescription(),
                ],
                'slug'                              => $this->type->getSlug() . '_comments',
                'namespace'                         => 'reviews',
                'locked'                            => false,
                'translatable'                      => true,
                'trashable'                         => true,
                'hidden'                            => true,
            ]
        );
    }
}
