<?php namespace Rage\ReviewsModule\Http\Controller\Admin;

use Rage\ReviewsModule\Section\Contract\SectionRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AjaxController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AjaxController extends AdminController
{

    /**
     * Return the modal for choosing a page type.
     *
     * @param  SectionRepositoryInterface $sections
     * @return \Illuminate\View\View
     */
    public function chooseType(SectionRepositoryInterface $sections)
    {
        return view('module::ajax/choose_type', ['sections' => $sections->all()]);
    }

    /**
     * Return the modal for choosing a field type.
     *
     * @param  FieldTypeCollection   $fieldTypes
     * @return \Illuminate\View\View
     */
    public function chooseFieldType(FieldTypeCollection $fieldTypes)
    {
        $url = $_SERVER['HTTP_REFERER'];

        return view('module::ajax/choose_field_type', ['field_types' => $fieldTypes->all(), 'url' => $url]);
    }

    /**
     * Return the modal for choosing a field to assign.
     *
     * @param  FieldRepositoryInterface $fields
     * @return \Illuminate\View\View
     */
    public function chooseField(FieldRepositoryInterface $fields, SectionRepositoryInterface $sections, $id)
    {
        $section = $sections->find($id);

        return view(
            'module::ajax/choose_field',
            [
                'fields' => $fields->findAllByNamespace('reviews')->notAssignedTo($section->getEntryStream())->unlocked(),
                'id'     => $id,
            ]
        );
    }
}
