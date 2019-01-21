@php
    
    $configuration = icommerceups_get_configuration();
    $options = array('required' =>'required');

    if($configuration==NULL){
        $cStatus = 0;
    }else{
        $cStatus = $configuration->status;
    }
    $formID = uniqid("form_id");
   
@endphp

@if($configuration==NULL)
{!! Form::open(['route' => ["admin.icommerceups.configups.store"], 'method' => 'post','name' => $formID]) !!}
@else
{!! Form::open(['route' => ['admin.icommerceups.configups.update'], 'method' => 'put','name' => $formID]) !!}
@endif

<div class="col-xs-12">

    {!! Form::normalInput('access_key', '*'.trans('icommerceups::configups.table.access key'), $errors,$configuration,$options) !!}

    {!! Form::normalInput('user_id', '*'.trans('icommerceups::configups.table.user id'), $errors,$configuration,$options) !!}

    {!! Form::normalInput('password', '*'.trans('icommerceups::configups.table.password'), $errors,$configuration,$options) !!}

    <div class="form-group">
        <label for="mode">*Mode</label>
        <select class="form-control" id="mode" name="mode" required>
            <option value="0" @if(!empty($configuration) && $configuration->mode==0) selected @endif>TEST</option>
            <option value="1" @if(!empty($configuration) && $configuration->mode==1) selected @endif>LIVE</option>
        </select>
    </div>

    <div class="form-group">
        <label for="weight_dimentions">*{{trans('icommerceups::configups.table.weight dimentions')}}</label>
        <select class="form-control" id="weight_dimentions" name="weight_dimentions" required>
            <option value="0" @if(!empty($configuration) && $configuration->weight_dimentions==0) selected @endif>LB/IN</option>
            <option value="1" @if(!empty($configuration) && $configuration->weight_dimentions==1) selected @endif>KG/CM</option>
        </select>
    </div>

    {!! Form::normalInput('shipper_postalcode', '*'.trans('icommerceups::configups.table.shipper_postalcode'), $errors,$configuration,$options) !!}

    {!! Form::normalInput('shipper_statecode', trans('icommerceups::configups.table.shipper_statecode'), $errors,$configuration) !!}

    {!! Form::normalInput('shipper_countrycode', trans('icommerceups::configups.table.shipper_countrycode'), $errors,$configuration) !!}

    <div class="form-group">
        <div>
            <label class="checkbox-inline">
                <input name="status" type="checkbox" @if($cStatus==1) checked @endif>{{trans('icommerceups::configups.table.activate')}}
            </label>
        </div>   
    </div>
    
    <div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('icommerceups::configups.button.save configuration') }}</button>
    </div>
   

</div>

{!! Form::close() !!}