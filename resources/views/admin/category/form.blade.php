<div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Name:</label>
            <!--input type="text" class="form-control" name="name"/-->
            {!! Form::text('name', null, array('placeholder' => 'Name',
            'class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <label for="start_time">Description</label>
            <!--input type="text" class="form-control" name="dob"/-->
            {!! Form::text('description', null, array('placeholder' => 'description',
                        'class' => 'form-control')) !!}
        </div>
         <div class="form-group">
            <h4>Status</h4>
            <label id="switch">
                {!! Form::checkbox('status', null,@$category->status=='1'?true:false)!!}
                <span class="sl"></span>
              </label>

            <!--input type="text" class="form-control" name="dob"/-->
            {{-- {!! Form::checkbox('status', null,true, array('checked','data-on-color'=>'info','data-off-color'=>'success','data-on-text'=>'1','data-off-text'=>'0')) !!} --}}
            
        </div>
<button type="submit" class="btn btn-primary">Submit</button>
