<div class="payment-modal modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="info-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4>Reservando</h4>
                                </div>
                                <div class="col-xs-6">
                                    <strong>{{ count($reservation->offers) }} actividades</strong>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4>Ahorrando</h4>
                                </div>
                                <div class="col-xs-6">
                                    <strong>$ {{ number_format($reservation->total['CLP'] * config('kipmuving.discount'), 0, ".", ".") }}</strong>
                                    <span>$ {{ number_format($reservation->total['USD'] * config('kipmuving.discount'), 0, ".", ".") }}
                                        / R$ {{ number_format($reservation->total['BRL'] * config('kipmuving.discount'), 0, ".", ".") }}
                                        / {{ number_format($reservation->total['ILS'] * config('kipmuving.discount'), 0, ".", ".") }} ILS</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h4>Tarifa de servicio</h4>
                                </div>
                                <div class="col-xs-6">
                                    <strong>$ {{ number_format($reservation->total->to_pay['CLP'], 0, ".", ".") }}</strong>
                                    <span>$ {{ number_format($reservation->total->to_pay['USD'], 0, ".", ".") }}
                                        / R$ {{ number_format($reservation->total->to_pay['BRL'], 0, ".", ".") }}
                                        / {{ number_format($reservation->total->to_pay['ILS'], 0, ".", ".") }} ILS</span>
                                    @if ($reservation->total->to_pay['CLP'] == 2000)
                                        <span>*pago minimo</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <div class="payment-options">
                            <div class="row">
                                <h4>Confirmar con:</h4>
                                <div class="col-md-4">
                                    <div class="payment-method">
                                        <a href="/reserve/pagseguro" class="pagseguro-btn">
                                            <img src="/images/pagseguro_logo_dark.png" alt="Pagseguro Logo">
                                        </a>
                                        <span>Pagos solamente con Real Brasilieno</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="payment-method">
                                        <a href="/reserve/payu" class="payu-btn">
                                            <img src="/images/payu_logo.png" alt="PayU Logo">
                                        </a>
                                        <span>Tarjetas internacionales y america latina</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="payment-method payment-method_last">
                                        <a href="/reserve/paypal" class="paypal-btn">
                                            <img src="/images/paypal_logo_transparent.png" alt="PayPal Logo">
                                        </a>
                                        <span>Para cuetnas Paypal y Tarjetas intarnacionales</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form name="payuform" method="post" action="https://gateway.payulatam.com/ppp-web-gateway">
                {{--<form name="payuform" method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway">--}}
                <input name="merchantId" type="hidden" value="">
                <input name="ApiKey" type="hidden" value="">
                <input name="accountId" type="hidden" value="">
                <input name="description" type="hidden" value="">
                <input name="referenceCode" type="hidden" value="">
                <input name="amount" type="hidden" value="">
                {{--<input name="tax" type="hidden"  value="">--}}
                {{--<input name="taxReturnBase" type="hidden"  value="">--}}
                <input name="currency" type="hidden" value="">
                <input name="signature" type="hidden" value="">
                {{--<input type="hidden" name="totalAmount" value="">--}}
                {{--<input type="hidden" name="OpenPayu-Signature" value="">--}}
                <input name="test" type="hidden" value="">
                <input name="buyerEmail" type="hidden" value="">
                <input name="responseUrl" type="hidden" value="">
                <input name="confirmationUrl" type="hidden" value="">
                <input name="continueUrl" type="hidden" value="">
                <input name="notifyUrl" type="hidden" value="">
                <input name="returnUrl" type="hidden" value="">
                {{--<input name="surl" type="hidden" value="">--}}
                {{--<input name="furl" type="hidden" value="">--}}
                {{--<input name="sUrl" type="hidden" value="">--}}
                {{--<input name="fUrl" type="hidden" value="">--}}
            </form>
        </div>
    </div>
</div>