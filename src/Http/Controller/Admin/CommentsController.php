<?php namespace Rage\ReviewsModule\Http\Controller\Admin;

use Rage\ReviewsModule\Comment\Contract\CommentRepositoryInterface;
use Rage\ReviewsModule\Comment\Form\Command\AddCommentFormFromComment;
use Rage\ReviewsModule\Comment\Form\Command\AddCommentFormFromRequest;
use Rage\ReviewsModule\Comment\Form\Command\AddSectionEntryFormFromComment;
use Rage\ReviewsModule\Comment\Form\Command\AddSectionEntryFormFromRequest;
use Rage\ReviewsModule\Comment\Form\CommentFormBuilder;
use Rage\ReviewsModule\Comment\Form\CommentSectionEntryFormBuilder;
use Rage\ReviewsModule\Comment\Table\CommentTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class CommentsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param CommentTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CommentTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param CommentSectionEntryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CommentSectionEntryFormBuilder $form)
    {
	    $this->dispatch(new AddSectionEntryFormFromRequest($form));
	    $this->dispatch(new AddCommentFormFromRequest($form));

        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param CommentRepositoryInterface $comments
     * @param CommentSectionEntryFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CommentRepositoryInterface $comments, CommentSectionEntryFormBuilder $form, $id)
    {
	    $comment = $comments->find($id);

	    $this->dispatch(new AddSectionEntryFormFromComment($form, $comment));
	    $this->dispatch(new AddCommentFormFromComment($form, $comment));

        return $form->render($id);
    }

	/**
	 * Delete a page and go back.
	 *
	 * @param  CommentRepositoryInterface           $comments
	 * @param                                    $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete(CommentRepositoryInterface $comments, $id)
	{
//		$authorizer->authorize('anomaly.module.pages::pages.delete');

		$comments->delete($comment = $comments->find($id));

		$comment->section_entry->delete();

		return redirect()->back();
	}
}
