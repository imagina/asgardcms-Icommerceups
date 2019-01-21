<?php

namespace Modules\Icommerceups\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Icommerceups\Entities\Icommerceups;
use Modules\Icommerceups\Http\Requests\CreateIcommerceupsRequest;
use Modules\Icommerceups\Http\Requests\UpdateIcommerceupsRequest;
use Modules\Icommerceups\Repositories\IcommerceupsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class IcommerceupsController extends AdminBaseController
{
    /**
     * @var IcommerceupsRepository
     */
    private $icommerceups;

    public function __construct(IcommerceupsRepository $icommerceups)
    {
        parent::__construct();

        $this->icommerceups = $icommerceups;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$icommerceups = $this->icommerceups->all();

        return view('icommerceups::admin.icommerceups.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('icommerceups::admin.icommerceups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateIcommerceupsRequest $request
     * @return Response
     */
    public function store(CreateIcommerceupsRequest $request)
    {
        $this->icommerceups->create($request->all());

        return redirect()->route('admin.icommerceups.icommerceups.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('icommerceups::icommerceups.title.icommerceups')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Icommerceups $icommerceups
     * @return Response
     */
    public function edit(Icommerceups $icommerceups)
    {
        return view('icommerceups::admin.icommerceups.edit', compact('icommerceups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Icommerceups $icommerceups
     * @param  UpdateIcommerceupsRequest $request
     * @return Response
     */
    public function update(Icommerceups $icommerceups, UpdateIcommerceupsRequest $request)
    {
        $this->icommerceups->update($icommerceups, $request->all());

        return redirect()->route('admin.icommerceups.icommerceups.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('icommerceups::icommerceups.title.icommerceups')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Icommerceups $icommerceups
     * @return Response
     */
    public function destroy(Icommerceups $icommerceups)
    {
        $this->icommerceups->destroy($icommerceups);

        return redirect()->route('admin.icommerceups.icommerceups.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('icommerceups::icommerceups.title.icommerceups')]));
    }
}
