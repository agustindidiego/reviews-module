<?php namespace Rage\ReviewsModule\Http\Controller\Admin;

use Rage\ReviewsModule\Section\Form\SectionFormBuilder;
use Rage\ReviewsModule\Section\Table\SectionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class SectionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param SectionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SectionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param SectionFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(SectionFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param SectionFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(SectionFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
