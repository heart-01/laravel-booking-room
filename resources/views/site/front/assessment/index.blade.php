@extends('layouts.front')

@section('sidebar')
  <hr style="margin-top: 65px;">
@endsection

@section('content')
<!-- TailwindCSS -->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">

<div class="container">
  <div class="row text-center">   
    <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
      <h1 class=" title-font mb-2 text-4xl font-extrabold leading-10 tracking-tight text-left sm:text-5xl sm:leading-none md:text-4xl"> แบบประเมินความพึงพอใจ <?php echo App\Semesters::term_year($semesters); ?></h1>
    </div>
    @foreach($data_Assessment_form as $row)
        <div class="col-12">                  
            <div class="btn-group">
                <button type="button" onclick="window.location.href='{{ url('/assessment/question/'.Crypt::encrypt($row->assessment_form_id).'/'.$row->classrooms['classrooms'].'/'.$row->classrooms['numbers']) }}'" class="btn btn-secondary mb-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline motion-safe:hover:scale-110 bg-purple-700 hover:bg-violet-500 text-white font-normal py-2 px-4 mr-1 transform hover:-translate-y-1 hover:scale-110 rounded">
                    {{ $row->classrooms['classrooms'] }} {{ $row->classrooms['numbers'] }}
                </button>
            </div>
        </div>
    @endforeach
  </div>
</div>

@if (session()->has('Warning'))
<script>
    Swal.fire("<span class='kanin'><?php echo session()->get('Warning'); ?></span>", "", "warning");
</script>
@endif

@endsection

@section('footer')
  
@endsection