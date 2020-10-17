<div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">City Name:</label>
            {!! Form::text('name', null, array('placeholder' => 'City Name',
            'class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <label for="start_time">Select State</label>
            {!! Form::select('state_id',$state,null,['class'=>'custom-select form-control required','id'=>'state','placeholder'=>'Select State']) !!}
        </div>


        <div class="form-group">
            <h4>Status</h4>
            <label id="switch">
                {!! Form::checkbox('status', null,@$city->status=='1'?true:false)!!}
                <span class="sl"></span>
              </label>            
        </div>
<button type="submit" class="btn btn-primary">Submit</button>