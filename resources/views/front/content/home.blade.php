<div class="col-md-12">
    <form id="location">
        <div class="row">
            <div class='col-md-6'>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pick-up Date/Time</label>
                    <div class='input-group date' id='datetimepicker8'>
                        <input type='text' class="form-control" name="pickup" id="pickup"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="form-group">
                    <label for="exampleInputEmail1">Return Date/Time</label>
                    <div class='input-group date' id='datetimepicker9'>
                        <input type='text' class="form-control" name="return" id="return"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-md-6'>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pick-up location</label>
                    {{ Form::select('locpickup', $selectbox,'',array('class' => 'form-control')) }}
                </div>
            </div>
            <div class='col-md-6'>
                <div class="form-group">
                    <label for="exampleInputEmail1">Return location</label>
                    {{ Form::select('locreturn', $selectbox,'',array('class' => 'form-control')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-md-6'>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>
<br /><br />
<script>
    $(function() {
        var now = moment().format("MM/DD/GGGG h:mm A");
        var tommorow = moment().add(1, 'days').format("MM/DD/GGGG h:mm A");
        $('#pickup').val(now);
        $('#return').val(tommorow);
        $('#datetimepicker8').datetimepicker();
        $('#datetimepicker9').datetimepicker();
        $("#datetimepicker8").on("dp.show", function() {
            $('#datetimepicker8').data("DateTimePicker").setMinDate(now);
        });
        $("#datetimepicker9").on("dp.show", function() {
            $('#datetimepicker9').data("DateTimePicker").setMinDate(tommorow);
        });
        $("#datetimepicker8").on("dp.change", function(e) {
            $('#datetimepicker9').data("DateTimePicker").setMinDate(e.date);
            $('#location').bootstrapValidator('revalidateField', 'pickup');
        });
        $("#datetimepicker9").on("dp.change", function(e) {
            $('#datetimepicker8').data("DateTimePicker").setMaxDate(e.date);
            $('#location').bootstrapValidator('revalidateField', 'return');
        });
        $('#location').bootstrapValidator({
            feedbackIcons: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                pickup: {
                    validators: {
                        date: {
                            format: 'MM/DD/YYYY h:mm A',
                            message: 'The value is not a valid date'
                        }
                    }
                },
                return: {
                    validators: {
                        date: {
                            format: 'MM/DD/YYYY h:mm A',
                            message: 'The value is not a valid date'
                        }
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post("{{ route('choosecar') }}", $form.serialize(), function(result) {
                $('#myTab a[href="#choosecar"]').tab('show');
                $('#choosecar').html(result);
            });
        });
    })
</script>