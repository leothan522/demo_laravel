@extends('layouts.android.master-ogani')

@section('content')
    @if (!$favoritos->isEmpty())
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <div class="section-title">
                        <h2>Productos Destacados</h2>
                    </div> -->
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">Todos</li>
                            @foreach ($categorias as $categoria)
                                <li data-filter=".{{ $categoria->slug }}">{{ $categoria->nombre }}</li>
                            @endforeach
                            {{--<li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($favoritos as $parametro)
                    @if (!is_null($parametro->imagen) && file_exists('img/productos/'.$parametro->file_path.'/t_'.$parametro->imagen))
                        @php($imagen = asset('img/productos/'.$parametro->file_path.'/t_'.$parametro->imagen))
                    @else
                        @php($imagen = asset('img/img-placeholder-320x320.png'))
                    @endif

                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $parametro->slug }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg img-thumbnail"
                                 data-setbg="{{ $imagen }}">
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <a href="#" id="favoritos_{{ $parametro->id_produto }}" content="{{ $parametro->id_produto }}"
                                           class="btn_favoritos @if ($parametro->favoritos) fondo-favoritos @endif">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </li>
                                    <li><a href="{{ route('android.detalles', [Auth::user()->id, $parametro->id_produto]) }}" onclick="verCargando();"><i
                                                class="fa fa-eye"></i></a></li>
                                    <li>
                                        <a href="#" id="carrito_{{ $parametro->id_produto }}" content="{{ $parametro->id_produto }}"
                                           class="btn_carrito @if ($parametro->carrito) fondo-favoritos @endif">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6>
                                    <a href="{{ route('android.detalles', [Auth::user()->id, $parametro->id_produto]) }}">{{ ucwords($parametro->nombre_producto) }}</a>
                                </h6>
                                @if ($parametro->cant_inventario)
                                    @if ($parametro->visibilidad && $parametro->descuento)
                                        <h5>${{ formatoMillares($parametro->precio - $parametro->descuento) }}</h5>
                                        <h5>{{ precioBolivares($parametro->precio - $parametro->descuento) }}</h5>
                                    @else
                                        <h5>${{ formatoMillares($parametro->precio) }}</h5>
                                        <h5>{{ precioBolivares($parametro->precio) }}</h5>
                                    @endif
                                @else
                                    {{--<h5>${{ formatoMillares($parametro->precio) }}</h5>--}}
                                    <h5 class="text-danger">Producto agotado</h5>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
				<div class="row col-md-12 justify-content-center">
					{{ $favoritos->render() }}
				</div>
				
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-2.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-3.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood oranges">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-4.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-5.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-6.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fresh-meat vegetables">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-7.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood vegetables">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('ogani/img/featured/feature-8.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>
    
    @else
         <!-- Hero Section Begin -->
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero__search">
                            {{--<div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>{{ $telefono_numero }}</h5>
                                    <span>{{ $telefono_texto }}</span>
                                </div>
                            </div>--}}
                        </div>
                        <div class="hero__item set-bg" data-setbg="{{ asset('img/banner_2.png') }}">
                            <div class="hero__text">
                                <span>#MAXICALISTOS</span>
                                <h2>{{--Frase <br/>Publicitaria--}}</h2>
                                <p>¡Aún no tienes favoritos!</p>
                                <a href="{{ route('wordpress.store.index', Auth::user()->id) }}" id="btn_statusHours" class="btn btn-info">
                                    <strong style="color: white;">{{--<i class="icon fa fa-exclamation-circle"></i>--}} Ir a Store</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
    @endif
    
@endsection

@section('script')
    <script type="text/javascript">
        /*$(document).on("click", "#btn_statusHours", function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¡Abierto!',
                text: "Bienvenido, puedes empezar a comprar.",
                icon: 'success',
                confirmButtonColor: '#3085d6',
            });
        });*/
        function storeHours($title, $text, $icono) {
            Swal.fire({
                title: $title,
                text: $text,
                icon: $icono,
                confirmButtonColor: '#3085d6',
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn_favoritos").click(function(e){
            e.preventDefault();
            Swal.fire({
                toast: true,
                //title: 'Cargando...',
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            var producto = this.getAttribute('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.favoritos') }}",
                data: {id_producto:producto},
                success: function (data) {
                    Swal.fire({
                        toast: true,
                        title: data.message,
                        //text: data.message,
                        icon: data.type,
                        //showConfirmButton: false,
                        //confirmButtonColor: '#3085d6',
                    });
                    if(data.type === "success"){
                        document.getElementById(data.id).classList.add('fondo-favoritos');
                    }else{
                        document.getElementById(data.id).classList.remove('fondo-favoritos');
                    }

                }
            });
        });


        $(".btn_carrito").click(function(e){
            e.preventDefault();
            Swal.fire({
                toast: true,
                //title: 'Cargando...',
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            var producto = this.getAttribute('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.carrito') }}",
                data: {id_producto:producto},
                success: function (data) {
                    Swal.fire({
                        //toast: true,
                        icon: data.type,
                        title: data.title,
                        //text: data.message,
                        html: data.message,
                        //showConfirmButton: false,
                        //confirmButtonColor: '#3085d6',
                    });
                    if(data.type === "success"){
                        document.getElementById(data.id).classList.add('fondo-favoritos');
                    }/*else{
                        document.getElementById(data.id).classList.remove('fondo-favoritos');
                    }*/

                }
            });
        });

    </script>
@endsection

