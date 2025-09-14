@extends('layouts.dashboard')


@section('title', 'Edit Profile ')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
    <!-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> -->
@endsection



@section('content')

    <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-alert />

        <div class="form-row  mb-4">
            <div class="col-md-6">
                <x-form.input lable="First Name" name="first_name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-form.input lable="Last Name" name="last_name" :value="$user->profile->last_name" />
            </div>
        </div>
        <div class="form-row  mb-4">
            <div class="col-md-6">
                <x-form.input lable="Birthday" name="birthday" type="date" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.radio name="gender" lable="Gender" :value="$user->profile->gender" :options="['male' => 'Male', 'female' => 'Female']" />
            </div>
        </div>
        <div class="form-row  mb-4">
            <div class="col-md-4">
                <x-form.input lable="state" name="state" :value="$user->profile->state" />
            </div>
            <div class="col-md-4">
                <x-form.input lable="city" name="city" :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
                <x-form.input lable="street_address" name="street_address" :value="$user->profile->street_address" />
            </div>
        </div>
        <div class="form-row  mb-4">

            <div class="col-md-4">
                <x-form.input lable="Postal Code" name="post_code" :value="$user->profile->post_code" />
            </div>
            <div class="col-md-4">
                <x-form.select lable="country" name="country" :selected="$user->profile->country" :options="$contries" />
            </div>
            <div class="col-md-4">
                <x-form.select lable="Local" name="local" :selected="$user->profile->local" :options="$locales" />
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-primary"> Edit Profile </button>
        </div>
    </form>

@endsection
