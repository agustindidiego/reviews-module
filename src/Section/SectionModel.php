<?php namespace Rage\ReviewsModule\Section;

use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Rage\ReviewsModule\Comment\CommentCollection;
use Rage\ReviewsModule\Section\Command\GetStream;
use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Anomaly\Streams\Platform\Model\Reviews\ReviewsSectionsEntryModel;

class SectionModel extends ReviewsSectionsEntryModel implements SectionInterface
{

	/**
	 * Get the title.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->title;
	}

	/**
	 * Get the title.
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the slug.
	 *
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * Get the related entry stream.
	 *
	 * @return StreamInterface
	 */
	public function getEntryStream()
	{
		return $this->dispatch(new GetStream($this));
	}

	/**
	 * Get the related entry model.
	 *
	 * @return EntryModel
	 */
	public function getEntryModel()
	{
		$stream = $this->getEntryStream();

		return $stream->getEntryModel();
	}

	/**
	 * Get the related entry model name.
	 *
	 * @return string
	 */
	public function getEntryModelName()
	{
		$stream = $this->getEntryStream();

		return $stream->getEntryModelName();
	}

	/**
	 * Get the related publications.
	 *
	 * @return CommentCollection
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * Return the comments relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany('Rage\ReviewsModule\Comment\CommentModel', 'section_id');
	}
}
