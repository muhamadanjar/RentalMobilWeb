<form id="extra_form">
    <div id='select-car'>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Booking Details</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-9 col-lg-9">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <h4>Time & Place</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pick Up Location:</td>
                                        <td>
                                            <p>{{ $locpickup->address.','.$locpickup->city }} </p>
                                            <p>{{ $loc['pickup'] }}</p>
                                            <input type="hidden" name="locpickupid" value="{{ $locpickup->id }}" />
                                            <input type="hidden" name="pickup" value="{{ $loc['pickup'] }}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Return Location</td>
                                        <td>
                                            <p>{{ $locreturn->address.','.$locreturn->city }} </p>
                                            <input type="hidden" name="locreturnid" value="{{ $locreturn->id }}" />
                                            <p>{{ $loc['return'] }}</p>
                                            <input type="hidden" name="return" value="{{ $loc['return'] }}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rental Duration</td>
                                        <td>{{ $diff->days.' Days '.($diff->h > 0 ? $diff->h.' Hours' : '') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <h4>Car Type</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img class="img-circle" src="{{ asset('assets/img/type/'.$type->image) }}" alt="{{ $car->make.' '.$car->model }}" style="width: 50px; height: 50px;"></td>
                                        <td>
                                            <p>{{ $type->type }}
                                            </p>
                                            <p>(Example of this range: {{ $car->make.' '.$car->model }})</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-body">

                    <table class="table">
                        @if($extras != '')
                        @foreach ($extras as $extra)
                        <tr class="success">
                            <td>
                                {{ $extra->name }}
                            </td>
                            <?php
                            if (isset($added) && $added != NULL) {
                                if (array_key_exists($extra->id, $added)) {
                                    ?>
                                    <td>
                                        <b>${{ $extra->price.'</b> per '.$extra->type }}
                                            <span class = "pull-right">
                                                <button class = "btn btn-remove" value = '{{$extra->id}}' id = "remove-{{$extra->id}}">Remove</button>
                                            </span>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                        <b>${{$extra->price.'</b> per '.$extra->type}}
                                            <span class = "pull-right">
                                                <button class = "btn btn-add" value = '{{$extra->id}}' id = "add-{{$extra->id}}">Add</button>
                                            </span>
                                    </td>
                                    <?php
                                }
                            } else {
                                ?>
                                <td>
                                    <b>${{$extra->price.'</b> per '.$extra->type}}
                                        <span class = "pull-right">
                                            <button class = "btn btn-add" value = '{{$extra->id}}' id = "add-{{$extra->id}}">Add</button>
                                        </span>
                                </td>
                            <?php }
                            ?> 

                        </tr>
                        @endforeach
                        @endif
                        <tbody>
                            <tr>
                                <td>
                                    <b>Rental Duration</b>
                                </td>
                                <td>
                                    {{ $diff->days.' Days '.($diff->h > 0 ? $diff->h.' Hours' : '') }}
                                </td>
                        <input type="hidden" value="{{ $diff->days.' Days '.($diff->h > 0 ? $diff->h.' Hours' : '') }}" name="diff">
                        </tr>
                        <tr>
                            <td>
                                <p><b>Price Per Day</b></p>
                                <p><small>{{ $diff->days.' x $'.$type->price_day }}</small></p>
                            </td>
                            <td>$ {{ $diff->days * $type->price_day }}</td>
                        <input type="hidden" value="{{ $diff->days * $type->price_day }}" name="price_perday">
                        </tr>
                        <tr>
                            <td>
                                <p><b>Price Per Hour</b></p>
                                <p><small>{{ $diff->h.' x $'.$type->price_hour }}</small></p>
                            </td>
                            <td>$ {{ $diff->h * $type->price_hour }}</td>
                        <input type="hidden" value="{{ $diff->h * $type->price_hour }}" name="price_perhour">
                        </tr>
                        <tr>
                            <td><b>Car Rental Fee</b></td>
                            <td>$ {{ $rental_fee }}</td>
                        <input type="hidden" value="{{ $rental_fee }}" name="rental_fee">
                        </tr>
                        <tr>
                            <td><b>Extra Price</b></td>
                            <td>$ {{ $extra_fee }}</td>
                        <input type="hidden" value="{{ $extra_fee }}" name="extra_fee">
                        </tr>
                        <tr class="danger">
                            <td><b>Total Price</b></td>
                            <td><strong>$  {{ $total_price }}</strong></td>
                        <input type="hidden" value="{{ $total_price }}" name="total_price">
                        </tr>
                        <tr>
                            <td>
                                <p><b>Required Deposit</b></p>
                                <p><small>{{ $deposit['value_one'] }} % of {{ $total_price }}</small></p>
                            </td>
                            <td>$ {{ $deposit_price }}</td>
                        <input type="hidden" value="{{ $deposit_price }}" name="deposit_price">
                        </tr>
                        </tbody>
                    </table>
                    <span class="pull-right">
                        <input type="hidden" name="type_id" value="{{$type->id}}">
                        <input type="hidden" name="car_id" value="{{$car->id}}">
                        <button class="btn btn-sm btn-warning" type="button"
                                data-toggle="tooltip"
                                data-original-title="Edit this user" value="{{$type->id.'-'.$car->id}}" id="extra_button">Continue</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('li.active').prev().removeClass("disabled");
        $('.nav li.active').prev().find('a').attr('data-toggle', 'tab');
        $("table").delegate(".btn-add", "click", function(e) {
            e.preventDefault();
            var id = '#add-' + $(this).val();
            var data = {
                'add': true,
                'extras': $(this).val(),
                'extra_fee': "{{ $extra_fee }}",
                'car_id': "{{ $type->id.'-'.$car->id }}",
                'locpickup_id': "{{ $locpickup->id }}",
                'locreturn_id': "{{ $locpickup->id }}",
                'pickup': $('#pickup').val(),
                'return': $('#return').val(),
            };
            $.get('selectcar', data).done(function(e) {
                $("#select-car").html(e);
            });
        });
        $("table").delegate(".btn-remove", "click", function(e) {
            e.preventDefault();
            var id = '#add-' + $(this).val();
            var data = {
                'remove': true,
                'extras': $(this).val(),
                'extra_fee': "{{ $extra_fee }}",
                'car_id': "{{ $type->id.'-'.$car->id }}",
                'locpickup_id': "{{ $locpickup->id }}",
                'locreturn_id': "{{ $locpickup->id }}",
                'pickup': $('#pickup').val(),
                'return': $('#return').val(),
            };
            $.get('selectcar', data).done(function(e) {
                $("#select-car").html(e);
            });
            return false;
        });
        $("#extra_button").on('click', function(e) {
            var telo = $("#extra_form :input[value!='']").serialize() 
            $.post('detailcustomer', telo).done(function(data) {
                $('#myTab a[href="#customer"]').tab('show');
                $('#customer').html(data);
            });
            e.preventDefault();
        });
    });
</script>