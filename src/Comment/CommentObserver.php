<?php namespace Rage\ReviewsModule\Comment;

use Anomaly\Streams\Platform\Assignment\AssignmentModel;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Illuminate\Http\Request;
use Rage\ReviewsModule\Comment\Command\SetIpAddress;
use Rage\ReviewsModule\Comment\Command\SetUser;
use Rage\ReviewsModule\Comment\Contract\CommentInterface;

class CommentObserver extends EntryObserver
{

	/**
	 * Run before a record is created.
	 *
	 * @param EntryInterface|CommentInterface $entry
	 */
	public function creating(EntryInterface $entry)
	{
		$this->dispatch(new SetUser($entry));
		$this->dispatch(new SetIpAddress($entry));
		parent::creating($entry);
	}

	public function saving(EntryInterface $entry)
	{
		/** @var AssignmentModel $assignmment */
//		foreach($entry->getSectionEntry()->getStream()->getAssignments() as $assignmment)
//		{
//			$slug = $assignmment->getFieldSlug();
//			$value = $entry->getSectionEntry()->{$slug};
//		}

		parent::saving($entry);
	}

}
