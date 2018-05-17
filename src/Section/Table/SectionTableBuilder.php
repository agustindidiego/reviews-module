<?php namespace Rage\ReviewsModule\Section\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class SectionTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
    	'title',
        'entry.addon.name'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit' => [
	        'href' => 'admin/reviews/sections/edit/{entry.id}'
        ],
        'assignments' => [
	        'href' => 'admin/reviews/sections/assignments/{entry.id}'
        ],
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
