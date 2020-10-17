<div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">State Name:</label>
            {!! Form::text('name', null, array('placeholder' => 'State Name',
            'class' => 'form-control')) !!}
        </div>

        <div class="form-group">
                <label for="code">State Code</label>
                {!! Form::text('code', null, array('placeholder' => 'state code',
                            'class' => 'form-control')) !!}
            </div>


        <div class="form-group">
            <label for="start_time">Select State</label>
            {!! Form::select('country_id',$country,null,['class'=>'custom-select form-control required','id'=>'country','placeholder'=>'Select country']) !!}
        </div>
        <div class="form-group">
            <h4>Status</h4>
            <label id="switch">
                {!! Form::checkbox('status', null,@$state->status=='1'?true:false)!!}
                <span class="sl"></span>
              </label>            
        </div>
<button type="submit" class="btn btn-primary">Submit</button>