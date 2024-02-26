function toggleBoolean(el, url) {
    Swal.fire({
        title: "تفعيل",
        text: 'هل أنت متأكد من تعديل التفعيل',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
    }).then((result) => {
        if (!result.dismiss && result.value == true) {
            var checked = $(el).is(':checked');
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    if (data.status === 0) {
                        $(el).prop('checked', !checked);
                        $(el).next().remove();
                        initSingleSwitchery(el);
                        $("#removable" + data.id).remove();
                        Swal.fire("خطأ!", data.message, "error");
                    }
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: 'تم التعديل بنجاح',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }, error: function () {
                    $(el).prop('checked', !checked);
                    $(el).next().remove();
                    initSingleSwitchery(el);
                    Swal.fire("خطأ!", "حدث خطأ", "error");
                }
            });
        } else {
            $(el).prop('checked', !checked);
            $(el).next().remove();
            initSingleSwitchery(el);
            location.reload();
        }
    })
}