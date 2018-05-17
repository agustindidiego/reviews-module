<?php namespace Rage\ReviewsModule\Section\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface SectionRepositoryInterface extends EntryRepositoryInterface
{

	/**
	 * Find a type by it's slug.
	 *
	 * @param $slug
	 * @return SectionInterface
	 */
	public function findBySlug($slug);

	public function findByAddon($addon);
}
