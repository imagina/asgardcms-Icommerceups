<?php

namespace Modules\IcommerceUps\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\IcommerceUps\Entities\Configups;
use Modules\IcommerceUps\Http\Requests\CreateConfigupsRequest;
use Modules\IcommerceUps\Http\Requests\UpdateConfigupsRequest;
use Modules\IcommerceUps\Repositories\ConfigupsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Setting\Contracts\Setting;
use Modules\Setting\Repositories\SettingRepository;

class ConfigupsController extends AdminBaseController
{
    /**
     * @var ConfigupsRepository
     */
    private $configups;
    private $setting;
    
    public function __construct(ConfigupsRepository $configups, SettingRepository $setting)
    {
        parent::__construct();
        $this->configups = $configups;
        $this->setting = $setting;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateConfigupsRequest $request
     * @return Response
     */
    public function store(CreateConfigupsRequest $request)
    {
        
        $this->configups->create($request->all());
        
        return redirect()->route('admin.icommerce.shipping.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('icommerceups::configups.title.configups')]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Configups $configups
     * @param  UpdateConfigupsRequest $request
     * @return Response
     */
    public function update(Configups $configups, UpdateConfigupsRequest $request)
    {
  
        if($request->status=='on')
          $request['status'] = "1";
        else
          $request['status'] = "0";

        $data = $request->all();
        $token =$data['_token'];
        unset($data['_token']);
        unset($data['_method']);

      $newData['_token']=$token;
      foreach ($data as $key => $val)
        $newData['icommerceups::'.$key ]= $val;

        $this->setting->createOrUpdate($newData);

        return redirect()->route('admin.icommerce.shipping.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('icommerceups::configups.title.configups')]));
    }

    


}
