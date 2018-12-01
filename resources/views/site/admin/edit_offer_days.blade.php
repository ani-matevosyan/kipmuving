<style>
  form.panel{
    margin-bottom: 100px;
  }
  .datepicker .datepicker-days{
    padding: 2px 10px;
  }
  .operations {
    min-height: 34px;
    position: relative;
    margin-left: -15px;
  }
  .operations span {
    position: absolute;
    top: 100%;
    font-size: 15px;
    color: green;
    cursor: pointer;
  }
  .operations span.glyphicon-remove {
     color: gray;
  }
  .operations span.glyphicon-plus-sign{
     left: 20px;
  }
  .operations span.glyphicon-plus-sign:first-child{
    left: 0px;
  }
  #break_start, #break_close{
    width: 100px;
  }
  .nowrap{
    white-space: nowrap;
  }
  input[name=real_price]{
    width: 81%;
  }
  h4.offer-days{
    display: none;
  }
  .addOfferDay {
    width: 100%;
  }
  @media screen and (max-width: 991px){
    .offer_day{
      margin-bottom: 20px;
    }
    .operations{
      margin-left: 20px;
    }
    .operations span{
      top: 0px;
    }
    input[name=real_price]{
      width: 100%;
    }
    h4.offer-days{
      display: block;
    }
  }


</style>

<section>
  <div class="offer-days">
    @if($offerDays->isNotEmpty())
      <div class="row" style="display: none">
        <div class="col-md-3">
          <a class="btn btn-success addOfferDay">Add Offer Day</a>
        </div>
      </div>
       @foreach($offerDays as $key=>$item)
          <div class="offer_day row">
            <div class="col-md-3">
              <div class="form-elements first">
                <div class="form-group form-element-date ">
                  <label for="available_end" class="control-label">
                    Start date
                  </label>
                  <div class="input-date input-group">
                    <input data-date-format="DD/MM/YYYY" data-date-pickdate="true" data-date-picktime="false" data-date-useseconds="false" class="form-control offerDayField" name="available_start[]" type="text" id="available_start" value="{{ date('d/m/Y', strtotime($item->available_start)) }}">
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-elements">
                <div class="form-group form-element-date ">
                  <label for="available_end" class="control-label">
                    End date
                  </label>
                  <div class="input-date input-group">
                    <input data-date-format="DD/MM/YYYY" data-date-pickdate="true" data-date-picktime="false" data-date-useseconds="false" class="form-control offerDayField" name="available_end[]" type="text" id="available_end" value="{{ date('d/m/Y', strtotime($item->available_end)) }}">
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-elements">
                <div class="form-group form-element-text ">
                  <label for="real_price" class="control-label">
                    Price
                  </label>
                  <input class="form-control" name="price[]" type="text" id="price" value="{{$item->price}}">
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-elements">
                <div class="form-group form-element-text ">
                  <label for="real_price" class="control-label nowrap">
                    Offer Price
                  </label>
                  <input class="form-control" name="price_offer[]" type="text" id="price_offer" value="{{$item->price_offer}}">
                </div>
              </div>
            </div>
            <div class="col-md-1">
              <div class="operations">
                <span class="glyphicon glyphicon-remove"></span>
                <span class="glyphicon glyphicon-plus-sign"></span>
              </div>
            </div>
          </div>
       @endforeach
    @else
      <div class="row">
        <div class="col-md-3">
          <a class="btn btn-success addOfferDay">Add Offer Day</a>
        </div>
      </div>
    @endif
  </div>
</section>

<script>

