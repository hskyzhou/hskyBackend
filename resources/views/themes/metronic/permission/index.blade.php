@inject('presenter', 'App\Presenters\Backend\PermissionViewPresenter')
@extends('themes.metronic.common.layout')

@section('css')
	{{-- <link href="{{asset('themes/metronic/global/plugins/domenu/jquery.domenu-0.95.77.css')}}" rel="stylesheet" type="text/css" /> --}}
	<link href="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('themes/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('themes/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
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

<h3 class="page-title">
  <i class="icon-settings font-dark"></i> 
  <span class="caption-subject font-dark sbold uppercase">权限管理</span>
</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a href="{{route('permission.create')}}" class="btn blue btn-outline btn-circle filter-add" data-target='#ajax' data-toggle='modal'>
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs">添加</span>
                        </a>

                        <a data-url="{{route('permission.delete.more')}}" class="btn red btn-outline btn-circle filter-delete-more" href="javascript:;">
                            <i class="fa fa-times"></i>
                            <span class="hidden-xs">删除</span>
                        </a>

                        <a data-url="{{route('permission.restore.more')}}" class="btn green btn-outline btn-circle filter-restore-more" href="javascript:;">
                            <i class="fa fa-reply"></i>
                            <span class="hidden-xs">恢复</span>
                        </a>

                        <a data-url="{{route('permission.destroy.more')}}" class="btn red btn-outline btn-circle filter-full-delete-more" href="javascript:;">
                            <i class="fa fa-ban"></i>
                            <span class="hidden-xs">彻底删除</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="Cancel">Cancel</option>
                            <option value="Cancel">Hold</option>
                            <option value="Cancel">On Hold</option>
                            <option value="Close">Close</option>
                        </select>
                        <button class="btn btn-sm green table-group-action-submit">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <input type="checkbox" class="group-checkable"> </th>
                                <th width="5%">权限名称</th>
                                <th width="5%">slug</th>
                                <th width="5%">描述</th>
                                <th width="5%">位置</th>
                                <th width="5%">创建时间</th>
                                <th width="5%">操作</th>

                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td>
                                  <input type="text" class="form-control form-filter input-sm" name="name">
                                </td>
                                <td>
                                  <input type="text" class="form-control form-filter input-sm" name="slug">
                                </td>
                                <td>
                                  <input type="text" class="form-control form-filter input-sm" name="description">
                                </td>
                                <td>
                                  <input type="text" class="form-control form-filter input-sm" name="position">
                                </td>
                                <td>
                                  <input class="form-control form-control-inline form-filter input-sm date-picker" name="created_at" size="16" type="text" value="" />
                                </td>
                                <td>
                                  <button class="btn green btn-outline filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                  <button class="btn red btn-outline filter-cancel"><i class="fa fa-refresh"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a data-url="{{route('permission.delete.more')}}" class="btn red btn-outline btn-circle filter-delete-more" href="javascript:;">
                            <i class="fa fa-times"></i>
                            <span class="hidden-xs">删除</span>
                        </a>

                        <a data-url="{{route('permission.restore.more')}}" class="btn green btn-outline btn-circle filter-restore-more" href="javascript:;">
                            <i class="fa fa-reply"></i>
                            <span class="hidden-xs">恢复</span>
                        </a>

                        <a data-url="{{route('permission.destroy.more')}}" class="btn red btn-outline btn-circle filter-full-delete-more" href="javascript:;">
                            <i class="fa fa-ban"></i>
                            <span class="hidden-xs">彻底删除</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
@endsection

