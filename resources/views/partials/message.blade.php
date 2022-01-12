@if (session('error_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h6><i class="fa fa-ban fa-sm mr-2"></i> Gagal!</h6>
        {{ session('error_message') }}
    </div>
@endif
@if (session('warning_message'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h6><i class="fa fa-exclamation-triangle fa-sm mr-2"></i> Perhatian!</h6>
        {{ session('warning_message') }}
    </div>
@endif
@if (session('info_message'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h6><i class="fa fa-info fa-sm mr-2"></i> Info!</h6>
        {{ session('info_message') }}
    </div>
@endif
@if (session('success_message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h6><i class="fa fa-check fa-sm mr-2"></i> Sukses!</h6>
        {{ session('success_message') }}
    </div>
@endif