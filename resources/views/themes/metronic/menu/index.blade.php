@inject("presenter", "App\Presenters\Backend\MenuPresenter")

@extends("themes.metronic.common.layout")

@section('css')
<link href="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('themes/metronic/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('modal')
  <div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Responsive & Scrollable</h4>
        </div>
        <div class="modal-body">
          <img src="../assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
          <span> &nbsp;&nbsp;Loading... </span>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<h3 class="page-title"> Nestable List
  <small>Drag & drop hierarchical list with mouse and touch compatibility</small>
</h3>
<div class="row">
    <div class="col-md-8">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-purple"></i>
                    <span class="caption-subject font-purple sbold uppercase">Nestable List 3</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">New</label>
                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">Returning</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                {!! $presenter->showMenus($manageMenus) !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
<script src="{{asset('themes/metronic//global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script>
	$('#nestable_list_3').nestable().on('change', function(){
    $this = $(this);
    console.log(window.JSON.stringify($this.nestable('serialize')));
  });

  $(document).on('click', '.createMenu', function(){
    var $this = $(this);
    var url = $this.data('url');
    var data = {};

    $('textarea.form-add, select.form-add, input.form-add:not([type="radio"],[type="checkbox"])', $("#ajax")).each(function() {
        data[$(this).attr("name")] = $(this).val();
    });

    $('input.form-add[type="checkbox"]:checked').each(function() {
        data[$(this).attr("name")] = $(this).val();
    });

    // get all radio buttons
    $('input.form-add[type="radio"]:checked').each(function() {
        data[$(this).attr("name")] = $(this).val();
    });

    App.blockUI({
      target : ".modal-content"
    });

    $.ajax({
      url: url,
      type: 'post',
      dataType: 'json',
      data: data,
      headers : {
        "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
      },
    })
    .done(function(response) {
      layer.msg(response.message);
      if(response.result){
        $("#ajax").modal('hide');
      }
    })
    .fail(function(response) {
      if(response.status == '422'){
        var str = '';
        for(var i in response.responseJSON){
          str += response.responseJSON[i][0] + "<br />";
        }
        layer.msg(str);
      }
    })
    .always(function(){
      App.unblockUI(".modal-content");
    })
  });

  $(document).on('click', '.editMenu', function(){
    var $this = $(this);
    var url = $this.data('url');
    var data = {};

    $('textarea.form-add, select.form-add, input.form-add:not([type="radio"],[type="checkbox"])', $("#ajax")).each(function() {
        data[$(this).attr("name")] = $(this).val();
    });

    $('input.form-add[type="checkbox"]:checked').each(function() {
        data[$(this).attr("name")] = $(this).val();
    });

    // get all radio buttons
    $('input.form-add[type="radio"]:checked').each(function() {
        data[$(this).attr("name")] = $(this).val();
    });

    App.blockUI({
      target : ".modal-content"
    });

    $.ajax({
      url: url,
      type: 'put',
      dataType: 'json',
      data: data,
      headers : {
        "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
      },
    })
    .done(function(response) {
      layer.msg(response.message);
      if(response.result){
        $("#ajax").modal('hide');
      }
    })
    .fail(function(response) {
      if(response.status == '422'){
        var str = '';
        for(var i in response.responseJSON){
          str += response.responseJSON[i][0] + "<br />";
        }
        layer.msg(str);
      }
    })
    .always(function(){
      App.unblockUI(".modal-content");
    })
  });

  $(document).on('click', '.deleteMenu', function(){
    $this = $(this);
    var url = $this.data('url');
    layer.open({
      title : "删除",
      content: '确定要删除此记录吗(记录会直接删除)?',
      btn: ['确定', '取消'],
      yes: function(index, layero){
        $.ajax({
          url: url,
          type: 'delete',
          dataType: 'json',
          data: {},
          headers : {
            "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
          },
          success : function(response){
            layer.msg(response.message);
            if(response.result){
            }
          },
          error : function(response){
            layer.close(index);
          }
        });
      },
      no: function(index, layero){
        layer.close(index);
      },
      cancel: function(index, layero){ 
        layer.close(index);
      }
    });
  });
</script>
@endsection