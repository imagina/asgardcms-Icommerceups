@php
    $options = array('required' =>'required');
    $formID = uniqid("form_id");
@endphp

{!! Form::open(['route' => ['admin.icommerce.shippingmethod.update',$method->id], 'method' => 'put','name' => $formID]) !!}

<div class="col-xs-12 col-sm-9">

    <div class="row">

        <div class="nav-tabs-custom">
            @include('partials.form-tab-headers')
            <div class="tab-content">
                <?php $i = 0; ?>
                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                    <?php $i++; ?>
                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="{{$method->name}}_tab_{{ $i }}">
                        
                        {!! Form::i18nInput('title', '* '.trans('icommerce::paymentmethods.table.title'), $errors, $locale, $method) !!}
                        {!! Form::i18nInput('description', '* '.trans('icommerce::paymentmethods.table.description'), $errors, $locale, $method) !!}
                    
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>

    <div class="row">
    <div class="col-xs-12">

        <div class="form-group ">
            <label for="accessKey">* {{trans('icommerceups::icommerceups.table.accessKey')}}</label>
            <input placeholder="{{trans('icommerceups::icommerceups.table.accessKey')}}" required="required" name="accessKey" type="text" id="accessKey" class="form-control" value="{{$method->options->accessKey}}">
        </div>

        <div class="form-group ">
            <label for="userId">* {{trans('icommerceups::icommerceups.table.userId')}}</label>
            <input placeholder="{{trans('icommerceups::icommerceups.table.userId')}}" required="required" name="userId" type="text" id="userId" class="form-control" value="{{$method->options->userId}}">
        </div>

        <div class="form-group ">
            <label for="password">* {{trans('icommerceups::icommerceups.table.password')}}</label>
            <input placeholder="{{trans('icommerceups::icommerceups.table.password')}}" required="required" name="password" type="text" id="password" class="form-control" value="{{$method->options->password}}">
        </div>

        <div class="form-group">
            <label for="mode">* {{trans('icommerceups::icommerceups.table.mode')}}</label>
            <select class="form-control" id="mode" name="mode" required>
                <option value="sandbox" @if(!empty($method->options->mode) && $method->options->mode=='sandbox') selected @endif>SANDBOX</option>
                <option value="live" @if(!empty($method->options->mode) && $method->options->mode=='live') selected @endif>LIVE</option>
            </select>
        </div>

        <div class="form-group ">
            <label for="shipperPostalCode">* {{trans('icommerceups::icommerceups.table.shipperPostalCode')}}</label>
            <input placeholder="{{trans('icommerceups::icommerceups.table.shipperPostalCode')}}" required="required" name="shipperPostalCode" type="text" id="shipperPostalCode" class="form-control" value="{{$method->options->shipperPostalCode}}">
        </div>

        <div class="form-group ">
            <label for="shipperStateCode">{{trans('icommerceups::icommerceups.table.shipperStateCode')}}</label>
            <input placeholder="{{trans('icommerceups::icommerceups.table.shipperStateCode')}}"  name="shipperStateCode" type="text" id="shipperStateCode" class="form-control" value="{{$method->options->shipperStateCode}}">
        </div>

        <div class="form-group ">
            <label for="shipperCountryCode">{{trans('icommerceups::icommerceups.table.shipperCountryCode')}}</label>
            <input placeholder="{{trans('icommerceups::icommerceups.table.shipperCountryCode')}}"  name="shipperCountryCode" type="text" id="shipperCountryCode" class="form-control" value="{{$method->options->shipperCountryCode}}">
        </div>


        <div class="form-group">
            <div>
                <label class="checkbox-inline">
                    <input name="status" type="checkbox" @if($method->status==1) checked @endif>{{trans('icommerce::paymentmethods.table.activate')}}
                </label>
            </div>   
        </div>

    </div>
    </div>

</div>


<div class="clearfix"></div>   

<div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('icommerce::paymentmethods.button.save configuration') }} {{$method->title}}</button>
</div>


{!! Form::close() !!}