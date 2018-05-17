<?php namespace Rage\ReviewsModule\Section\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

interface SectionInterface extends EntryInterface
{

	public function getTitle();

	public function getSlug();

	/**
	 * Get the related entry stream.
	 *
	 * @return StreamInterface
	 */
	public function getEntryStream();

	/**
	 * Get the related entry model.
	 *
	 * @return EntryModel
	 */
	public function getEntryModel();

	/**
	 * Get the related entry model name.
	 *
	 * @return string
	 */
	public function getEntryModelName();

	public function getComments();

	public function comments();
}
