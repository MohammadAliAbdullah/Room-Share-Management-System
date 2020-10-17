<div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Name:</label>
            <!--input type="text" class="form-control" name="name"/-->
            {!! Form::text('name', null, array('placeholder' => 'Name',
            'class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <label for="start_time">Code</label>
            <!--input type="text" class="form-control" name="dob"/-->
            {!! Form::text('code', null, array('placeholder' => 'code',
                        'class' => 'form-control')) !!}
        </div>
         <div class="form-group">
            <label for="end_time">Status</label>
            <!--input type="text" class="form-control" name="dob"/-->
            {!! Form::text('status', null, array('placeholder' => 'status',
                        'class' => 'form-control')) !!}
        </div>
       
<button type="submit" class="btn btn-primary">Submit</button>