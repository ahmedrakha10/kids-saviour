
<div class="form-group">
    <select name="period" class="form-control" id="period-{{$aqarOrder->id}}" data-id= {{$aqarOrder->id}}>
        <option value="" disabled>{{__('Choose period')}}</option>
        <option value="10" @if($aqarOrder->period == 10) selected @endif>10</option>
        <option value="20" @if($aqarOrder->period == 20) selected @endif>20
        <option value="30" @if($aqarOrder->period == 30) selected @endif>30
        </option>
    </select>
</div>
<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-left"
    };
    $('#period-{{$aqarOrder->id}}').change(function () {

        var period = $(this).val();
        var aqarOrderId = $(this).data('id');

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: 'aqar-orders/' + aqarOrderId + '/change-period',
            data: {'period': period, 'aqar_order_id': aqarOrderId},
            success: function (data) {
                toastr.success(data.message);
            }
        });

    })
</script>
