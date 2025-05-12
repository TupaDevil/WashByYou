<header>
   <div class=""></div>
   <div class="header" style="background-color: white;" >
       <nav class="navbar navbar-expand-lg">
           <div class="container-fluid">
             <h1><a class="navbar-brand nav-link" href="#">Мой Не Сам</a></h1>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse me-auto" id="navbarNavAltMarkup">
               <div class="navbar-nav ms-auto">
                 @guest
                     <a class="nav-link me-4" href="{{ route('register.create') }}">Регистрация</a>
                     <a class="nav-link me-4" href="{{ route('login') }}">Войти</a>
                 @else
                     <a class="nav-link me-4" href="{{ route('makeOrder.create') }}">Заказать услуги</a>
                     <a class="nav-link me-4" href="{{ route('order') }}">Ваш кабинет</a>
                     <form action="{{ route('logout') }}" method="POST" class="d-inline">
                         @csrf
                         <button type="submit" class="btn btn-link nav-link">Выйти</button>
                     </form>
                 @endguest
               </div>
             </div>
           </div>
         </nav>
</header>