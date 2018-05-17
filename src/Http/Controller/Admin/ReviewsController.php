<?php namespace Rage\ReviewsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Routing\Redirector;

class ReviewsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Redirector $redirect)
    {
        return redirect('admin/reviews/sections');
    }
}