@section('js')
	{{-- <script src="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script> --}}
	{{-- <script src="{{asset('themes/metronic/global/plugins/domenu/jquery.domenu-0.95.77.min.js')}}" type="text/javascript"></script> --}}

	<script src="{{asset('themes/metronic/global/scripts/datatable.js')}}" type="text/javascript"></script>
	<script src="{{asset('themes/metronic/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('themes/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
  <script src="{{asset('themes/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('themes/metronic//global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

	<script type="text/javascript">
    var table = $("#datatable_ajax");

    /*设置ajax table*/
		var ajaxDatatable = table.DataTable({
			// ajax : 
      searching : false,
      serverSide : true,
      // processing : true,
			ordering : false,
			order : [],
			ajax : {
				url : "{{route('permission.datatables')}}",
				type : "post",
				data: function ( d ) {
          d.name = $(".form-filter[name='name']").val();
          d.slug = $(".form-filter[name='slug']").val();
          d.description = $(".form-filter[name='description']").val();
          d.position = $(".form-filter[name='position']").val();
          d.created_at = $(".form-filter[name='created_at']").val();
       	},
       	beforeSend: function (request) {
        	request.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr('content'));
        }
			},
      drawCallback : function(oSettings) { // run some code on table redraw
        App.initUniform($('input[type="checkbox"]')); // reinitialize uniform checkboxes on each table reload
      },
			columns : [
				{
					data : "checkbox",
          name : "checkbox",
				},
        {
          data : "name",
          name : "name",
        },
        {
          data : "slug",
          name : "slug"
        },
        {
          data : "description",
          name : "description"
        },
        {
          data : "position",
          name : "position"
        },
        {
          data : "created_at",
          name : "created_at"
        },
        {
          data : "button",
          name : "button"
        }
			]
		});

    /*处理表格左侧选中*/
    table.on('change', '.group-checkable', function(){
      var set = table.find('tbody > tr > td:nth-child(1) input[type="checkbox"]');
      var checked = $(this).prop("checked");
      $(set).each(function() {
          $(this).prop("checked", checked);
      });
      $.uniform.update(set);
    });

    table.on('change', 'tbody > tr > td:nth-child(1) input[type="checkbox"]', function(){
      var checked = $(this).prop("checked");
      var parent = table.find('.group-checkable');
      if(checked){
        parent.prop('checked', checked);
      }else{
        var set = $("#datatable_ajax").find('tbody > tr > td:nth-child(1) input[type="checkbox"]');
        var sonChecked = false;
        $(set).each(function(){
          sonChecked = sonChecked || $(this).prop("checked");
        });

        if(!sonChecked){
          parent.prop('checked', checked);
        }
      }
      $.uniform.update(parent);
    })

    $('.date-picker').datepicker({
      autoclose: true,
      format : "yyyy-mm-dd"
    });

    /*搜索*/
    $(document).on('click', '.filter-submit', function(){
      ajaxDatatable.ajax.reload();
    });

    /* 重置 */
    $(document).on("click", ".filter-cancel", function(){
      $('textarea.form-filter, select.form-filter, input.form-filter', table).each(function() {
        $(this).val("");
      });
      $('input.form-filter[type="checkbox"]', table).each(function() {
        $(this).attr("checked", false);
      });
      ajaxDatatable.ajax.reload();
    });

    layer.config({
      btnAlign: 'r',
      closeBtn : 2,
      shadeClose : true,
      anim : 1,
      maxmin : true,
      scrollbar : true,
    });

    $(document).on("click", ".filter-delete", function(){
      $this = $(this);
      var deleteUrl = $this.data('url');
      layer.open({
        title : "删除",
        content: '确定要删除此记录吗(删除记录会放入回收站)?',
        btn: ['确定', '取消'],
        yes: function(index, layero){
          $.ajax({
            url: deleteUrl,
            type: 'post',
            dataType: 'json',
            data: {},
            headers : {
              "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
            },
            success : function(response){
              layer.msg(response.message);
              if(response.result){
                ajaxDatatable.ajax.reload();
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
      return false;
    });

    $(document).on("click", ".filter-full-delete", function(){
      $this = $(this);
      var deleteUrl = $this.data('url');
      layer.open({
        title : "彻底删除",
        content: '确定要彻底删除此记录吗?',
        btn: ['确定', '取消'],
        yes: function(index, layero){
          $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            dataType: 'json',
            data: {},
            headers : {
              "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
            },
            success : function(response){
              layer.msg(response.message);
              if(response.result){
                ajaxDatatable.ajax.reload();
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
      return false;
    });

    $(document).on("click", ".filter-restore", function(){
      $this = $(this);
      var deleteUrl = $this.data('url');
      layer.open({
        title : "恢复",
        content: '确定要恢复此记录吗?',
        btn: ['确定', '取消'],
        yes: function(index, layero){
          $.ajax({
            url: deleteUrl,
            type: 'post',
            dataType: 'json',
            data: {},
            headers : {
              "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
            },
            success : function(response){
              layer.msg(response.message);
              if(response.result){
                ajaxDatatable.ajax.reload();
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
      return false;
    });

    $(document).on("click", ".filter-delete-more", function(){
      $this = $(this);
      var deleteUrl = $this.data('url');

      var set = $("#datatable_ajax").find('tbody > tr > td:nth-child(1) input[type="checkbox"]');
      var ids = [];
      $(set).each(function(){
        $this = $(this);
        if($this.prop("checked")){
          ids.push($this.val());
        }
      });

      if(ids.length == 0){
        layer.msg("请先选中记录");
        return false;
      }

      layer.open({
        title : "删除",
        content: '确定要删除这些记录吗(删除记录会放入回收站)?',
        btn: ['确定', '取消'],
        yes: function(index, layero){
          $.ajax({
            url: deleteUrl,
            type: 'post',
            dataType: 'json',
            data: {
              ids : ids
            },
            headers : {
              "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
            },
            success : function(response){
              layer.msg(response.message);
              if(response.result){
                ajaxDatatable.ajax.reload();
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

    $(document).on("click", ".filter-restore-more", function(){
      $this = $(this);
      var deleteUrl = $this.data('url');

      var set = $("#datatable_ajax").find('tbody > tr > td:nth-child(1) input[type="checkbox"]');
      var ids = [];
      $(set).each(function(){
        $this = $(this);
        if($this.prop("checked")){
          ids.push($this.val());
        }
      });

      if(ids.length == 0){
        layer.msg("请先选中记录");
        return false;
      }

      layer.open({
        title : "恢复",
        content: '确定要恢复这些记录吗?',
        btn: ['确定', '取消'],
        yes: function(index, layero){
          $.ajax({
            url: deleteUrl,
            type: 'post',
            dataType: 'json',
            data: {
              ids : ids
            },
            headers : {
              "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
            },
            success : function(response){
              layer.msg(response.message);
              if(response.result){
                ajaxDatatable.ajax.reload();
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

    $(document).on("click", ".filter-full-delete-more", function(){
      $this = $(this);
      var deleteUrl = $this.data('url');

      var set = $("#datatable_ajax").find('tbody > tr > td:nth-child(1) input[type="checkbox"]');
      var ids = [];
      $(set).each(function(){
        $this = $(this);
        if($this.prop("checked")){
          ids.push($this.val());
        }
      });

      if(ids.length == 0){
        layer.msg("请先选中彻底记录");
        return false;
      }

      layer.open({
        title : "彻底删除",
        content: '确定要彻底删除这些记录吗(全选删除只会删除处于回收站的记录)?',
        btn: ['确定', '取消'],
        yes: function(index, layero){
          $.ajax({
            url: deleteUrl,
            type: 'post',
            dataType: 'json',
            data: {
              ids : ids
            },
            headers : {
              "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
            },
            success : function(response){
              layer.msg(response.message);
              if(response.result){
                ajaxDatatable.ajax.reload();
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

    $(document).on("click", ".filter-store", function(){
      App.blockUI({
        target : ".modal-content"
      });

      $this = $(this);
      var storeUrl = $this.data('href');

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

      $.ajax({
        url: storeUrl,
        type: 'post',
        dataType: 'json',
        data: data,
        headers : {
          "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
        },
        success : function(response){
          App.unblockUI('.modal-content');
          layer.msg(response.message);
          if(response.result){
            $("#ajax").modal('hide');
            ajaxDatatable.ajax.reload();
          }
        },
        error : function(response){
          App.unblockUI('.modal-content');
          if(response.status == '422'){
            var str = '';
            for(var i in response.responseJSON){
              str += response.responseJSON[i][0] + "<br />";
            }
            layer.msg(str);
          }
        }
      });
    });

    $(document).on("click", ".filter-update", function(){
      App.blockUI({
        target : ".modal-content"
      });

      $this = $(this);
      var updateUrl = $this.data('href');

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

      $.ajax({
        url: updateUrl,
        type: 'put',
        dataType: 'json',
        data: data,
        headers : {
          "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')
        },
        success : function(response){
          App.unblockUI('.modal-content');
          layer.msg(response.message);
          if(response.result){
            $("#ajax").modal('hide');
            ajaxDatatable.ajax.reload();
          }
        },
        error : function(response){
          App.unblockUI('.modal-content');
          if(response.status == '422'){
            var str = '';
            for(var i in response.responseJSON){
              str += response.responseJSON[i][0] + "<br />";
            }
            layer.msg(str);
          }
        }
      });
    });
	</script>
@endsection