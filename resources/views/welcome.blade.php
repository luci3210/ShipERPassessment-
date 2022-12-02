<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ShipERP</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>


    </head>

    <style>
        h1 {
            margin-top: 25px;
            text-align: center;
        }
        .container_form {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .aln_action{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container_table{
            margin-top: 25px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form {
            width: 30%;
        }
        .table{
            width: 30%;
        }
        .form input {
            width: 98.1%;
            height: 30px;
        }
        input {
            margin-bottom: 18px;
        }
        .btl_insert {
            width: 100%;
            height: 40px;
            background: lightblue;
        }
        .btn_update {
             width: 100%;
            height: 40px;
            background: pink;
            margin-top: 5px;
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
        }
        table {
            width: 100%;
        }
        table,tr, th, td {
            border: 1px solid black;
        }

    </style>

    <body>

    <h1>ShipERP Assessment</h1>

    <div class="container_form">
        <div class="form">
            <input type="hidden" name="" id="edit_id">
            <input type="text" name="" class="imgpro" id="edit_pro">
            <input type="text" name="" class="imgurl" id="edit_url">
            <button class="btl_insert" >Save</button>
            <button class="btn_update" >Update</button>
        </div>
    </div>

    <div class="container_table">
    <div class="table">
        <table>
        <thead>
          <tr>
            <th>Mame</th>
            <th>Image</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
          <tbody>
          </tbody>
        </table>
    </div>
    </div>


<script type="text/javascript">

  $(document).ready(function () {

    $(document).on('click','.btl_insert',function(e){
        e.preventDefault();

        var data = {
            'imgpro': $('.imgpro').val(),
            'imgurl': $('.imgurl').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"POST",
            url: "{{ url('/api/save') }}",
            data: data,
            dataType: "json",
            success: function(response ) {
                console.log(response);
                fetcherpdetails();
            }
        });
    });


    fetcherpdetails();

    function fetcherpdetails() {

        $.ajax({
            type:"GET",
            url: "{{ url('/api/erpdetails') }}",
            dataType:"json",
            success: function (response) {
                $('table tbody').html("");
                $.each(response, function (key, item) {
                    $('table tbody').append('<tr><td>'+ item.imgpro +'</td><td><img src="'+ item.imgurl +'"></td><td class="aln_action"><button type="button" value="'+ item.id +'" class="btn_edit">Edit</button></td><td><button type="button" value="'+ item.id +'" class="btn_delete">Delete</button></td></tr>');
                });
            }

        });
    }


    $(document).on('click','.btn_edit', function(e) {
        e.preventDefault();
        var valueid = $(this).val();

        $.ajax({
            type: "GET",
            url: "/api/erpedit/"+valueid,
            success: function(response) {
                // console.log(response);
                $('#edit_id').val(valueid);
                $('#edit_pro').val(response.imgpro);
                $('#edit_url').val(response.imgurl);
            }
        });
    });


    $(document).on('click','.btn_delete', function(e) {
        e.preventDefault();
        var valueid = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "DELETE",
            url: "/api/erpdelete/"+valueid,
            success: function(response) {
                // console.log(response);
                fetcherpdetails();
            }
        });
    });




    $(document).on('click','.btn_update', function(e) {
        e.preventDefault();
        var valueid = $('#edit_id').val();
        var data = {
            'imgpro' : $('#edit_pro').val(),
            'imgurl' : $('#edit_url').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "/api/erpupdate/"+valueid,
            data: data,
            dataType: "json",
            success: function(response) {
                fetcherpdetails();
            }
        });

    });

  });

</script>

    </body>
</html>
