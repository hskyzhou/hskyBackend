<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-settings font-green-haze"></i>
                    <span class="caption-subject bold uppercase">菜单修改</span>
                </div>
                <div class="actions">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" class="form-horizontal">
                    <input class="form-add" type="hidden" name="parent_menu_id" value="{{$parentMenu->id}}">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">菜单名称</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-add" id="form_control_1" name="title" value="{{$menuInfo->title}}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">父级菜单</label>
                            <div class="col-md-4">
                                <input disabled type="text" class="form-control form-add" id="form_control_1" value="{{$parentMenu->title}}">
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">权限slug</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-add" id="form_control_1" name="slug" value="{{$menuInfo->slug}}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">路由</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-add" id="form_control_1" name="route" value="{{$menuInfo->route}}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>                        

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">状态</label>
                            <div class="col-md-10">
                                <div class="md-radio-inline">
                                    <div class="md-radio has-success">
                                        <input type="radio" id="radio53" name="status" class="md-radiobtn form-add" value="1" @if($menuInfo->status == 1) checked @endif>
                                        <label for="radio53">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>开启</label>
                                    </div>
                                    <div class="md-radio has-error">
                                        <input type="radio" id="radio54" name="status" class="md-radiobtn form-add checked" value="2" @if($menuInfo->status == 2) checked @endif>
                                        <label for="radio54">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>关闭</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">描述</label>
                            <div class="col-md-10">
                                <textarea class="form-control form-add" rows="3" name="description">{{$menuInfo->desc}}</textarea>
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">图标</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-add" id="form_control_1" name="icon" value="{{$menuInfo->icon}}">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button data-url="{{route('menu.update', [$menuInfo->id])}}" type="button" class="btn blue filter-store editMenu">提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  $('.bs-select').selectpicker({
          iconBase: 'fa',
          tickIcon: 'fa-check'
      });
</script>