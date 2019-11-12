@extends('default.default')
@section('css')
<link rel="stylesheet" href="{{url('public/css/store.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="setting cart-alert row col-md-6 col-sm-12">

        <div class="preview-block col-md-12">
            <div class="demo">
                <div class="browser">
                    <img class="pre-img-1" src="{!! asset('public/img/favicon.png') !!}" />
                    <div class="" id="preview">
                        <div class="view-number">
                            <p class ="number">1</p>
                        </div>
                    </div>
                    <img class="pre-img-2" src="{!! asset('public/img/favicon.png') !!}" />
                    <div  id="preview-2">
                        <div class="view-number">
                            <p class ="number">1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session('alert'))
            <div id="message" class="alert alert-success col-md-12">{{session('alert')}}</div>
        @endif
        <div class="view-title no-item col-md-12">
            <span class="break_line">{{trans('label.no_of_item')}}</span>
            <hr></hr>
        </div>
        <form class="setting-form col-md-12" action="{{route('setting.store', request()->domain)}}" method="POST" role="form">
        {{ csrf_field() }}
        <div class="">
        
           
            <div>
                <label for="text_color">{{trans('label.color')}}</label>
                <input id="text_color" class="jscolor form-control input-color" onChange="Preview.changeColor()" value="{{$data['shop_setting']->text_color}}" name="text_color">
            </div>

            <div class="full-width">
                <div class="part-width">
                    <label for="font_family">{{trans('label.font')}}</label>
                    <select id="font_family" onChange="Preview.changeFront()" class="form-control" name="font_family">
                    @foreach($data['settings']['font_family'] as $font)
                    <option value="{{$font}}" <?php echo $data['shop_setting']->font_family == $font ? 'selected' : '';?>>{{ucfirst($font)}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="part-width right">
                    <label for="font_style">{{trans('label.style')}}</label>
                    <select id="font_style" onChange="Preview.changeFrontStyle()" class="form-control" name="font_style">
                    @foreach($data['settings']['font_style'] as $font_style)
                    <option value="{{$font_style}}" <?php echo $data['shop_setting']->font_style == $font_style ? 'selected' : '';?>>{{ucfirst($font_style)}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="padding-content">
                <div class="view-title col-md-12">
                    <span class="break_line">{{trans('label.alert_icon')}}</span>
                    <hr></hr>
                </div>

                <div class="bg-color-alert">
                    <label for="icon_color">{{trans('label.background_color')}}</label>
                    <input id="backgroup_color" onChange="Preview.changeBackgroundColor()"  class="jscolor form-control input-color" value="{{$data['shop_setting']->icon_color}}" name="icon_color">
                </div>

                <div class="full-width">
                    <div class="part-width">
                        <label for="shape">{{trans('label.shape')}}</label>
                        <select id="shape" onChange="Preview.changeShape()" class="form-control" name="shape">
                        @foreach($data['settings']['shape'] as $shape)
                        <option value="{{$shape}}" <?php echo $data['shop_setting']->shape == $shape ? 'selected' : '';?>>{{ucfirst($shape)}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="part-width right">
                        <label for="position">{{trans('label.position')}}</label>
                        <select id="position"  onChange="Preview.changePosition()" class="form-control" name="position">
                        @foreach($data['settings']['position'] as $key => $position)
                        <option value="{{$key}}" <?php echo $data['shop_setting']->position == $key ? 'selected' : '';?>>{{$position}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="part-width">
                        <label for="animation">{{trans('label.animation')}}</label>
                        <select id="animation" onChange="Preview.changeAnimation()" class="form-control" name="animation">
                        @foreach($data['settings']['animation'] as $animation)
                        <option value="{{$animation}}" <?php echo $data['shop_setting']->animation == $animation ? 'selected' : '';?>>{{ucfirst($animation)}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="part-width right">
                        <label for="flicker_timing" class="label">{{trans('label.frequency')}}</label><i rel="tooltip" class="fa fa-info-circle" title="{{trans('label.tooltip_alert_icon')}}" aria-hidden="true"></i>
                        <select id="frequency"  onChange="Preview.changeFrequecy()" class="form-control" name="flicker_timing">
                        @foreach($data['settings']['flicker_timing'] as $flicker_timing)
                        <option value="{{$flicker_timing}}" <?php echo $data['shop_setting']->flicker_timing == $flicker_timing ? 'selected' : '';?>>{{$flicker_timing}} {{trans('label.second')}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="padding-content">
            <div class="view-title col-md-12">
                <span class="break_line">{{trans('label.sound')}}</span>
                <hr></hr>
            </div>

            <div class="full-width">

                <label for="sound_effect" class="label">{{trans('label.sound_effect')}}</label><i rel="tooltip" class="fa fa-info-circle" title="{{trans('label.tooltip_sound_effect')}}" aria-hidden="true"></i>
                <select class="form-control" id="sound_effect" name="sound_effect">
                @foreach($data['settings']['sound_effect'] as $key => $sound_effect)
                <option value="{{$key}}" <?php echo $data['shop_setting']->sound_effect == $key ? 'selected' : '';?>>{{$sound_effect}}</option>
                @endforeach
                </select>

                <div class="part-width">
                    <label for="repeat" class="label">{{trans('label.repeat')}}</label><i rel="tooltip" class="fa fa-info-circle" title="{{trans('label.tooltip_repeat')}}" aria-hidden="true"></i>
                    <select class="form-control" id="repeat" name="repeat">
                    @foreach($data['settings']['repeat'] as $key => $repeat)
                    <option value="{{$key}}" <?php echo $data['shop_setting']->repeat == $key ? 'selected' : '';?>>{{ucfirst($repeat)}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="part-width right">
                    <label for="sound_frequency">{{trans('label.frequency')}}</label> <i rel="tooltip" class="fa fa-info-circle" title="{{trans('label.tooltip_frequency')}}" aria-hidden="true"></i>
                    <select class="form-control" id="sound_frequency" name="frequency">
                    @foreach($data['settings']['frequency'] as $frequency)
                    <option value="{{$frequency}}" <?php echo $data['shop_setting']->frequency == $frequency ? 'selected' : '';?>>{{$frequency}} {{trans('label.second')}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            </div>
            <div class="save-button">
                <button class="btn right submit" type="submit">
                    {{trans('label.save')}}
                </button>
            </div>

        </div>  
        </form>
            
    </div>
</div>
@endsection
@section('js')
    @parent
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{url('/public/js/store.js')}}"></script>
    <script src="{{url('/public/js/preview.js')}}"></script>
    <script>
        Preview.preview();
    </script>
@endsection