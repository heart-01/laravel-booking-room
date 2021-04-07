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
    <!-- Sweet Alert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!--CSS Other-->
    <style type="text/css">
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
            font-size: 20px;
            text-align: center;            
        }
        #list li{
            background-color: rgb(131, 176, 243);
        }
        #selc li{
            background-color: rgb(63, 187, 90);
            color: white;
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
    <div class="alert alert-success" role="alert">
      <p style="font-size: 25px;font-weight: 600" >
        <i class="fas fa-broom"></i> สิ่งอำนวยความสะดวก 
      </p>
      {{$name}}
    </div>

    <div class="container-fluid">  
      <div class="row">
        <div class="text-left col-9">
            <h5>สิ่งอำนวยความสะดวก 10 รายการ</h5>
        </div>
        <div class="text-right col-3">
            <button class="btn btn-block btn-success" id="btnSave">
              <i class="fas fa-save"></i> บันทึก
            </button>
        </div>
      </div>

      {{-- Classroom Support --}}
      <div class="d-flex justify-content-center mt-3">
        {{-- Classroom Support All --}}
        <div style="position: absolute;left: 50px;" ><b style="font-size: 25px;">รายการ</b></div>
        <fieldset id="left" class="text-center mt-5">
            <ul id="list" class="sortable">
              @foreach($data1 as $row)
                <li>
                  <p>{{ $row->classrooms_support }}</p>
                  <?= Form::hidden('classrooms_support_id[]', $row->classrooms_support_id); ?>
                  <?= Form::hidden('classrooms_id', $id); ?>  
                </li>
              @endforeach
            </ul>
        </fieldset>
        {{-- End Classroom Support --}}

        {{-- Classroom Support Selc --}}
        <div style="position: absolute;left: 350px;" ><b style="font-size: 25px;">เลือกรายการ</b></div>
        <fieldset id="right" class="text-center mt-5">
            <?= Form::open(array('route' => 'addSupport.store','files' =>true)) ?>
            <ul id="selc" class="sortable">
              @foreach($data2 as $row)
                <li>
                  <p>{{ $row->classrooms_support }}</p>
                  <?= Form::hidden('classrooms_support_id[]', $row->classrooms_support_id); ?>
                  <?= Form::hidden('classrooms_id', $id); ?>  
                </li> 
              @endforeach
            </ul>
            <button type="submit" id="btnfrmSelc">Save</button>
            <?= Form::close() ?>
        </fieldset>   
        {{-- End Classroom Support Selc --}}   
      </div>
      {{-- End Classroom Support --}}
    </div>
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
        //Support All         
        $("#list").sortable({
            cursor: "move",
            connectWith:"#selc",
        });

        //Support Selc 
        $("#selc").sortable({
            cursor: "move",
            connectWith:"#list",
        });
        // Save Preview image
        $('#btnfrmSelc').hide();
        $('#btnSave').click(function(){
            if($('#selc li').length > 0){
                $('#btnfrmSelc').trigger('click');
            }else{
                Swal.fire("<span class='kanin'>กรุณาเลือกรายการสิ่งของ</span>", "", "warning");
            }                
        });
    });    
  </script>
</html>