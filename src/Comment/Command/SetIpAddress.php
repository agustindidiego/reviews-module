<?php

namespace Rage\ReviewsModule\Comment\Command;

use Illuminate\Http\Request;
use Rage\ReviewsModule\Comment\Contract\CommentInterface;

class SetIpAddress
{
	/**
	 * The comment instance.
	 *
	 * @var CommentInterface
	 */
	protected $entry;
	/**
	 * Create a new SetIpAddress instance.
	 *
	 * @param CommentInterface $entry
	 */
	public function __construct(CommentInterface $entry)
	{
		$this->entry = $entry;
	}
	/**
	 * Handle the command.
	 *
	 * @param Request $request
	 */
	public function handle(Request $request)
	{
		$this->entry->setAttribute('ip_address', $request->getClientIp());
	}
}