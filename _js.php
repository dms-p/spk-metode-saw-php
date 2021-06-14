
    <!-- JavaScript -->
    <script src="template/vali-admin/js/jquery-3.3.1.min.js"></script>
    <script src="template/vali-admin/js/popper.min.js"></script>
    <script src="template/vali-admin/js/bootstrap.min.js"></script>
    <script src="template/vali-admin/js/main.js"></script>
    <script src="template/vali-admin/js/plugins/pace.min.js"></script>
    <script src="template/vali-admin/js/plugins/jquery.dataTables.min.js"></script>
    <script src="template/vali-admin/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        // DataTable
        var datatable = $("#datatable").DataTable({
            "language": {
                "lengthMenu": "Menampilkan _MENU_ data",
                "zeroRecords": "Data tidak tersedia",
                "info": "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
                "infoEmpty": "Data tidak ditemukan",
                "infoFiltered": "(Terfilter dari total _MAX_ data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "previous": "<",
                    "next": ">",
                },
                "processing": "Memproses data..."
            },
            columnDefs: [
                {orderable: false, targets: -1},
            ],
            order: []
        });
        datatable.on('draw.dt', function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Button Add
        $(document).on("click", ".btn-add", function(event){
            event.preventDefault();
            $("#modal-add").modal("show");
        });

        // Button Detail
        $(document).on("click", ".btn-detail", function(event){
            event.preventDefault();
            var id = $(this).data("id");
            var a = $(this).data("a");
            var b = $(this).data("b");
            var op = $(this).data("op");
            $.ajax({
                type: "GET",
                url: "proses/getdata.php",
                data: {id: id, a: a, b: b, op: op},
                dataType: "JSON",
                success: function(e){
                    if(op == 'bobot' || op == 'nilai'){
                        // Disabled
                        var disabledKeys = Object.keys(e.disabled);
                        for(i=0; i<disabledKeys.length; i++){
                            $("#modal-detail").find("#"+disabledKeys[i]).val(e.disabled[disabledKeys[i]]);
                        }
                        // Enabled
                        $(e.enabled).each(function(key,data){
                            var enabledKeys = Object.keys(data);
                            for(i=0; i<enabledKeys.length; i++){
                                $("#modal-detail").find("#"+enabledKeys[i]+"-"+key).val(data[enabledKeys[i]]);
                            }
                        });
                    }
                    $("#modal-detail").modal("show");
                }
            });
        });

        // Button Edit
        $(document).on("click", ".btn-edit", function(event){
            event.preventDefault();
            var id = $(this).data("id");
            var a = $(this).data("a");
            var b = $(this).data("b");
            var op = $(this).data("op");
            $.ajax({
                type: "GET",
                url: "proses/getdata.php",
                data: {id: id, a: a, b: b, op: op},
                dataType: "JSON",
                success: function(e){
                    if(op == 'bobot' || op == 'nilai'){
                        // Disabled
                        var disabledKeys = Object.keys(e.disabled);
                        for(i=0; i<disabledKeys.length; i++){
                            $("#modal-edit").find("#"+disabledKeys[i]).val(e.disabled[disabledKeys[i]]);
                        }
                        // Enabled
                        $(e.enabled).each(function(key,data){
                            var enabledKeys = Object.keys(data);
                            for(i=0; i<enabledKeys.length; i++){
                                $("#modal-edit").find("#"+enabledKeys[i]+"-"+key).val(data[enabledKeys[i]]);
                            }
                        });
                    }
                    else{
                        var keys = Object.keys(e);
                        for(i=0; i<keys.length; i++){
                            $("#modal-edit").find("#"+keys[i]).val(e[keys[i]]);
                        }
                    }
                    $("#modal-edit").modal("show");
                }
            });
        });

        // Button Delete
        $(document).on("click", ".btn-delete", function(event){
            event.preventDefault();
            var id = $(this).data("id");
            var a = $(this).data("a");
            var b = $(this).data("b");
            var op = $(this).data("op");
            var confirm = window.confirm("Apakah Anda yakin ingin menghapus data ini?");
            if(confirm){
                $.ajax({
                    type: "POST",
                    url: "proses/proseshapus.php",
                    data: {id: id, a: a, b: b, op: op},
                    dataType: "JSON",
                    success: function(e){
                        if(e == 'success'){
                            alert('Berhasil Menghapus Data!');
                            setTimeout(function () {
                                location.reload();
                            },100);
                        } else{
                            alert('Gagal Menghapus Data '+e);
                        }
                    }
                });
            }
        });

        // Categorize
        $(document).on("change", "#categorize", function(){
            var id = $(this).val();
            var op = $(this).data("op");
            $.ajax({
                type: "GET",
                url: "proses/proseslihat.php",
                data: {id: id, op: op},
                success: function(e){
                    $("#datatable tbody").html(e);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });

        // Close Modal Event 
        $(".modal").on('hidden.bs.modal', function(event){
            $("input[name=id], input.form-control, select.form-control").val(null);
        });

        // Submit Form Add / Edit
        $("form.form").on("submit", function(event){
            event.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "JSON",
                success: function(e){
                    if(e == 'success'){
                        alert('Berhasil Memasukan Data!');
                        setTimeout(function () {
                            location.reload();
                        },100);
                    } else if (e == 'ada data'){
                        alert('Data Tidak Boleh Sama!');
                    } else if (e == 'failed'){
                        alert('Gagal Memasukan data!');
                    } else{
                        alert('Berhasil Update Data!');
                        window.location.href = e;
                    }
                }
            })
        });

        // Generate SAW
        $("#generate-saw").change(function() {
            var value = $(this).val();
            $("#result-saw").hide("slow");
            document.cookie = "pilih="+value+";expires=3600;path=/";
            if (getCookieData) {
                $("#result-saw").load("./hasil.php").slideToggle("slow");
            }
        });

        function getCookieData(){
            var data=getCookie("pilih");
            if (data==null && data=="") {
                return false;
            }else{
                return true;
            }
        }

        // Login
        $(document).on("submit", "#form-login", function(event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url: url,
                data: data,
                dataType: 'JSON',
                type: 'POST',
                success: function(e){
                    if (e == 'success') {
                        location.reload();
                    } else{
                        $('#alert-message').html(e);
                        $('#alert').slideDown('slow', function() {
                            setTimeout(function () {
                                location.reload();
                            }, 5000);
                        });
                    }
                }
            });
        });

        // Logout        
        $(document).on("click", "a#out", function(event){
            // event.preventDefault();
            var confirm = window.confirm("Apakah anda ingin keluar ?");
            if(confirm == true){
                return true;
            } else{
                return false;
            }
        });
    </script>

    <script>
    // Button Toggle Password
    $(document).on("click", ".btn-toggle-password", function(e){
        e.preventDefault();
        if(!$(this).hasClass("show")){
            $(this).parents(".form-group").find("input[type=password]").attr("type","text");
            $(this).find(".fa").removeClass("fa-eye").addClass("fa-eye-slash");
            $(this).addClass("show");
        }
        else{
            $(this).parents(".form-group").find("input[type=text]").attr("type","password");
            $(this).find(".fa").removeClass("fa-eye-slash").addClass("fa-eye");
            $(this).removeClass("show");
        }
    });
    </script>