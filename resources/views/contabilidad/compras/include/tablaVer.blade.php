        <div class="box box-primary">
          
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Imagen</th>
                  <th>Producto</th>
                  <th>Marca</th>
                  <th>Dimensión</th>
                  <th>Color</th>
                  <th>Precio Unitario</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                </tr>
              </thead>

              <tbody>
                @foreach($compra->items as $item)
                  <tr>
                    <td><img class="img-responsive thumbnail" width="50px" src="{{ $item->producto()->imagenes->first()->imagen }}"></td>
                    <td>{{ $item->producto()->categoria }}</td>
                    <td>{{ $item->producto()->marca }}</td>
                    <td>{{ $item->stock()->dimension }}</td>
                    <td>{{ $item->color() }}</td>
                    <td>${{ $item->precio }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio * $item->cantidad, 2) }}</td>
                  </tr>
                @endforeach
              </tbody>

              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Sub Total</th>
                  <td>${{ $compra->subTotal() }}</td>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Monto No Facturado</th>
                  <td>${{ $compra->monto_no_facturado }}</td>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Monto Facturado</th>
                  <td>${{ $compra->monto_facturado }}</td>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>IVA</th>
                  <td>${{ $compra->iva_compra }}</td>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Retención de {{$compra->porcentaje_retencion_iva}}% de IVA</th>
                  <td>${{ $compra->retencion_iva }}</td>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Retención de {{ $compra->porcentaje_retencion_renta }}% de Renta</th>
                  <td>${{ $compra->retencion_renta }}</td>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Total</th>
                  <td>${{ $compra->total() }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>