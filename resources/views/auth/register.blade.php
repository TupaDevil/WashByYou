@extends('main')
@section('content')
   <div class="form-body">
      <div class="row">
        <div class="form-holder">
          <div class="form-content">
            <div class="form-items">
               <h3>Регистрация</h3>
               <p>Заполните поля ниже</p>
               <form class="requires-validation" action="{{route('register.store')}}" method="post">
                 @csrf
                 <div class="col-md-12">
                   @error('login')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                   <input class="form-control" type="text" name="login" id="login" placeholder="Логин"
                     value="{{ old('login')}}">
                 </div>

                 <div class="col-md-12">
                   @error('password')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
                   <input class="form-control" type="password" name="password" id="password" placeholder="Пароль"
                     value="{{ old('password')}}">
                 </div>

                 <div class="col-md-12">
                   @error('full_name')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
                   <input class="form-control" type="text" name="full_name" id="full_name" placeholder="ФИО"
                     value="{{ old('full_name')}}">
                 </div>

                 <div class="col-md-12">
                   @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
                   <input class="form-control" type="text" name="phone_number" id="phone_number"
                     value="{{ old('phone_number')}}" placeholder="Номер телефона">
                 </div>

                 <div class="col-md-12">
                   @error('email')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
                   <input class="form-control" type="text" name="email" id="email" placeholder="Почта"
                     value="{{ old('email')}}">
                 </div>

                 <div class="form-button mt-3">
                   <button id="submit" type="submit" class="btn btn-primary">Зарегистрироваться</button>
                 </div>
               </form>
            </div>
          </div>
        </div>
      </div>
   </div>
@endsection