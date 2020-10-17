<input type="hidden" value="{{csrf_token()}}" category_id="_token" />
        <div class="form-group">
            <label for="shift_id">Category ID:</label>
            {!! Form::select('category_id', $allcat, null,array('class'=>'form-control','placeholder'=>'Select')) !!}
        </div>
        <div class="form-group">
            <label for="start_time">Name</label>
            <!--input type="text" class="form-control" name="dob"/-->
            {!! Form::text('name', null, array('placeholder' => 'Name',
                        'class' => 'form-control')) !!}
        </div>
         <div class="form-group">            
            <h4>Status</h4>
            <label id="switch">
                {!! Form::checkbox('status', null,@$subcategory->status=='1'?true:false)!!}
                <span class="sl"></span>
              </label>
            <!--input type="text" class="form-control" name="dob"/-->
            {{-- {!! Form::text('status', null, array('placeholder' => 'status',
                        'class' => 'form-control')) !!} --}}
        </div>
<button type="submit" class="btn btn-primary">Submit</button>