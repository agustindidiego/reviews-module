<?php namespace Rage\ReviewsModule\Comment;

use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Rage\ReviewsModule\Section\Command\GetSection;
use Rage\ReviewsModule\Section\Contract\SectionInterface;

class CommentCriteria extends EntryCriteria
{

	/**
	 * Add the type constraint.
	 *
	 * @param $identifier
	 * @return $this
	 */
	public function section($identifier)
	{
		/* @var SectionInterface $section */
		$section = $this->dispatch(new GetSection($identifier));

		$stream = $section->getEntryStream();
		$table  = $stream->getEntryTableName();

		$this->query
			->select('reviews_comments.*')
			->where('section_id', $section->getId())
			->join($table . ' AS entry', 'entry.id', '=', 'reviews_comments.section_entry_id');

		return $this;
	}

	/**
	 * Return only published.
	 *
	 * @return $this
	 */
	public function approved()
	{
		$this->query->where('approved', true);
//		$this->query->where('publish_at', '<=', date('Y-m-d H:i:s'));

		return $this;
	}
}
