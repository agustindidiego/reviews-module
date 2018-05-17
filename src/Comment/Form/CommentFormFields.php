<?php namespace Rage\ReviewsModule\Comment\Form;

//use Rage\ReviewsModule\Comment\Command\GetRealPath;
use Rage\ReviewsModule\Comment\Contract\CommentInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CommentFormFields
{

    use DispatchesJobs;

    /**
     * Handle the comment fields.
     *
     * @param CommentFormBuilder $builder
     */
    public function handle(CommentFormBuilder $builder)
    {
        $section   = $builder->getSection();

        $builder->setFields(
            [
                '*'
            ]
        );
    }
}
