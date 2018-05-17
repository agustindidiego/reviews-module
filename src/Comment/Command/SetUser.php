<?php
namespace Rage\ReviewsModule\Comment\Command;



use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;
use Rage\ReviewsModule\Comment\Contract\CommentInterface;

class SetUser
{
	/**
	 * The comment instance.
	 *
	 * @var CommentInterface
	 */
	protected $entry;
	/**
	 * Create a new SetUser instance.
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
	 * @param Guard $auth
	 */
	public function handle(Guard $auth)
	{
		/* @var UserInterface $user */
		if ($user = $auth->user()) {
			$this->entry->setAttribute('poster', $user);
			$this->entry->setAttribute('email', $user->getEmail());
		}
	}
}