$(document).ready(function(){
    const offerDays = JSON.parse('{!! json_encode($offerDays) !!}');
    const offerId = '{!! $offerId !!}';

    const addOfferDay = function(element){
        let html = `<div class="offer_day row">
                            <div class="col-md-3">
                              <div class="form-elements">
                                <div class="form-group form-element-date ">
                                  <label for="available_end" class="control-label">
                                    Start date
                                  </label>
                                  <div class="input-date input-group">
                                    <input data-date-format="dd/mm/yyyy" data-date-pickdate="true" data-date-picktime="false" data-date-useseconds="false" class="form-control datepicker" name="available_start[]" type="text" id="available_end" value="">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-elements">
                                <div class="form-group form-element-date ">
                                  <label for="available_end" class="control-label">
                                    End date
                                  </label>
                                  <div class="input-date input-group">
                                    <input data-date-format="dd/mm/yyyy" data-date-pickdate="true" data-date-picktime="false" data-date-useseconds="false" class="form-control datepicker" name="available_end[]" type="text" id="available_end" value="">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-elements">
                                <div class="form-group form-element-text ">
                                  <label for="real_price" class="control-label">
                                    Price
                                  </label>
                                  <input class="form-control" name="price[]" type="text" id="price[]" value="">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-elements">
                                <div class="form-group form-element-text ">
                                  <label for="real_price" class="control-label nowrap">
                                    Offer Price
                                  </label>
                                  <input class="form-control" name="price_offer[]" type="text" id="price_offer[]" value="">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="operations">
                                  <span class="glyphicon glyphicon-remove"></span>
                                  <span class="glyphicon glyphicon-plus-sign"></span>
                              </div>
                            </div>
                          </div>`;
        $(html).insertAfter(element);
        $('.fa-calendar').click(function() {
            $(this).parent().prev('.datepicker').datepicker({
                changeYear: true,
                changeMonth: true,
                autoclose: true,
            }).focus();
            $('.prev i').removeClass();
            $('.prev i').addClass("fa fa-chevron-left");

            $('.next i').removeClass();
            $('.next i').addClass("fa fa-chevron-right");
        });
    };

    $(document.body).undelegate('.glyphicon-plus-sign', 'click')
        .delegate(".glyphicon-plus-sign", "click", function(ev){
            const element = $(this).parent().parent().parent();
            addOfferDay(element);
        });

    $(document.body).undelegate('.addOfferDay', 'click')
        .delegate(".addOfferDay", "click", function(ev){
            $(this).parent().parent().hide();
            const element = $(this).parent().parent();
            addOfferDay(element);
        });


    $(document.body).undelegate('.glyphicon-remove', 'click')
        .delegate(".glyphicon-remove", "click", function(ev){
            const element = $(this).parent().parent().parent();
            Promise.prototype.done = function() {
                return this.catch(function() {
                    // Catch promise rejections.
                });
            };
            swal({
                title: "Are you sure?",
//                    text: "You will not be able to recover!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
            }).then(function(isConfirm) {
                if (isConfirm) {
                    if(!element.next().hasClass( 'offer_day')){
                        element.prev().show();
                    }
                    element.fadeOut().remove();
                }
            }).done();
        });

    $(document.body).undelegate('button[name=next_action]', 'click')
        .delegate('button[name=next_action]', "click", function(ev) {
            const requiredInputs = $('.form-element-required').parent().parent().find('input');
            const requiredTextareas = $('.form-element-required').parent().parent().find('textarea');
            const areNotEmptyInputs = requiredInputs.filter(function () {
                  return $.trim($(this).val()).length == 0
              }).length == 0;
            const areNotEmptyTextareas = requiredTextareas.filter(function () {
                    return $.trim($(this).val()).length == 0
                }).length == 0;
            const agencySelect =  $('select#agency_id').val();
            const activitySelect = $('select#activity_id').val();
            if(areNotEmptyInputs && areNotEmptyTextareas && agencySelect && activitySelect ){
                ev.preventDefault();
                const formData = $('div.offer-days :input').serialize();
                $.ajax({
                    type: 'POST',
                    url: `/offer/editDays`,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'offer_id': offerId,
                        'formData': formData,
                    },
                    success: function(res){
    //                        console.log(res);
                    },
                    complete: (data) => {
                        $('form').submit();
                    }
                });
            }

        });




});
</script>

