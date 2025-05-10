@extends('main')
@section('content')
<div class="form-body">
   <div class="row">
       <div class="form-holder">
           <div class="form-content">
               <div class="form-items">
                   <h3>Войти в аккаунт</h3>
                   <p>Заполните поля ниже</p>
                   <form class="requires-validation" novalidate>

                     <div class="col-md-12">
                        <input class="form-control" type="text" name="login" id="login" placeholder="Логин">
                     </div>

                       <div class="col-md-12">
                        <input class="form-control" type="text" name="password" id="password" placeholder="Пароль">
                     </div>

                       <div class="form-button mt-3">
                           <button id="submit" type="submit" class="btn btn-primary">Войти</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection