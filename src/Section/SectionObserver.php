<?php namespace Rage\ReviewsModule\Section;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Rage\ReviewsModule\Section\Command\CreateStream;
use Rage\ReviewsModule\Section\Command\DeleteComments;
use Rage\ReviewsModule\Section\Command\DeleteStream;
use Rage\ReviewsModule\Section\Command\RestoreComments;
use Rage\ReviewsModule\Section\Command\UpdateComments;
use Rage\ReviewsModule\Section\Command\UpdateStream;
use Rage\ReviewsModule\Section\Contract\SectionInterface;

class SectionObserver extends EntryObserver
{
	/**
	 * Fired after a page type is created.
	 *
	 * @param EntryInterface|SectionInterface $entry
	 */
	public function created(EntryInterface $entry)
	{
		$this->commands->dispatch(new CreateStream($entry));

		parent::created($entry);
	}

	/**
	 * Fired before a page type is updated.
	 *
	 * @param EntryInterface|SectionInterface $entry
	 */
	public function updating(EntryInterface $entry)
	{
		$this->commands->dispatch(new UpdateStream($entry));
		$this->commands->dispatch(new UpdateComments($entry));

		parent::updating($entry);
	}

	/**
	 * Fired after a page type is deleted.
	 *
	 * @param EntryInterface|SectionInterface $entry
	 */
	public function deleted(EntryInterface $entry)
	{
		$this->commands->dispatch(new DeleteComments($entry));
		$this->commands->dispatch(new DeleteStream($entry));

		parent::deleted($entry);
	}

	/**
	 * Fired after a page type is restored.
	 *
	 * @param EntryInterface|SectionInterface $entry
	 */
	public function restored(EntryInterface $entry)
	{
		$this->commands->dispatch(new RestoreComments($entry));

		parent::restored($entry);
	}
}
