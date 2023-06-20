<div class="toggle-flip">
    <label>
        <input class="toggle" id="change-{{$user->id}}" type="checkbox" {{$user->status ? 'checked' : ''}}  data-id= {{$user->id}}>
        <span class="flip-indecator" data-toggle-on="{{__('Active')}}" data-toggle-off="{{__('De-active')}}"></span>

    </label>
</div>
<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-left"
    };
    $('#change-{{$user->id}}').change(function () {
        var status = $(this).prop('checked') === true ? 1 : 0;
        var userId = $(this).data('id');
        //console.log(userId);
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: 'users/' + userId + '/change-status',
            data: {'status': status, 'user_id': userId},
            success: function (data) {
                toastr.success(data.message);
            }
        });
    })
</script>
