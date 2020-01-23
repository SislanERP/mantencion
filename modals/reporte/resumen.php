<div class="modal fade" id="resumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <h3 class="pl-3">N° Venta</h3>
                        <h3 class="font-weight-bolder pl-2" id="id"></h3>
                    </div>
                    <img src="img/logo.png" class="w-25 pr-3" alt="">
                </div>
                <div class="row">
                    <h5 class="font-weight-bolder pl-3" id="fecha"></h5>
                </div>
                <div class="row pl-3 pr-3">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
			            </thead>
                        <tbody class="test">
                        </tbody>
                    </table>
                </div>
                <div class="row pl-3 pr-3">
                    <div class="col-8 p-0">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Resumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td id="subtotal"></td>
                                </tr>
                                <tr>
                                    <td>Descuento</td>
                                    <td id="descuento"></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bolder">A Pagar</td>
                                    <td class="font-weight-bolder" id="total"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
