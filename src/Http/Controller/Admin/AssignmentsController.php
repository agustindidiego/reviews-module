<?php namespace Rage\ReviewsModule\Http\Controller\Admin;

use Rage\ReviewsModule\Section\Contract\SectionInterface;
use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Form\AssignmentFormBuilder;
use Anomaly\Streams\Platform\Assignment\Table\AssignmentTableBuilder;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AssignmentsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentsController extends AdminController
{

    /**
     * Return an index of existing assignments.
     *
     * @param  AssignmentTableBuilder                     $table
     * @param  SectionRepositoryInterface                    $types
     * @param                                             $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AssignmentTableBuilder $table, SectionRepositoryInterface $types, $type)
    {
        /* @var SectionInterface $type */
        $type = $types->find($type);

        return $table->setStream($type->getEntryStream())->render();
    }

    /**
     * Return the modal for choosing a field to assign.
     *
     * @param  FieldRepositoryInterface              $fields
     * @param  SectionRepositoryInterface               $types
     * @param                                        $type
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(FieldRepositoryInterface $fields, SectionRepositoryInterface $types, $section)
    {
        /* @var SectionInterface $section */
	    $section = $types->find($section);

        $fields = $fields
            ->findAllByNamespace('reviews')
            ->notAssignedTo($section->getEntryStream())
            ->unlocked();

        return $this->view->make('module::admin/assignments/choose', compact('fields', 'section'));
    }

    /**
     * Create a new assignment.
     *
     * @param  AssignmentFormBuilder                      $builder
     * @param  SectionRepositoryInterface                    $types
     * @param  FieldRepositoryInterface                   $fields
     * @param                                             $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        AssignmentFormBuilder $builder,
        SectionRepositoryInterface $types,
        FieldRepositoryInterface $fields,
        $type
    ) {
        /* @var SectionInterface $type */
        $type = $types->find($type);

        return $builder
            ->setField($fields->find($this->request->get('field')))
            ->setStream($type->getEntryStream())
            ->render();
    }

    /**
     * Edit an existing assignment.
     *
     * @param  AssignmentFormBuilder                      $builder
     * @param  SectionRepositoryInterface                    $types
     * @param                                             $type
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        AssignmentFormBuilder $builder,
        SectionRepositoryInterface $types,
        $type,
        $id
    ) {
        /* @var SectionInterface $type */
        $type = $types->find($type);

        return $builder
            ->setStream($type->getEntryStream())
            ->render($id);
    }
}