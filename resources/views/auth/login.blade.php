@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #28a745;"><i class="fas fa-unlock mr-1"></i> เข้าสู่ระบบ</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="Username" class="col-md-4 col-form-label text-md-right">* Username</label>

                            <div class="col-md-6">
                                <input class="form-control form-control-custom @error('Username') is-invalid @enderror" placeholder="Your ICIT Account..." name="Username" value="{{ old('Username') }}" required autocomplete="Username" autofocus>

                                @error('Username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('* Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" placeholder="Your password..." name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn rounded-pill" style="background-color: #260176;color:white">
                                    <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session()->has('Error'))
    <script>
        Swal.fire("<span class='kanin'><?php echo session()->get('Error'); ?></span>", "", "error");
    </script>
@endif
@endsection