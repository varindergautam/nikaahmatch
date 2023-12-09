@extends('frontend.layouts.member_panel')
<script>
    // Check for the session variable set by the middleware
    @if (session('incomplete_data'))
        window.onload = function() {
            setTimeout(function() {
                $('#updateMassageModal').modal('show'); // Show Bootstrap modal
            }, 1000)
        };
    @endif
</script>
<style>
    .error {
        color: red;
    }
</style>
@section('panel_content')
    <form action="{{ route('member.saveMemberAllInfo', $member->member->id) }}" method="POST" id="saveMemberAllInfo">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Introduction') }}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ translate('Introduction') }}</label>
                    <div class="col-md-10">
                        <textarea type="text" name="introduction" class="form-control" rows="4"
                            placeholder="{{ translate('Introduction') }}" required>{{ $member->member->introduction }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{-- <h5 class="mb-0 h6">{{translate('Basic Information')}}</h5> --}}
                <h5 class="mb-0 h6">Candidate Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="first_name">{{ translate('First Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="first_name" value="{{ $member->first_name }}" class="form-control"
                            placeholder="{{ translate('First Name') }}" required>
                        @error('first_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="first_name">{{ translate('Middle Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="middle_name" value="{{ $member->middle_name }}" class="form-control"
                            placeholder="{{ translate('Middle Name') }}" required>
                        @error('middle_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="first_name">{{ translate('Last Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="last_name" value="{{ $member->last_name }}" class="form-control"
                            placeholder="{{ translate('Last Name') }}" required>
                        @error('last_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="first_name">{{ translate('Email') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="email" value="{{ $member->email }}" class="form-control"
                            placeholder="{{ translate('Last Name') }}" required>
                        @error('email')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="first_name">{{ translate('Gender') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control aiz-selectpicker" name="gender" required>
                            <option value="1" @if ($member->member->gender == 1) selected @endif>
                                {{ translate('Male') }}</option>
                            <option value="2" @if ($member->member->gender == 2) selected @endif>
                                {{ translate('Female') }}</option>
                            @error('gender')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="first_name">{{ translate('Date Of Birth') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="aiz-date-range form-control" name="date_of_birth"
                            value="@if (!empty($member->member->birthday)) {{ date('Y-m-d', strtotime($member->member->birthday)) }} @endif"
                            placeholder="Select Date" data-single="true" data-show-dropdown="true"
                            data-max-date="{{ get_max_date() }}" autocomplete="off" required>
                        @error('date_of_birth')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        @php
                            $birthDate = new DateTime($member->member->birthday);
                            $currentDate = new DateTime();
                            $age = $currentDate->diff($birthDate)->y;
                        @endphp

                        <div class="">
                            <label>{{ translate('Age') }}</label>
                            <input type="text" class="form-control" value="{{ $age }}" readonly>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="first_name">{{ translate('Phone Number') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="phone" value="{{ $member->phone }}" class="form-control"
                            placeholder="{{ translate('Phone') }}" required>
                        @error('phone')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="first_name">{{ translate('Created By ') }}
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control aiz-selectpicker" name="on_behalf" data-live-search="true" required>
                            @foreach ($on_behalves as $on_behalf)
                                <option value="{{ $on_behalf->id }}" @if ($member->member->on_behalves_id == $on_behalf->id) selected @endif>
                                    {{ $on_behalf->name }}</option>
                            @endforeach
                        </select>
                        @error('on_behalf')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <span for="first_name">{{ translate('Marital  Status') }}
                            <span class="text-danger">*</span>
                        </span>
                        <select class="form-control aiz-selectpicker" name="marital_status"
                            data-selected="{{ $member->member->marital_status_id }}" data-live-search="true" required>
                            @foreach ($marital_statuses as $marital_status)
                                <option value="{{ $marital_status->id }}">{{ $marital_status->name }}</option>
                            @endforeach
                        </select>
                        @error('marital_status')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="first_name">{{ translate('Number Of Children') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="children" value="{{ $member->member->children }}"
                            class="form-control" placeholder="{{ translate('Number Of Children') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="photo">{{ translate('Photo') }} <small>(800x800)</small>
                            @if (auth()->user()->photo != null && auth()->user()->photo_approved == 0)
                                <small class="text-danger">({{ translate('Pending for Admin Approval.') }})</small>
                            @elseif(auth()->user()->photo != null && auth()->user()->photo_approved == 1)
                                <small class="text-danger">({{ translate('Approved.') }})</small>
                            @endif
                        </label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ translate('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photo" class="selected-files" value="{{ $member->photo }}">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education -->
        @if (get_setting('member_education_section') == 'on')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Education Info') }}</h5>
                    <div class="text-right">
                        <a onclick="education_add_modal('{{ $member->id }}');" href="javascript:void(0);"
                            class="btn btn-sm btn-primary ">
                            <i class="las mr-1 la-plus"></i>
                            {{ translate('Add New') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table">
                        <tr>
                            <th>{{ translate('Degree') }}</th>
                            <th>{{ translate('Institution') }}</th>
                            <th data-breakpoints="md">{{ translate('Start') }}</th>
                            <th data-breakpoints="md">{{ translate('End') }}</th>
                            <!--<th data-breakpoints="md">{{ translate('Status') }}</th>-->
                            <th class="text-right">{{ translate('Options') }}</th>
                        </tr>

                        @php $educations = \App\Models\Education::where('user_id',$member->id)->get(); @endphp
                        @foreach ($educations as $key => $education)
                            <tr>
                                <td>{{ $education->degree }}</td>
                                <td>{{ $education->institution }}</td>
                                <td>{{ $education->start }}</td>
                                <td>{{ $education->end }}</td>
                                <!--<td>-->
                                <!--    <label class="aiz-switch aiz-switch-success mb-0">-->
                                <!--        <input type="checkbox" id="status.{{ $key }}" onchange="update_education_present_status(this)" value="{{ $education->id }}" @if ($education->present == 1) checked @endif data-switch="success"/>-->
                                <!--        <span></span>-->
                                <!--    </label>-->
                                <!--</td>-->
                                <td class="text-right">
                                    <a href="javascript:void(0);" class="btn btn-soft-info btn-icon btn-circle btn-sm"
                                        onclick="education_edit_modal('{{ $education->id }}');"
                                        title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                        class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route('education.destroy', $education->id) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endif

        <!-- Career -->
        @if (get_setting('member_career_section') == 'on')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Career') }}</h5>
                    <div class="text-right">
                        <a onclick="career_add_modal('{{ $member->id }}');" href="javascript:void(0);"
                            class="btn btn-sm btn-primary ">
                            <i class="las mr-1 la-plus"></i>
                            {{ translate('Add New') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table">
                        <tr>
                            <th>{{ translate('designation') }}</th>
                            <th>{{ translate('company') }}</th>
                            <th data-breakpoints="md">{{ translate('Start') }}</th>
                            <th data-breakpoints="md">{{ translate('End') }}</th>
                            <th data-breakpoints="md">{{ translate('Status') }}</th>
                            <th data-breakpoints="md" class="text-right">{{ translate('Options') }}</th>
                        </tr>

                        @php $careers = \App\Models\Career::where('user_id',$member->id)->get(); @endphp
                        @foreach ($careers as $key => $career)
                            <tr>
                                <td>{{ $career->designation }}</td>
                                <td>{{ $career->company }}</td>
                                <td>{{ $career->start }}</td>
                                <td>{{ $career->end }}</td>
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" id="status.{{ $key }}"
                                            onchange="update_career_present_status(this)" value="{{ $career->id }}"
                                            @if ($career->present == 1) checked @endif data-switch="success" />
                                        <span></span>
                                    </label>
                                </td>
                                <td class="text-right">
                                    <a href="javascript:void(0);" class="btn btn-soft-info btn-icon btn-circle btn-sm"
                                        onclick="career_edit_modal('{{ $career->id }}');"
                                        title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                        class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route('career.destroy', $career->id) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        @endif

        <!-- Present Address -->
        @php
            $present_address = \App\Models\Address::where('type', 'present')
                ->where('user_id', $member->id)
                ->first();
            $present_country_id = $present_address->country_id ?? '';
            $present_state_id = $present_address->state_id ?? '';
            $present_city_id = $present_address->city_id ?? '';
            $present_postal_code = $present_address->postal_code ?? '';
            $address1 = $present_address->address1 ?? '';
            $address2 = $present_address->address2 ?? '';
        @endphp
        @if (get_setting('member_present_address_section') == 'on')
            <input type="hidden" name="address_type" value="present">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Current Address') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="address1">{{ translate('Address 1') }}</label>
                            <input type="text" name="address1" value="{{ $address1 }}" class="form-control"
                                placeholder="{{ translate('Address 1') }}" required>
                            @error('address1')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address2">{{ translate('Address 2') }}</label>
                            <input type="text" name="address2" value="{{ $address2 }}" class="form-control"
                                placeholder="{{ translate('Address 2') }}" required>
                            @error('address2')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="present_country_id">{{ translate('Country') }}</label>
                            <select class="form-control aiz-selectpicker" name="present_country_id"
                                id="present_country_id" data-selected="{{ $present_country_id }}"
                                data-live-search="true" required>
                                <option value="">{{ translate('Select One') }}</option>
                                <?php $countries = \App\Models\Country::where('status', 1)->get(); ?>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('present_country_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="present_state_id">{{ translate('State') }}</label>
                            <select class="form-control aiz-selectpicker" name="present_state_id" id="present_state_id"
                                data-live-search="true" required>

                            </select>
                            @error('present_state_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="present_city_id">{{ translate('City') }}</label>
                            <select class="form-control aiz-selectpicker" name="present_city_id" id="present_city_id"
                                data-live-search="true" required>

                            </select>
                            @error('present_city_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="present_postal_code">{{ translate('Postal Code') }}</label>
                            <input type="text" name="present_postal_code" value="{{ $present_postal_code }}"
                                class="form-control" placeholder="{{ translate('Postal Code') }}" required>
                            @error('present_postal_code')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @php
            $permanent_address = \App\Models\Address::where('type', 'permanent')
                ->where('user_id', $member->id)
                ->first();
            $permanent_country_id = $permanent_address->country_id ?? '';
            $permanent_state_id = $permanent_address->state_id ?? '';
            $permanent_city_id = $permanent_address->city_id ?? '';
            $permanent_postal_code = $permanent_address->postal_code ?? '';
            $permanent_address1 = $permanent_address->address1 ?? '';
            $permanent_address2 = $permanent_address->address2 ?? '';
        @endphp
        <!--@if (get_setting('member_permanent_address_section') == 'on')
    -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Permanent Address') }}</h5>
            </div>
            <div class="card-body">
                <input type="hidden" name="board" value="permanent">

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="permanent_address1">{{ translate('Address 1') }}</label>
                        <input type="text" name="permanent_address1" value="{{ $permanent_address1 }}"
                            class="form-control" placeholder="{{ translate('Address 1') }}" required>
                        @error('permanent_address1')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="permanent_address2">{{ translate('Address 2') }}</label>
                        <input type="text" name="permanent_address2" value="{{ $permanent_address2 }}"
                            class="form-control" placeholder="{{ translate('Address 2') }}" required>
                        @error('permanent_address2')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="permanent_country_id">{{ translate('Country') }}</label>
                        <select class="form-control aiz-selectpicker" name="permanent_country_id"
                            id="permanent_country_id" data-selected="{{ $permanent_country_id }}"
                            data-live-search="true" required>
                            <option value="">{{ translate('Select One') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('permanent_country_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="permanent_state_id">{{ translate('State') }}</label>
                        <select class="form-control aiz-selectpicker" name="permanent_state_id" id="permanent_state_id"
                            data-live-search="true" required>

                        </select>
                        @error('permanent_state_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="permanent_city_id">{{ translate('City') }}</label>
                        <select class="form-control aiz-selectpicker" name="permanent_city_id" id="permanent_city_id"
                            data-live-search="true" required>

                        </select>
                        @error('permanent_city_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="permanent_postal_code">{{ translate('Postal Code') }}</label>
                        <input type="text" name="permanent_postal_code" value="{{ $permanent_postal_code }}"
                            class="form-control" placeholder="{{ translate('Postal Code') }}" required>
                        @error('permanent_postal_code')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!--
    @endif-->



        <!-- Physical Attributes -->
        @if (get_setting('member_physical_attributes_section') == 'on')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Physical Attributes') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="height">{{ translate('Height') }} ({{ translate('In Feet') }})</label>
                            <input type="number" name="height"
                                value="{{ $member->physical_attributes->height ?? '' }}" step="any"
                                class="form-control" placeholder="{{ translate('Height') }}" required>
                            @error('height')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="weight">{{ translate('Weight') }} ({{ translate('In Kg') }})</label>
                            <input type="number" name="weight"
                                value="{{ $member->physical_attributes->weight ?? '' }}" step="any"
                                placeholder="{{ translate('Weight') }}" class="form-control" required>
                            @error('weight')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="eye_color">{{ translate('Eye color') }}</label>
                            <input type="text" name="eye_color"
                                value="{{ $member->physical_attributes->eye_color ?? '' }}" class="form-control"
                                placeholder="{{ translate('Eye Color') }}" required>
                            @error('eye_color')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="hair_color">{{ translate('Hair Color') }}</label>
                            <input type="text" name="hair_color"
                                value="{{ $member->physical_attributes->hair_color ?? '' }}"
                                placeholder="{{ translate('Hair Color') }}" class="form-control" required>
                            @error('hair_color')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="complexion">{{ translate('Complexion') }}</label>
                            <input type="text" name="complexion"
                                value="{{ $member->physical_attributes->complexion ?? '' }}" class="form-control"
                                placeholder="{{ translate('Complexion') }}" required>
                            @error('complexion')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="blood_group">{{ translate('Blood Group') }}</label>
                            <input type="text" name="blood_group"
                                value="{{ $member->physical_attributes->blood_group ?? '' }}"
                                placeholder="{{ translate('Blood Group') }}" class="form-control" required>
                            @error('blood_group')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="body_type">{{ translate('Body Type') }}</label>
                            <input type="text" name="body_type"
                                value="{{ $member->physical_attributes->body_type ?? '' }}" class="form-control"
                                placeholder="{{ translate('Body Type') }}" required>
                            @error('body_type')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="body_art">{{ translate('Body Art') }}</label>
                            <input type="text" name="body_art"
                                value="{{ $member->physical_attributes->body_art ?? '' }}"
                                placeholder="{{ translate('Body Art') }}" class="form-control" required>
                            @error('body_art')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="disability">{{ translate('Disability') }}</label>
                            <input type="text" name="disability"
                                value="{{ $member->physical_attributes->disability ?? '' }}" class="form-control"
                                placeholder="{{ translate('Disability') }}">
                            @error('disability')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Language -->
        @if (get_setting('member_language_section') == 'on')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Language') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="diet">{{ translate('Mother Tongue') }}</label>
                            <select class="form-control aiz-selectpicker" name="mothere_tongue"
                                data-selected="{{ $member->member->mothere_tongue }}" data-live-search="true">
                                <option value="">{{ translate('Select One') }}</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}"> {{ $language->name }} </option>
                                @endforeach
                            </select>
                            @error('mothere_tongue')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="drink">{{ translate('Known Languages') }}</label>
                            @php $known_languages = !empty($member->member->known_languages) ? json_decode($member->member->known_languages) : [] ; @endphp
                            <select class="form-control aiz-selectpicker" name="known_languages[]"
                                data-live-search="true" multiple>
                                <option value="">{{ translate('Select') }}</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}"
                                        @if (in_array($language->id, $known_languages)) selected @endif>{{ $language->name }} </option>
                                @endforeach
                            </select>
                            @error('known_languages')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hobbies  -->
        @if (get_setting('member_hobbies_and_interests_section') == 'on')
            <!--@include('frontend.member.profile.hobbies_interest')-->
        @endif

        <!-- Personal Attitude & Behavior -->
        @if (get_setting('member_personal_attitude_and_behavior_section') == 'on')
            <!--@include('frontend.member.profile.attitudes_behavior')-->
        @endif

        <!-- Residency Information -->
        @if (get_setting('member_residency_information_section') == 'on')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Residency Information') }}</h5>
                </div>
                <div class="card-body">
                    @php
                        $birth_country_id = $member->recidency->birth_country_id ?? '';
                        $recidency_country_id = $member->recidency->recidency_country_id ?? '';
                        $growup_country_id = $member->recidency->growup_country_id ?? '';
                    @endphp
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="birth_country_id">{{ translate('Birth Country') }}</label>
                            <select class="form-control aiz-selectpicker" name="birth_country_id"
                                data-selected="{{ $birth_country_id }}" data-live-search="true">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="recidency_country_id">{{ translate('Residency Country') }}</label>
                            <select class="form-control aiz-selectpicker" name="recidency_country_id"
                                data-selected="{{ $recidency_country_id }}" data-live-search="true">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="growup_country_id">{{ translate('Grow up Country') }}</label>
                            <select class="form-control aiz-selectpicker" name="growup_country_id"
                                data-selected="{{ $growup_country_id }}" data-live-search="true">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="immigration_status">{{ translate('Immigration Status') }}</label>
                            <input type="text" name="immigration_status"
                                value="{{ $member->recidency->immigration_status ?? '' }}"
                                placeholder="{{ translate('Immigration Status') }}" class="form-control">
                            @error('immigration_status')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <!-- Spiritual & Social Background -->
        @php
            $member_religion_id = $member->spiritual_backgrounds->religion_id ?? '';
            $member_caste_id = $member->spiritual_backgrounds->caste_id ?? '';
            $member_sub_caste_id = $member->spiritual_backgrounds->sub_caste_id ?? '';
        @endphp
        @if (get_setting('member_spiritual_and_social_background_section') == 'on')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Spiritual & Social Background') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="member_religion_id">{{ translate('Religion') }}</label>
                            <select class="form-control aiz-selectpicker" name="member_religion_id"
                                id="member_religion_id" data-selected="{{ $member_religion_id }}"
                                data-live-search="true" required>
                                <option value="">{{ translate('Select One') }}</option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}"> {{ $religion->name }} </option>
                                @endforeach
                            </select>
                            @error('member_religion_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="member_caste_id">{{ translate('Caste') }}</label>
                            <select class="form-control aiz-selectpicker" name="member_caste_id" id="member_caste_id"
                                data-live-search="true" required>

                            </select>
                            @error('member_caste_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="member_sub_caste_id">{{ translate('Sub Caste') }}</label>
                            <select class="form-control aiz-selectpicker" name="member_sub_caste_id"
                                id="member_sub_caste_id" data-live-search="true">

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="family_value_id">{{ translate('Family Value') }}</label>
                            <select class="form-control aiz-selectpicker" name="family_value_id"
                                data-selected="{{ $member->spiritual_backgrounds->family_value_id ?? '' }}"
                                data-live-search="true">
                                <option value="">{{ translate('Select One') }}</option>
                                @foreach ($family_values as $family_value)
                                    <option value="{{ $family_value->id }}"> {{ $family_value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Life Style -->
        @if (get_setting('member_life_style_section') == 'on')
            <!--@include('frontend.member.profile.lifestyle')-->
        @endif

        <!-- Astronomic Information  -->
        @if (get_setting('member_astronomic_information_section') == 'on')
            <!--@include('frontend.member.profile.astronomic_information')-->
        @endif

        <!-- Family Information -->
        @if (get_setting('member_family_information_section') == 'on')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Family Information') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="father">{{ translate('Father name') }}</label>
                            <input type="text" name="father" value="{{ $member->families->father ?? '' }}"
                                class="form-control" placeholder="{{ translate('Father') }}" required>
                            @error('father')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="father_prof">{{ translate('Father Profession') }}</label>
                            <input type="text" name="father_prof" value="{{ $member->families->father_prof ?? '' }}"
                                placeholder="{{ translate('Father Profession') }}" class="form-control" required>
                            @error('father_prof')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="father_educ">{{ translate('Father Education') }}</label>
                            <input type="text" name="father_educ" value="{{ $member->families->father_educ ?? '' }}"
                                placeholder="{{ translate('Father Education') }}" class="form-control" required>
                            @error('father_educ')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="father_phone">{{ translate('Father Phone Number') }}</label>
                            <input type="text" name="father_phone"
                                value="{{ $member->families->father_phone ?? '' }}"
                                placeholder="{{ translate('Father Phone Number') }}" class="form-control" required>
                            @error('father_phone')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>



                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="mother">{{ translate('Mother name') }}</label>
                            <input type="text" name="mother" value="{{ $member->families->mother ?? '' }}"
                                placeholder="{{ translate('Mother') }}" class="form-control" required>
                            @error('mother')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="father_prof">{{ translate('Mother Profession') }}</label>
                            <input type="text" name="mother_prof" value="{{ $member->families->mother_prof ?? '' }}"
                                placeholder="{{ translate('Mother Profession') }}" class="form-control" required>
                            @error('mother_prof')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="father_educ">{{ translate('Mother Education') }}</label>
                            <input type="text" name="mother_educ" value="{{ $member->families->mother_educ ?? '' }}"
                                placeholder="{{ translate('Mother Education') }}" class="form-control" required>
                            @error('mother_educ')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="mother_phone">{{ translate('Mother Phone Number') }}</label>
                            <input type="text" name="mother_phone"
                                value="{{ $member->families->mother_phone ?? '' }}"
                                placeholder="{{ translate('Mother Phone Number') }}" class="form-control" required>
                            @error('mother_phone')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        @php
                        @endphp
                        <div class="col-md-6 mt-2">
                            <label for="guardian_name">{{ translate('Guardian name') }}</label>
                            <input type="text" name="guardian_name"
                                value="{{ $member->families->guardian_name ?? '' }}"
                                placeholder="{{ translate('Guardian Name') }}" class="form-control" required>
                            @error('guardian_name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="guardian_phone">{{ translate('Guardian Phone Number') }}</label>
                            <input type="text" name="guardian_phone"
                                value="{{ $member->families->guardian_phone ?? '' }}"
                                placeholder="{{ translate('Guardian Phone Number') }}" class="form-control" required>
                            @error('guardian_phone')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    @php
                        $index = '0';
                        $siblings = !empty($member->families->sibling) ? json_decode($member->families->sibling) : [];
                        $maritalStatuses = !empty($member->families->sibling_m_s) ? json_decode($member->families->sibling_m_s) : [];
                        $Yon_old = !empty($member->families->Yon_old) ? json_decode($member->families->Yon_old) : [];
                        $relation = !empty($member->families->relation) ? json_decode($member->families->relation) : [];
                        $sibiling_phone = !empty($member->families->sibiling_phone) ? json_decode($member->families->sibiling_phone) : [];
                        //dd($sibiling_phone);
                    @endphp

                    @if (
                        !empty($siblings) &&
                            !empty($maritalStatuses) &&
                            !empty($Yon_old) &&
                            !empty($relation) &&
                            count($siblings) > 0 &&
                            count($maritalStatuses) > 0 &&
                            count($Yon_old) > 0 &&
                            count($relation) > 0)
                        @foreach ($siblings as $index => $sibling)
                            <div class="sibling-fields form-group row">
                                <div class="col-md-4">
                                    <label for="sibling">{{ translate('Sibling') }} </label>
                                    <input type="text" name="sibling[]" value="{{ $sibling }}"
                                        class="form-control" placeholder="{{ translate('Sibling') }}" required>
                                    @error('sibling.' . $index)
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="sibling">{{ translate('Sibling Relation') }} </label>
                                    <select name="relation[]" class="form-control" required>
                                        <option value="brother"
                                            {{ isset($relation[$index]) && $relation[$index] == 'brother' ? 'selected' : '' }}>
                                            Brother</option>
                                        <option value="sister"
                                            {{ isset($relation[$index]) && $relation[$index] == 'sister' ? 'selected' : '' }}>
                                            Sister</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="sibling">{{ translate('Yonger or Older') }} </label>
                                    <select name="Yon_old[]" class="form-control" required>
                                        <option value="younger"
                                            {{ isset($Yon_old[$index]) && $Yon_old[$index] == 'younger' ? 'selected' : '' }}>
                                            Younger</option>
                                        <option value="older"
                                            {{ isset($Yon_old[$index]) && $Yon_old[$index] == 'older' ? 'selected' : '' }}>
                                            Older</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="sibling_m_s">{{ translate('Sibling Marital Status') }}</label>
                                    <select class="form-control aiz-selectpicker" name="sibling_m_s[]"
                                        data-live-search="true" required multiple>
                                        @foreach ($marital_statuses as $marital_status)
                                            <option value="{{ $marital_status->id }}"
                                                {{ isset($maritalStatuses[$index]) && $maritalStatuses[$index] == $marital_status->id ? 'selected' : '' }}>
                                                {{ $marital_status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sibling_m_s.' . $index)
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label for="sibiling_phone">{{ translate('Sibling Phone Number') }}</label>
                                    <input type="text" name="sibiling_phone[]"
                                        value="{{ isset($sibiling_phone[$index]) ? $sibiling_phone[$index] : '' }}"
                                        class="form-control" placeholder="{{ translate('Sibling Phone Number') }}"
                                        required>
                                    @error('sibiling_phone.' . $index)
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            {{ translate('No sibling data available.') }}
                        </div>
                    @endif

                    <div class="form-group row">
                        <div class="col-md-1 mt-2" style="cursor:pointer;color:white;">
                            <a id="add-sibling" class="mt-2 btn btn-primary btn-sm">Add Sibling</i></a>
                        </div>
                    </div>
                    <div id="sibling-div">

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="sibling">{{ translate('Grand Father Name (Maternal)') }}</label>
                            <input type="text" name="grand_father"
                                value="{{ $member->families->grand_father ?? '' }}" class="form-control"
                                placeholder="{{ translate('Grand Father Name (Maternal)') }}" required>
                            @error('grand_father')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="sibling">{{ translate(' Grand Mother Name (Maternal)') }}</label>
                            <input type="text" name="grand_mother"
                                value="{{ $member->families->grand_mother ?? '' }}" class="form-control"
                                placeholder="{{ translate('Grand Mother Name (Maternal)') }}" required>
                            @error('grand_mother')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="sibling">{{ translate('Grand Father Name (Paternal)') }}</label>
                            <input type="text" name="nana" value="{{ $member->families->nana ?? '' }}"
                                class="form-control" placeholder="{{ translate('Grand Father Name (Paternal)') }}"
                                required>
                            @error('nana')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="sibling">{{ translate(' Grand Mother Name (Paternal)') }}</label>
                            <input type="text" name="nani" value="{{ $member->families->nani ?? '' }}"
                                class="form-control" placeholder="{{ translate('Grand Mother Name (Paternal)') }}"
                                required>
                            @error('nani')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-sm">{{ translate('Update') }}</button>
        </div>
    </form>

    <!-- Partner Expectation -->
    @php
        $partner_religion_id = $member->partner_expectations->religion_id ?? '';
        $partner_caste_id = $member->partner_expectations->caste_id ?? '';
        $partner_sub_caste_id = $member->partner_expectations->sub_caste_id ?? '';
        $partner_country_id = $member->partner_expectations->preferred_country_id ?? '';
        $partner_state_id = $member->partner_expectations->preferred_state_id ?? '';
    @endphp
    @if (get_setting('member_partner_expectation_section') == 'on')
        <!--@include('frontend.member.profile.partner_expectation')-->
    @endif
@endsection

@section('modal')
    @include('modals.create_edit_modal')
    @include('modals.update_massage_modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            get_states_by_country_for_present_address();
            get_cities_by_state_for_present_address();
            get_states_by_country_for_permanent_address();
            get_cities_by_state_for_permanent_address();
            get_castes_by_religion_for_member();
            get_sub_castes_by_caste_for_member();
            get_castes_by_religion_for_partner();
            get_sub_castes_by_caste_for_partner();
            get_states_by_country_for_partner();
        });

        // For Present address
        function get_states_by_country_for_present_address() {
            var present_country_id = $('#present_country_id').val();
            $.post('{{ route('states.get_state_by_country') }}', {
                _token: '{{ csrf_token() }}',
                country_id: present_country_id
            }, function(data) {
                $('#present_state_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#present_state_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#present_state_id > option").each(function() {
                    if (this.value == '{{ $present_state_id }}') {
                        $("#present_state_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');

                get_cities_by_state_for_present_address();
            });
        }

        function get_cities_by_state_for_present_address() {
            var present_state_id = $('#present_state_id').val();
            $.post('{{ route('cities.get_cities_by_state') }}', {
                _token: '{{ csrf_token() }}',
                state_id: present_state_id
            }, function(data) {
                $('#present_city_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#present_city_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#present_city_id > option").each(function() {
                    if (this.value == '{{ $present_city_id }}') {
                        $("#present_city_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        $('#present_country_id').on('change', function() {
            get_states_by_country_for_present_address();
        });

        $('#present_state_id').on('change', function() {
            get_cities_by_state_for_present_address();
        });

        // For permanent address
        function get_states_by_country_for_permanent_address() {
            var permanent_country_id = $('#permanent_country_id').val();
            $.post('{{ route('states.get_state_by_country') }}', {
                _token: '{{ csrf_token() }}',
                country_id: permanent_country_id
            }, function(data) {
                $('#permanent_state_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#permanent_state_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#permanent_state_id > option").each(function() {
                    if (this.value == '{{ $permanent_state_id }}') {
                        $("#permanent_state_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');

                get_cities_by_state_for_permanent_address();
            });
        }

        function get_cities_by_state_for_permanent_address() {
            var permanent_state_id = $('#permanent_state_id').val();
            $.post('{{ route('cities.get_cities_by_state') }}', {
                _token: '{{ csrf_token() }}',
                state_id: permanent_state_id
            }, function(data) {
                $('#permanent_city_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#permanent_city_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#permanent_city_id > option").each(function() {
                    if (this.value == '{{ $permanent_city_id }}') {
                        $("#permanent_city_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        $('#permanent_country_id').on('change', function() {
            get_states_by_country_for_permanent_address();
        });

        $('#permanent_state_id').on('change', function() {
            get_cities_by_state_for_permanent_address();
        });

        // get castes and subcastes For member
        function get_castes_by_religion_for_member() {
            var member_religion_id = $('#member_religion_id').val();
            $.post('{{ route('castes.get_caste_by_religion') }}', {
                _token: '{{ csrf_token() }}',
                religion_id: member_religion_id
            }, function(data) {
                $('#member_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#member_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#member_caste_id > option").each(function() {
                    if (this.value == '{{ $member_caste_id }}') {
                        $("#member_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');

                get_sub_castes_by_caste_for_member();
            });
        }

        function get_sub_castes_by_caste_for_member() {
            var member_caste_id = $('#member_caste_id').val();
            $.post('{{ route('sub_castes.get_sub_castes_by_religion') }}', {
                _token: '{{ csrf_token() }}',
                caste_id: member_caste_id
            }, function(data) {
                $('#member_sub_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#member_sub_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#member_sub_caste_id > option").each(function() {
                    if (this.value == '{{ $member_sub_caste_id }}') {
                        $("#member_sub_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        $('#member_religion_id').on('change', function() {
            get_castes_by_religion_for_member();
        });

        $('#member_caste_id').on('change', function() {
            get_sub_castes_by_caste_for_member();
        });

        // get castes and subcastes For partner
        function get_castes_by_religion_for_partner() {
            var partner_religion_id = $('#partner_religion_id').val();
            $.post('{{ route('castes.get_caste_by_religion') }}', {
                _token: '{{ csrf_token() }}',
                religion_id: partner_religion_id
            }, function(data) {
                $('#partner_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#partner_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#partner_caste_id > option").each(function() {
                    if (this.value == '{{ $partner_caste_id }}') {
                        $("#partner_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');

                get_sub_castes_by_caste_for_partner();
            });
        }

        function get_sub_castes_by_caste_for_partner() {
            var partner_caste_id = $('#partner_caste_id').val();
            $.post('{{ route('sub_castes.get_sub_castes_by_religion') }}', {
                _token: '{{ csrf_token() }}',
                caste_id: partner_caste_id
            }, function(data) {
                $('#partner_sub_caste_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#partner_sub_caste_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#partner_sub_caste_id > option").each(function() {
                    if (this.value == '{{ $partner_sub_caste_id }}') {
                        $("#partner_sub_caste_id").val(this.value).change();
                    }
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        $('#partner_religion_id').on('change', function() {
            get_castes_by_religion_for_partner();
        });

        $('#partner_caste_id').on('change', function() {
            get_sub_castes_by_caste_for_partner();
        });

        // For partner address
        function get_states_by_country_for_partner() {
            var partner_country_id = $('#partner_country_id').val();
            $.post('{{ route('states.get_state_by_country') }}', {
                _token: '{{ csrf_token() }}',
                country_id: partner_country_id
            }, function(data) {
                $('#partner_state_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#partner_state_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#partner_state_id > option").each(function() {
                    if (this.value == '{{ $partner_state_id }}') {
                        $("#partner_state_id").val(this.value).change();
                    }
                });

                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        $('#partner_country_id').on('change', function() {
            get_states_by_country_for_partner();
        });

        //  education Add edit , status change
        function education_add_modal(id) {
            $.post('{{ route('education.create') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('.create_edit_modal_content').html(data);
                $('.create_edit_modal').modal('show');
            });
        }

        function education_edit_modal(id) {
            $.post('{{ route('education.edit') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('.create_edit_modal_content').html(data);
                $('.create_edit_modal').modal('show');
            });
        }

        function update_education_present_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('education.update_education_present_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    location.reload();
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }


        //  Career Add edit , status change
        function career_add_modal(id) {
            $.post('{{ route('career.create') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('.create_edit_modal_content').html(data);
                $('.create_edit_modal').modal('show');
            });
        }

        function career_edit_modal(id) {
            $.post('{{ route('career.edit') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('.create_edit_modal_content').html(data);
                $('.create_edit_modal').modal('show');
            });
        }

        function update_career_present_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('career.update_career_present_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    location.reload();
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }

        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();

            $.post('{{ route('user.new.verify') }}', {
                _token: '{{ csrf_token() }}',
                email: email
            }, function(data) {
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if (data.status == 2)
                    AIZ.plugins.notify('warning', data.message);
                else if (data.status == 1)
                    AIZ.plugins.notify('success', data.message);
                else
                    AIZ.plugins.notify('danger', data.message);
            });
        });
    </script>

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
                    <div class="col-md-4">
                        <label for="sibling${siblingCount}">Sibling</label>
                        <input type="text" name="sibling[]" class="form-control" placeholder="Sibling Name" required>
                    </div>

                    <div class="col-md-4">
                        <label for="sibling">{{ translate('Sibling Relation') }} </label>
                        <select name="relation[]" class="form-control" required>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="sibling">{{ translate('Younger or Older') }} </label>
                        <select name="Yon_old[]" class="form-control" required>
                            <option value="younger">Younger</option>
                            <option value="older">Older</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="sibling_m_s${siblingCount}">{{ translate('Sibling Marital Status') }}</label>
                        <select class="form-control aiz-selectpicker" name="sibling_m_s[]" data-live-search="true" required multiple>
                            @foreach ($marital_statuses as $marital_status)
                                <option value="{{ $marital_status->id }}">
                                    {{ $marital_status->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="col-md-1 mt-2" style="cursor:pointer;">
                            <a class="delete-sibling"><i class="las la-trash"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="sibling_phone">{{ translate('Sibling Mobile Number') }}</label>
                        <input type="text" name="sibling_phone[]" class="form-control" placeholder="Sibling Mobile Number" required>
                    </div>


                </div>
            `;
                // Append the sibling form fields to the form
                $("#sibling-div").append(html);

                // Initialize the selectpicker for the newly added sibling fields
                $('.aiz-selectpicker').selectpicker('refresh');
            }

        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $("#saveMemberAllInfo").validate({
                rules: {
                    'introduction': {
                        required: true
                    },

                    'first_name': {
                        required: true
                    },
                    'middle_name': {
                        required: true
                    },
                    'last_name': {
                        required: true
                    },
                    'gender': {
                        required: true
                    },
                    'date_of_birth': {
                        required: true
                    },
                    'phone': {
                        required: true
                    },
                    'on_behalf': {
                        required: true
                    },
                    'marital_status': {
                        required: true
                    },
                    'children': {
                        required: true
                    },
                    'photo': {
                        required: true
                    },

                    'present_country_id': {
                        required: true
                    },
                    'present_state_id': {
                        required: true
                    },
                    'present_city_id': {
                        required: true
                    },
                    'present_postal_code': {
                        required: true
                    },
                    'address1': {
                        required: true
                    },
                    'address2': {
                        required: true
                    },

                    'permanent_country_id': {
                        required: true
                    },
                    'permanent_state_id': {
                        required: true
                    },
                    'permanent_city_id': {
                        required: true
                    },
                    'permanent_postal_code': {
                        required: true
                    },
                    'permanent_address1': {
                        required: true
                    },
                    'permanent_address2': {
                        required: true
                    },

                    'height': {
                        required: true,
                        number: true
                    },
                    'weight': {
                        required: true,
                        number: true
                    },
                    'eye_color': {
                        required: true,
                        maxlength: 50
                    },
                    'hair_color': {
                        required: true,
                        maxlength: 50
                    },
                    'complexion': {
                        required: true,
                        maxlength: 50
                    },
                    'blood_group': {
                        required: true,
                        maxlength: 3
                    },
                    'body_type': {
                        required: true,
                        maxlength: 50
                    },
                    'body_art': {
                        required: true,
                        maxlength: 50
                    },
                    'disability': {
                        required: true,
                        maxlength: 255
                    },

                    'birth_country_id': {
                        required: true
                    },
                    'recidency_country_id': {
                        required: true
                    },
                    'growup_country_id': {
                        required: true
                    },
                    'immigration_status': {
                        required: true,
                        maxlength: 255
                    },

                    'mothere_tongue': {
                        required: true
                    },
                    'known_languages[]': {
                        required: true
                    },

                    'member_religion_id': {
                        required: true,
                        maxlength: 255
                    },
                    'member_caste_id': {
                        required: true,
                        maxlength: 255
                    },
                    'ethnicity': {
                        maxlength: 255
                    },
                    'personal_value': {
                        maxlength: 255
                    },
                    'community_value': {
                        maxlength: 255
                    },
                    'member_sub_caste_id': {
                        required: true,
                    },
                    'family_value_id': {
                        required: true,
                    },

                    'father': {
                        required: true,
                        maxlength: 255
                    },
                    'mother': {
                        required: true,
                        maxlength: 255
                    },
                    'sibling[]': {
                        required: true,
                        maxlength: 255
                    },
                    'grand_mother': {
                        required: true,
                        maxlength: 255
                    },
                    'grand_father': {
                        required: true,
                        maxlength: 255
                    },
                    'nana': {
                        required: true,
                        maxlength: 255
                    },
                    'nani': {
                        required: true,
                        maxlength: 255
                    },
                    'father_prof': {
                        required: true,
                        maxlength: 255
                    },
                    'father_educ': {
                        required: true,
                        maxlength: 255
                    },
                    'mother_prof': {
                        required: true,
                        maxlength: 255
                    },
                    'mother_educ': {
                        required: true,
                        maxlength: 255
                    },
                    'sibling_m_s[]': {
                        required: true,
                        maxlength: 255
                    },
                    'Yon_old[]': {
                        required: true,
                        maxlength: 255
                    },
                    'relation[]': {
                        required: true,
                        maxlength: 255
                    },
                    'father_phone': {
                        required: true,
                        maxlength: 255
                    },
                    'mother_phone': {
                        required: true,
                        maxlength: 255
                    },
                    'sibling_phone[]': {
                        required: true,
                        maxlength: 255
                    },
                    'guardian_name': {
                        required: true,
                        maxlength: 255
                    },
                    'guardian_phone': {
                        required: true,
                        maxlength: 255
                    }
                },
                errorPlacement: function(error, element) {
            if (element.is("select") && element.attr("id") === "permanent_country_id") {
                // Place the error message below the select element
                error.insertAfter(element);
            } else {
                // Use the default placement for other elements
                error.insertAfter(element);
            }
        },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
