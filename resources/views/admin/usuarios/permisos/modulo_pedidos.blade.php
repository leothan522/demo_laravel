<div class="col-md-12">
    <div class="card card-purple">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-shopping-bag text-sm"></i> Pedidos</h5>
            <div class="card-tools">
                {{--<span class="btn btn-tool"><i class="fas fa-user-shield"></i></span>--}}
                <div class="custom-control custom-checkbox">
                    <input name="pedidos_index" value="true" class="custom-control-input" type="checkbox" id="tituloPedidos"
                           @if (leerJson($user->permisos, 'pedidos.index')) checked @endif>
                    <label for="tituloPedidos" class="custom-control-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="custom-control custom-checkbox">
                <input name="pedidos_edit" value="true" class="custom-control-input" type="checkbox" id="optionPedidos2"
                       @if (leerJson($user->permisos, 'pedidos.edit')) checked @endif>
                <label for="optionPedidos2" class="custom-control-label">Editar Pedidos</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="pedidos_show" value="true" class="custom-control-input" type="checkbox" id="optionPedidos4"
                       @if (leerJson($user->permisos, 'pedidos.show')) checked @endif>
                <label for="optionPedidos4" class="custom-control-label">Ver detalles del Pedido</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="pedidos_confirmar" value="true" class="custom-control-input" type="checkbox" id="optionPedidos5"
                       @if (leerJson($user->permisos, 'pedidos.confirmar_pago')) checked @endif>
                <label for="optionPedidos5" class="custom-control-label">Confirmar Pagos</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input name="pedidos_generar_pdf" value="true" class="custom-control-input" type="checkbox" id="optionPedidos6"
                       @if (leerJson($user->permisos, 'pedidos.generar_pdf')) checked @endif>
                <label for="optionPedidos6" class="custom-control-label">Generar PDF</label>
            </div>

        </div>
    </div>
</div>
