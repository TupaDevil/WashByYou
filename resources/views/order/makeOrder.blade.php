@extends('main')
@section('content')
<div class="form-body">
   <div class="row">
       <div class="form-holder">
           <div class="form-content">
               <div class="form-items">
                   <h3>Заказать услуги</h3>
                   <p>Заполните поля ниже</p>
                   <form class="requires-validation" action="{{route('makeOrder.store')}}" method="post">
                     @csrf
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

                     <div class="col-md-12">
                        @error('address')
                       <span class="text-danger">{{ $message }}</span>
                    @enderror
                        <input class="form-control" type="text" name="address" id="address" placeholder="Адрес">
                     </div>

                     <div class="col-md-12 mt-3">
                        @error('service_date')
                       <span class="text-danger">{{ $message }}</span>
                    @enderror
                        <input type="date" class="form-control" id="service_date" name="service_date">
                    </div>
                    
                    <div class="col-md-12 mt-3">
                     @error('service_time')
                       <span class="text-danger">{{ $message }}</span>
                    @enderror
                        <input type="time" class="form-control" id="service_time" name="service_time">
                    </div>

                      <div class="col-md-12">
                        <select class="form-select @error('service_type') is-invalid @enderror" name="service_type">
                           <option value="" disabled selected>Выберите услугу</option>
                           <option value="general_cleaning">Общий клининг</option>
                           <option value="deep_cleaning" >Генеральная уборка</option>
                           <option value="post_construction_cleaning">Послестроительная уборка</option>
                           <option value="carpet_furniture_cleaning">Химчистка ковров и мебели</option>
                       </select>
                      </div>


                      <div class="col-md-12 mt-3">
                        <label class="mb-3">Оплата:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('payment_type') is-invalid @enderror" type="radio" name="payment_type" id="cash" value="cash">
                            <label class="form-check-label" for="cash">Наличные</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('payment_type') is-invalid @enderror" type="radio" name="payment_type" id="card" value="card">
                            <label class="form-check-label" for="card">Картой</label>
                        </div>
                        @error('payment_type')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                       <div class="form-button mt-3">
                           <button id="submit" type="submit" class="btn btn-primary">Заказать</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection