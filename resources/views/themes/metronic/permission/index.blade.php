@inject('presenter', 'App\ViewPresenters\Backend\PermissionViewPresenter')
@extends('themes.metronic.common.layout')

@section('css')
	{{-- <link href="{{asset('themes/metronic/global/plugins/domenu/jquery.domenu-0.95.77.css')}}" rel="stylesheet" type="text/css" /> --}}
	<link href="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
	
	<style type="text/css">
		
		.content-class{
			cursor : pointer;
		}
	</style>
@endsection

@section('content')
	<!-- END PAGE TITLE-->
	<!-- END PAGE HEADER-->
	<!-- BEGIN DASHBOARD STATS 1-->

	<!-- END DASHBOARD STATS 1-->
	<div class="row">
	    <div class="col-md-10 col-sm-10">
	        <div class="portlet box red">
	            <div class="portlet-title">
	                <div class="caption">
	                    <i class="fa fa-gift"></i>Unordered Lists </div>
	                <div class="tools">
	                    <a href="javascript:;" class="collapse"> </a>
	                </div>
	            </div>
	            <div class="portlet-body">
	            	<div class="row">
		            	<div class="col-md-6 col-sm-6">
										<div class="dd" id="nestable_list_1">
										    <ol class="dd-list">
										    		{!! $presenter->permissionsManage($permissionsManage) !!}
										        {{-- <li class="dd-item dd3-item" data-id="1">
										            <div class="dd-handle dd3-handle"></div>

										            <div class="dd3-content"> 
										            	<span class="content-class">Item 1 </span>
																	<div class="pull-right actions">
																		<a class="btn btn-xs green" style="padding:0 0; margin-bottom: 7px;"><i class="fa fa-plus"></i></a>
																		<a class="btn btn-xs red" style="padding:0 0; margin-bottom: 7px;"><i class="fa fa-times"></i></a>
																	</div>
										            </div>
										        </li>
										        <li class="dd-item dd3-item" data-id="2">
										            <div class="dd-handle dd3-handle"></div>
										            <div class="dd3-content"> Item 2 </div>
										            <ol class="dd-list">
										                <li class="dd-item dd3-item" data-id="3">
										                    <div class="dd-handle dd3-handle"></div>
										                    <div class="dd3-content"> Item 3 </div>
										                </li>
										                <li class="dd-item dd3-item" data-id="4">
										                    <div class="dd-handle dd3-handle"></div>
										                    <div class="dd3-content"> Item 4 </div>
										                </li>
										                <li class="dd-item dd3-item" data-id="5">
										                    <div class="dd-handle dd3-handle"></div>
										                    <div class="dd3-content"> Item 5 </div>
										                    <ol class="dd-list">
										                        <li class="dd-item dd3-item" data-id="6">
										                            <div class="dd-handle dd3-handle"></div>
										                            <div class="dd3-content"> Item 6 </div>
										                        </li>
										                        <li class="dd-item dd3-item" data-id="7">
										                            <div class="dd-handle dd3-handle"></div>
										                            <div class="dd3-content"> Item 7 </div>
										                        </li>
										                        <li class="dd-item dd3-item" data-id="8">
										                            <div class="dd-handle dd3-handle"></div>
										                            <div class="dd3-content"> Item 8 </div>
										                        </li>
										                    </ol>
										                </li>
										                <li class="dd-item dd3-item" data-id="9">
										                    <div class="dd-handle dd3-handle"></div>
										                    <div class="dd3-content"> Item 9 </div>
										                </li>
										                <li class="dd-item dd3-item" data-id="10">
										                    <div class="dd-handle dd3-handle"></div>
										                    <div class="dd3-content"> Item 10 </div>
										                </li>
										            </ol>
										        </li>
										        <li class="dd-item dd3-item" data-id="11">
										            <div class="dd-handle dd3-handle"></div>
						                    <div class="dd3-content"> Item 11 </div>
										        </li>
										        <li class="dd-item dd3-item" data-id="12">
										            <div class="dd-handle dd3-handle"></div>
						                    <div class="dd3-content"> Item 12 </div>
										        </li> --}}
										    </ol>
										</div>

		            		{{-- <div class="dd" id="domenu">
		            		  <button class="dd-new-item">+</button>
		            		  <li class="dd-item dd3-item-blueprint">
		            		    <button class="collapse" data-action="collapse" type="button" style="display: none;">–</button>
		            		    <button class="expand" data-action="expand" type="button" style="display: none;">+</button>
		            		    <div class="dd-handle dd3-handle dd3-handle">Drag</div>
		            		    <div class="dd3-content">
		            		      <span class="item-name">[item_name]</span>
		            		      <div class="dd-button-container">
		            		        <button class="item-add">+</button>
		            		        <button class="item-remove" data-confirm-class="item-remove-confirm">&times;</button>
		            		      </div>
		            		      <div class="dd-edit-box" style="display: none;">
		            		        <input type="text" name="title" autocomplete="off" placeholder="Item"
		            		               data-placeholder="Any nice idea for the title?"
		            		               data-default-value="doMenu List Item. {?numeric.increment}">
		            		        <i class="end-edit">save</i>
		            		      </div>
		            		    </div>
		            		  </li>
		            		  <ol class="dd-list"></ol>
		            		</div> --}}
		            	</div>

		            	<div class="col-md-6 col-sm-6">
		            	   
		            	</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('js')
	<script src="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
	{{-- <script src="{{asset('themes/metronic/global/plugins/domenu/jquery.domenu-0.95.77.min.js')}}" type="text/javascript"></script> --}}

	<script type="text/javascript">
		$(document).ready(function() {
		  $('#nestable_list_1').nestable({
		      group: 1
		  });
		});
	</script>
@endsection