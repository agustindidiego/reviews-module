<?php namespace Rage\ReviewsModule\Comment\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface CommentInterface extends EntryInterface
{

	public function getSection();

	public function getSectionName();

	public function getSectionEntry();

	public function getSectionEntryId();
}
