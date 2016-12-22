@inject('presenter', 'App\Presenters\Backend\PermissionPresenter')
@extends('themes.metronic.common.layout')

@section('css')
<link href="{{asset('themes/metronic/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-settings font-green-haze"></i>
                    <span class="caption-subject bold uppercase">{{trans('backend.permission.create')}}</span>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" class="form-horizontal" action="{{route('permission.store')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('label.permission.name')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-add" id="form_control_1" name="name">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('label.permission.slug')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-add" id="form_control_1" name="slug">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('label.permission.position')}}</label>
                            <div class="col-md-4">
                                <select class="bs-select form-control form-add" data-show-subtext="true" name="position">
                                    <option value="module" data-icon="fa-glass icon-success">模块</option>
                                    <option value="page" data-icon="fa-heart icon-info">页面</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('label.permission.status')}}</label>
                            <div class="col-md-10">
                                <div class="md-radio-inline">
                                    <div class="md-radio has-success">
                                        <input type="radio" id="radio53" name="status" class="md-radiobtn form-add" value="1">
                                        <label for="radio53">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>{{trans('label.status.open')}}</label>
                                    </div>
                                    <div class="md-radio has-error">
                                        <input type="radio" id="radio54" name="status" class="md-radiobtn form-add checked" value="2">
                                        <label for="radio54">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>{{trans('label.status.close')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('label.permission.description')}}</label>
                            <div class="col-md-10">
                                <textarea class="form-control form-add" rows="3" name="description"></textarea>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('label.permission.model')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-add" id="form_control_1" name="model">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('label.permission.permission')}}</label>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                          <div class="col-md-8 col-md-offset-2">
                            <table class="table table-bordered table-striped table-condensed flip-content">
                              <thead class="flip-content">
                                <th>{{trans('label.permission.module')}}</th> 
                                <th>{{trans('label.permission.permission')}}</th>
                              </thead>
                              <tbody>
                                {!! $presenter->showPermissions($permissions) !!}
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn blue">{{trans('button.text.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('themes/metronic//global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script>
  $('.bs-select').selectpicker({
          iconBase: 'fa',
          tickIcon: 'fa-check'
      });
</script>
@endsection