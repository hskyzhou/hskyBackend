@inject('presenter', 'App\Presenters\Backend\PermissionViewPresenter')
@extends('themes.metronic.common.layout')

@section('css')
	{{-- <link href="{{asset('themes/metronic/global/plugins/domenu/jquery.domenu-0.95.77.css')}}" rel="stylesheet" type="text/css" /> --}}
	<link href="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('themes/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('themes/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />

	
	<style type="text/css">
		
		.content-class{
			cursor : pointer;
		}
	</style>
@endsection

@section('content')

<h3 class="page-title"> Ajax Datatables
    <small>basic datatable samples</small>
</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="note note-danger">
            <p> NOTE: The below datatable is not connected to a real database so the filter and sorting is just simulated for demo purposes only. </p>
        </div>
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Ajax Datatable</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn red btn-outline btn-circle btn-delete-more" href="javascript:;">
                            <i class="fa fa-times"></i>
                            <span class="hidden-xs">删除</span>
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
                                  <button class="btn green btn-outline filter-submit margin-bottom"><i class="fa fa-search"></i>搜索</button>
                                  <button class="btn red btn-outline filter-cancel"><i class="fa fa-times"></i>重置</button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn red btn-outline btn-circle btn-delete-more" href="javascript:;">
                            <i class="fa fa-times"></i>
                            <span class="hidden-xs">删除</span>
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


	<script type="text/javascript">
		$(document).ready(function(){
			var ajaxDatatable = $("#datatable_ajax").DataTable({
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
				columns : [
					{
						data : "id",
            name : "id",
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
        $(".form-filter").val('');
      });

		});
	</script>
@endsection