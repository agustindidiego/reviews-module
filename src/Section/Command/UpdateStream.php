<?php namespace Rage\ReviewsModule\Section\Command;

use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UpdateStream
{

    use DispatchesJobs;

    /**
     * The publication type instance.
     *
     * @var SectionInterface
     */
    protected $type;

    /**
     * Update a new UpdateStream instance.
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
     * @param SectionRepositoryInterface   $types
     * @param Repository                $config
     */
    public function handle(StreamRepositoryInterface $streams, SectionRepositoryInterface $types, Repository $config)
    {
        /* @var SectionInterface $type */
        $type = $types->find($this->type->getId());

        /* @var StreamInterface $stream */
        $stream = $type->getEntryStream();

	    if(!$stream){
		    $this->dispatch(new CreateStream($type));
	    }

	    /* @var StreamInterface $stream */
	    $stream = $type->getEntryStream();

        $stream->fill(
            [
                $config->get('app.fallback_locale') => [
                    'name'        => $this->type->getTitle(),
//                    'description' => $this->type->getDescription(),
                ],
                'slug' => $this->type->getSlug() . '_comments',
            ]
        );

        $streams->save($stream);
    }
}
