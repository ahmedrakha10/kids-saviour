{{--<h5><span class="badge badge-primary">{{optional($aqarOrder->adsType)->name}}</span></h5>--}}
<?php
$packages =  \App\Models\AdsType::all();
?>
<div class="form-group">
    <select name="ads_type_id" class="form-control" id="change-{{$aqarOrder->id}}" data-id = {{$aqarOrder->id}}>
        <option value="" disabled>{{__('Choose package')}}</option>
        @foreach ($packages as $package)
            <option
                value="{{ $package->id }}" {{ $package->id == $aqarOrder->adsType->id ? 'selected' : '' }}>{{ $package->name }}</option>
        @endforeach
    </select>
</div>
<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-left"
    };
    $('#change-{{$aqarOrder->id}}').change(function () {

        var packageId = $(this).val();
        var aqarOrderId = $(this).data('id');

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: 'aqar-orders/' + aqarOrderId + '/change-package',
            data: {'ads_type_id': packageId, 'aqar_order_id': aqarOrderId},
            success: function (data) {
                toastr.success(data.message);
            }
        });

    })
</script>
