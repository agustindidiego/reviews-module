<?php namespace Rage\ReviewsModule\Comment;

use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Model\Reviews\ReviewsSectionsEntryModel;
use Anomaly\Streams\Platform\Support\Decorator;
use Rage\ReviewsModule\Comment\Contract\CommentInterface;

class CommentPresenter extends EntryPresenter
{

	public function fields()
	{
		/** @var $object CommentInterface */
		$object = $this->object;
		/** @var $entry ReviewsSectionsEntryModel */
		$entry = $object->getSectionEntry();

		$return = [];

		/** @var $assigment */
		foreach($entry->getAssignmentsByFieldType('rage.field_type.stars') as $assigment) {
			$return[] = (New Decorator())->decorate($entry)->{$assigment->getFieldSlug()};
		}

		return $return;
	}

}
