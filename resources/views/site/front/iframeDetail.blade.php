<!doctype html>
<html lang="en">
  <head>
    <title>Image</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
    <!--Fancybox-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" />
    <!--CSS Other-->
    <style type="text/css">
        img {
            background: #fff;
            border: solid 1px #ccc;
            padding: 4px;
        }
    </style>
  </head>
  <body>
    <div class="alert alert-primary" role="alert" style="font-size: 25px;font-weight: 600">
        {{$name}}
    </div>
    <div class="container text-center d-flex justify-content-center">
        <p class="imglist" style="max-width: 550px;">
            <!-- Desktop -->
            <a data-fancybox-trigger="preview" class="d-none d-sm-none d-md-block d-lg-block">
                <img src="{{ asset('images/front/room/'.$imgPre->image) }}" width="500" height="300" class="mb-3 border border-secondary" />
            </a>            
            <!-- Mobile -->
            <a data-fancybox-trigger="preview" class="d-block d-xl-none d-lg-none d-md-none">
                <img src="{{ asset('images/front/room/'.$imgPre->image) }}" width="285" height="200" class="mb-3 border border-secondary" />
            </a> 
            
            @foreach($img as $row)
            <a href="{{ asset('images/front/room/'.$row->image) }}" data-fancybox="preview" data-width="1500" data-height="1000">
                <img src="{{ asset('images/front/room/'.$row->image) }}" width="120" height="80" class="mb-2 mr-2 border border-secondary" />
            </a>
            @endforeach

        </p>
    </div>  

    <div class="container text-center d-flex justify-content-center">
        <div class="alert alert-success col-lg-5 col-md-12 col-sm-12" role="alert" style="font-size: 25px;font-weight: 600">
            สิ่งอำนวยความสะดวก
        </div>
    </div>
    <div class="container text-center d-flex justify-content-center">
        <table class="table table-sm">
            <thead>
                <tr class="d-flex justify-content-center">
                    <th class="col-lg-1 col-md-1 col-sm-1">#</th>
                    <th class="col-lg-5 col-md-12 col-sm-12">รายการ</th>
                </tr>
            </thead>
            <tbody>
                @if($sup->count()==0)
                <tr class="d-flex justify-content-center">
                    <th class="col-lg-1 col-md-1 col-sm-1">-</th>
                    <td class="col-lg-5 col-md-12 col-sm-12">-</td>
                </tr>
                @endif
                @foreach($sup as $key => $row)
                <tr class="d-flex justify-content-center">
                    <th class="col-lg-1 col-md-1 col-sm-1">{{ $key+1 }}</th>
                    <td class="col-lg-5 col-md-12 col-sm-12">{{ $row->classrooms_support }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container text-center d-flex justify-content-center mt-5">
        <div class="alert alert-success col-lg-5 col-md-12 col-sm-12" role="alert" style="font-size: 25px;font-weight: 600">
            ซอฟแวร์ที่ใช้งานได้
        </div>
    </div>
    <div class="container text-center d-flex justify-content-center mb-5">
        <table class="table table-sm">
            <thead>
                <tr class="d-flex justify-content-center">
                    <th class="col-lg-1 col-md-1 col-sm-1">#</th>
                    <th class="col-lg-5 col-md-12 col-sm-12">รายการ</th>
                </tr>
            </thead>
            <tbody>
                @if($sof->count()==0)
                <tr class="d-flex justify-content-center">
                    <th class="col-lg-1 col-md-1 col-sm-1">-</th>
                    <td class="col-lg-5 col-md-12 col-sm-12">-</td>
                </tr>
                @endif
                @foreach($sof as $key => $row)
                <tr class="d-flex justify-content-center">
                    <th class="col-lg-1 col-md-1 col-sm-1">{{ $key+1 }}</th>
                    <td class="col-lg-5 col-md-12 col-sm-12">{{ $row->softwares }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  </body>
</html>