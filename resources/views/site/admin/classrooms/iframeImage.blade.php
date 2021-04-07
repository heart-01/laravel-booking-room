<!doctype html>
<html lang="en">
  <head>
    <title>Image</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
    <!--Fancybox-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" />
    <!-- Sweet Alert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!--CSS Other-->
    <style type="text/css">
        img {
            background: #fff;
            border: solid 1px #ccc;
            padding: 4px;
        }
        .kanin {
            font-family: 'Kanit', sans-serif;
        }
        fieldset ul{
            list-style-type: none;
            width: 170px;
            height: 480px;
        }
        fieldset ul li{
            height: 35px;
            width: 150px;
            margin: 2px;
            margin-bottom: 50px;
            font-size: 20px;
            text-align: center;            
        }
        fieldset{
            margin: 30px;
            width: 200px;
            height: 500px;
            padding-right: 230px;
            border: 2px solid black;
        }
    </style>
  </head>
  <body class="kanin" style="max-width: 645px;">
    <div class="alert alert-info" role="alert">
        <p style="font-size: 25px;font-weight: 600;" >
            <i class="fas fa-images"></i> รูปภาพ
        </p>
        {{$name}}
    </div>
    
    <div class="container-fluid">  
        {{-- button --}}
        <div class="row">
            <div class="text-right col-3">
                <button class="btn btn-block" id="btnAdd" data-toggle="modal" data-target="#addImg" style="background-color: #260176;color:white">
                    <i class="fas fa-plus-circle"></i> เพิ่ม
                </button>
            </div>
            <div class="col-6"></div>
            <div class="text-right col-3">
                <button class="btn btn-block btn-success" id="save">
                <i class="fas fa-save"></i> บันทึก
                </button>
            </div>
            <div class="text-left col-3 mt-3">
                <button class="btn btn-block text-white btn-warning" id="btnEdit">
                    <i class="fas fa-pencil-alt"></i> แก้ไข
                </button>
            </div>
            <div class="col-6"></div>
            <div class="text-right col-3 mt-3">
                <button class="btn btn-block btn-danger" id="btnDel">
                    <i class="fas fa-trash"></i> ลบ
                </button>
            </div>
        </div>
        {{-- End button --}}

        {{-- Image --}}
        <div class="d-flex justify-content-center mt-3">
            {{-- Image All --}}
            <div style="position: absolute;left: 50px;" ><b style="font-size: 25px;">รายการ</b></div>
            <fieldset id="left" class="text-center mt-5">
                <?= Form::open(array('route' => 'addImage.delImg','files' =>true)) ?>
                <ul id="list" class="sortable">
                    @foreach($data1 as $row)
                    <li>  <input class="form-check-input position-static ck_img" name="ck_img[]" type="checkbox" value="{{ $row->image }}" >
                        <a href="{{ asset('images/front/room/'.$row->image) }}" data-fancybox="preview" data-width="1500" data-height="1000">
                            <img src="{{ asset('images/front/room/'.$row->image) }}" width="120" height="80" class="mb-2 mr-2 border border-secondary" alt="image" />
                            <?= Form::hidden('img', $row->image); ?>
                            <?= Form::hidden('classrooms_id', $id); ?>  
                        </a>
                    </li>
                    @endforeach
                </ul>
                <button type="submit" id="btnfrmDelImg">Save</button>
                <?= Form::close() ?>
            </fieldset>
            {{-- End Image All --}}

            {{-- Image Preview --}}
            <div style="position: absolute;left: 350px;" ><b style="font-size: 25px;">รูปภาพหลัก</b></div>
            <fieldset id="right" class="text-center mt-5">
                <?= Form::open(array('route' => 'addImage.preview','files' =>true)) ?>
                <ul id="selc" class="sortable">
                    @foreach($data2 as $row)
                    <li class="s_img"> <input class="form-check-input position-static ck_img" name="ck_img[]" type="checkbox" value="{{ $row->image }}" >
                        <a href="{{ asset('images/front/room/'.$row->image) }}" data-fancybox="preview" data-width="1500" data-height="1000">
                            <img src="{{ asset('images/front/room/'.$row->image) }}" width="120" height="80" class="mb-2 mr-2 border border-secondary" alt="image" />
                            <?= Form::hidden('img', $row->image); ?>
                            <?= Form::hidden('classrooms_id', $id); ?>  
                        </a>
                    </li>
                    @endforeach
                </ul>
                <button type="submit" id="btnfrmPreview">Save</button>
                <?= Form::close() ?>
            </fieldset>    
            {{-- End Image Preview --}}  
        </div>
        {{-- End Image --}}

        {{-- Modal --}}
        <div class="modal" id="addImg" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                  <h5 class="modal-title"><i class="fas fa-images"></i> เพิ่มรูปภาพ</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?= Form::open(array('route' => 'addImage.store','id' => 'frmAdd','files' =>true)) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <?= Form::file('img', ['class' =>'mt-2 mb-2', 'id'=> 'img' ,'required']); ?>
                        <?= Form::hidden('classrooms_id', $id, ['id' => 'classrooms_id'],); ?>  
                        <?= Form::hidden('numbers', $numbers, ['id' => 'numbers'],); ?>  
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>       
                  <button type="submit" id="btnfrmAdd" class="btn btn-success text-white"><i class="fas fa-sign-in-alt"></i> Save</button>
                </div>
                <?= Form::close() ?>
              </div>
            </div>
        </div>
        {{-- End Modal --}}
    </body>
    @if (session()->has('Success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: "<span class='kanin'><?php echo session()->get('Success'); ?></span>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    @elseif (session()->has('Warning'))
        <script>
            Swal.fire("<span class='kanin'><?php echo session()->get('Warning'); ?></span>", "", "warning");
        </script>
    @endif

    <script>
        $(document).ready(function(){
            // btnDel
            $('#btnfrmDelImg').hide();    
            $("#btnDel").click(function(){
                var ck_img = $(".ck_img:checked").length;
                var selc = $('#selc li').length;
                if(selc<=0){
                    Swal.fire("<span class='kanin'>กรุณาเลือกรูปภาพหลัก 1 รูป</span>", "", "warning");
                }else if(ck_img<=0){
                    Swal.fire("<span class='kanin'>กรุณาเลือกรูปภาพที่ต้องการลบ</span>", "", "warning");
                }else{                
                    Swal.fire({
                        title: "<span class='kanin'>ต้องการลบรูปภาพ <span style='color:#d33'>\n\""+ck_img+"\"</span> รูป ใช่หรือไม่ ??</span>",
                        text: "", 
                        icon: "warning",
                        iconColor: '#d33',
                        width: 700,
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'ตกลง',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'ยกเลิก'
                    })
                    .then((result) => {
                        $('#btnfrmDelImg').trigger('click');
                    });
                }
                return false;
            });

            // btnEdit show hide
            $('.ck_img').hide(); 
            $('#btnDel').hide();
            $('#btnEdit').click(function(){
                $('#btnDel').toggle(); 
                if($("#btnDel").is(":visible")){
                    $(".sortable").sortable("disable");
                    $('#btnAdd').prop('disabled', true);
                    $('#save').prop('disabled', true);
                    $('.ck_img').hide();
                    $('#list .ck_img').show();
                    $('#btnDel').show();
                }else if($("#btnDel").is(":hidden")){
                    $(".sortable").sortable("enable");
                    $('#btnAdd').prop('disabled', false);
                    $('#save').prop('disabled', false);
                    $('.ck_img').hide();
                    $('#btnDel').hide();
                }   
            });  

            // Image All
            $("#list").sortable({
                cursor: "move",
                connectWith:"#selc",
                handle: function(e) {
                    $('#list .s_img').removeClass("s_img");
                },
                receive: function(ev, ui) {
                    if(ui.item.hasClass("back")){
                        ui.sender.sortable("cancel");
                    }
                },
            });

            // Preview image
            $("#selc").sortable({
                cursor: "move",
                connectWith:"#list",
                receive: function(ev, ui) {
                    if(ui.item.hasClass("back")){
                        ui.sender.sortable("cancel");
                    }else if($('#selc li').length == 1){
                        $('#selc li').addClass('s_img');
                    }else if($('#selc li').length > 1){
                        // get
                        var li_list = $('#selc .s_img').closest('li')[0].outerHTML;
                        $("#list").append(li_list);
                        $("#list").sortable('refresh');
                        // del
                        $('#selc').empty();
                        // create
                        var li_selc = $("<li class='ui-state-default s_img' />").html(ui.item.html());
                        $("#selc").append(li_selc);
                        $("#selc").sortable('refresh');
                    }
                },
            });
            // Save Preview image
            $('#btnfrmPreview').hide();
            $('#save').click(function(){
                if($('#selc li').length == 1){
                    $('#btnfrmPreview').trigger('click');
                }else{
                    Swal.fire("<span class='kanin'>กรุณาเลือกรูปภาพหลัก 1 รูป</span>", "", "warning");
                }                
            });

            // validation image
            $('#img').change( function(e) {
                var files = this.files[0];
                var n = files.name,
                    s = files.size,
                    t = files.type.split('/')[0];
                if (t!="image") {
                    Swal.fire("<span class='kanin'>Please select image file type.</span>", "", "warning");
                    $('#btnfrmAdd').prop('disabled', true);
                    $(this).css("border", "#FF0000 solid 2px");     
                    return false;  
                }else if (s > 1048576) { //1MB
                    Swal.fire("<span class='kanin'>Please deselect this \nfile: "+n+" it\'s larger than the maximum filesize allowed. Sorry!</span>", "", "warning");
                    $('#btnfrmAdd').prop('disabled', true);
                    $(this).css("border", "#FF0000 solid 2px");     
                    return false;       
                }
                $('#btnfrmAdd').prop('disabled', false);
            });

        });    
    </script>
</html>