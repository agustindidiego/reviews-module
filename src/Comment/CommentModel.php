<?php namespace Rage\ReviewsModule\Comment;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Builder;
use Rage\ReviewsModule\Comment\Contract\CommentInterface;
use Anomaly\Streams\Platform\Model\Reviews\ReviewsCommentsEntryModel;
use Rage\ReviewsModule\Section\Contract\SectionInterface;

class CommentModel extends ReviewsCommentsEntryModel implements CommentInterface
{

	/**
	 * Always eager load these.
	 *
	 * @var array
	 */
	protected $with = [
		'section',
		'sectionEntry',
		'reference',
//		'translations',
	];

//	public function reference()
//	{
//		return $this->morphTo();
//	}

	/**
	 * Restrict to live posts only.
	 *
	 * @param  Builder $query
	 * @return Builder
	 */
	public function scopeApproved(Builder $query)
	{
		return $query
			->where('approved', 1);
	}

	/**
	 * Get the comment section.
	 *
	 * @return null|SectionInterface
	 */
	public function getSection()
	{
		return $this->section;
	}

	/**
	 * Get the section name.
	 *
	 * @return string
	 */
	public function getSectionName()
	{
		$section = $this->getSection();

		return $section->getTitle();
	}

	/**
	 * Get the related entry.
	 *
	 * @return null|EntryInterface
	 */
	public function getSectionEntry()
	{
		return $this->getRelationValue('section_entry');
	}

	/**
	 * Get the related entry ID.
	 *
	 * @return null|int
	 */
	public function getSectionEntryId()
	{
		return $this->section_entry_id;
	}

}
