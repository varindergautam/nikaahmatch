<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-pzjw8f+ua7Kw1TIq6jOR2Kqk4vxCGKGp0Rl/aZOiZzjwDifUQQkCk4PZJSE8+3+g" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="card-header bg-dark text-white">
    <h5 class="mb-0 h6">{{translate('Family Information')}}</h5>
</div>
<div class="card-body">
    <form action="{{ route('families.update', $member->id) }}" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        @csrf
        <div class="form-group row">
                <div class="col-md-6">
                    <label for="father">{{translate('Father')}}</label>
                    <input type="text" name="father" value="{{ $member->families->father ?? "" }}" class="form-control" placeholder="{{translate('Father')}}" required>
                    @error('father')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                 <div class="col-md-6">
                    <label for="father_prof">{{translate('Father Profession')}}</label>
                    <input type="text" name="father_prof" value="{{ $member->families->father_prof ?? "" }}" placeholder="{{ translate('Father Profession') }}" class="form-control" required>
                    @error('father_prof')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                   <div class="col-md-6 mt-2">
                    <label for="father_educ">{{translate('Father Education')}}</label>
                    <input type="text" name="father_educ" value="{{ $member->families->father_educ ?? "" }}" placeholder="{{ translate('Father Education') }}" class="form-control" required>
                    @error('father_educ')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                   
                
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="mother">{{translate('Mother')}}</label>
                    <input type="text" name="mother" value="{{ $member->families->mother ?? "" }}" placeholder="{{ translate('Mother') }}" class="form-control" required>
                    @error('mother')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                  <div class="col-md-6">
                    <label for="father_prof">{{translate('Mother Profession')}}</label>
                    <input type="text" name="mother_prof" value="{{ $member->families->mother_prof ?? "" }}" placeholder="{{ translate('Mother Profession') }}" class="form-control" required>
                    @error('mother_prof')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                   <div class="col-md-6 mt-2">
                    <label for="father_educ">{{translate('Mother Education')}}</label>
                    <input type="text" name="mother_educ" value="{{ $member->families->mother_educ ?? "" }}" placeholder="{{ translate('Mother Education') }}" class="form-control" required>
                    @error('mother_educ')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            @php
                #$siblings = json_decode($member->families->sibling);
                
                #$maritalStatuses = json_decode($member->families->sibling_m_s);
                $index = '0';
                
                $siblings = !empty($member->families->sibling) ? json_decode($member->families->sibling) : [];
                $maritalStatuses = !empty($member->families->sibling_m_s) ? json_decode($member->families->sibling_m_s) : [];
                $Yon_old = !empty($member->families->Yon_old) ? json_decode($member->families->Yon_old) : [];
                $relation = !empty($member->families->relation) ? json_decode($member->families->relation) : [];
            @endphp
            
            
            
           @if(!empty($siblings) && !empty($maritalStatuses) && !empty($Yon_old) && !empty($relation) && count($siblings) > 0 && count($maritalStatuses) > 0 && count($Yon_old) > 0 && count($relation) > 0)
            @foreach($siblings as $index => $sibling)
                <div class="sibling-fields form-group row">
                    <div class="col-md-3">
                        <label for="sibling">{{translate('Sibling')}} </label>
                        <input type="text" name="sibling[]" value="{{ $sibling }}" class="form-control" placeholder="{{translate('Sibling')}}" required>
                        @error('sibling.' . $index)
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <label for="sibling">{{translate('Sibling Relation')}} </label>
                        <select name="relation[]" class="form-control" required>
                            <option value="brother" {{ $relation[$index] == 'brother' ? 'selected' : '' }}>Brother</option>
                            <option value="sister" {{ $relation[$index] == 'sister' ? 'selected' : '' }}>Sister</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="sibling">{{translate('Yonger or Older')}} </label>
                        <select name="Yon_old[]" class="form-control" required>
                          <option value="younger" {{ $Yon_old[$index] == 'younger' ? 'selected' : '' }}>Younger</option>
                            <option value="older" {{ $Yon_old[$index] == 'older' ? 'selected' : '' }}>Older</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="sibling_m_s">{{translate('Sibling Marital Status')}}</label>
                        <input type="text" name="sibling_m_s[]" value="{{ $maritalStatuses[$index] }}" class="form-control" placeholder="{{translate('Sibling Meritial Status')}}" required>
                        @error('sibling_m_s.' . $index)
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    
                        <div class="col-md-1 mt-2" style="cursor:pointer;">
                            <a class="delete-sibling"><i class="las la-trash"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="form-group row mr-2 p-2" >
                    <div class="alert alert-danger col-md-6">
                        {{ translate('No sibling data available.') }}
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <div class="col-md-5 mt-2" style="cursor:pointer;color:white;">
                    <a id="add-sibling" class="mt-2 btn btn-primary btn-sm" >Add Sibling</i></a>
                </div>
            </div>
            <div id="sibling-div">
                
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="sibling">{{translate('Grand father maternal')}}</label>
                    <input type="text" name="grand_father" value="{{ $member->families->grand_father ?? "" }}" class="form-control" placeholder="{{translate('Grand father')}}" required>
                    @error('grand_father')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="sibling">{{translate('Grand Mother maternal')}}</label>
                    <input type="text" name="grand_mother" value="{{ $member->families->grand_mother ?? "" }}" class="form-control" placeholder="{{translate('Grand mother')}}" required>
                    @error('grand_mother')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
             
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="sibling">{{translate('Grand Father Name (Paternal)')}}</label>
                    <input type="text" name="nana" value="{{ $member->families->nana ?? "" }}" class="form-control" placeholder="{{translate('Grand Father Name (Paternal)')}}" required>
                    @error('nana')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="sibling">{{translate(' Grand Mother Name (Paternal)')}}</label>
                    <input type="text" name="nani" value="{{ $member->families->nani ?? "" }}" class="form-control" placeholder="{{translate('Grand Mother Name (Paternal)')}}" required>
                    @error('nani')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="text-right">
                <button type="submit" class="btn btn-primary btn-sm">{{translate('Update')}}</button>
            </div>
    </form>
</div>
<script>
        $(document).ready(function() {
           
            $("#add-sibling").click(function() {
              addSiblingFields();
            });
            
             $(document).on("click", ".delete-sibling", function() {
                $(this).closest(".sibling-fields").remove();
            });
            
            
            function addSiblingFields() {
                 var siblingCount = <?php echo $index; ?>;
                siblingCount++;
                var html = `
                    <div class="sibling-fields form-group row">
                        <div class="col-md-3">
                            <label for="sibling${siblingCount}">Sibling</label>
                            <input type="text" name="sibling[]" class="form-control" placeholder="Sibling Name" required>
                        </div>
                          
                    <div class="col-md-3">
                        <label for="sibling">{{translate('Sibling Relation')}} </label>
                        <select name="relation[]" class="form-control" required>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="sibling">{{translate('Yonger or Older')}} </label>
                        <select name="Yon_old[]" class="form-control" required>
                          <option value="younger">Younger</option>
                            <option value="older">Older</option>
                        </select>
                    </div>
                        <div class="col-md-3">
                            <label for="sibling_m_s${siblingCount}">Sibling Marital Status</label>
                            <input type="text" name="sibling_m_s[]" class="form-control" placeholder="Sibling Marital Status" required>
                        </div>
                          <div class="col-md-1 mt-2" style="cursor:pointer;">
                        <a class="delete-sibling"><i class="las la-trash"></i></a>
                        </div>
                    </div>
                `;
                // Append the sibling form fields to the form
                $("#sibling-div").append(html);
            }

        });
    </script>

