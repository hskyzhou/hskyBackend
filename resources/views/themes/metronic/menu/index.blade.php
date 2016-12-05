@inject("presenter", "App\Presenters\Backend\MenuPresenter")

@extends("themes.metronic.common.layout")

@section('css')
<link href="{{asset('themes/metronic/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
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
<script>
	$('#nestable_list_3').nestable().on('change', function(){
    $this = $(this);
    console.log(window.JSON.stringify($this.nestable('serialize')));
  });

  $(document).on('click', '.editMenu', function(){

  });

  $(document).on('click', '.deleteMenu', function(){

  });
</script>
@endsection