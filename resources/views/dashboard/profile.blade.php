@extends('layouts.app')

@section('title', 'Student Overview')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ $user->profile_photo_url }}"
                             class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Classrooms</div>
                                <div class="profile-widget-item-value">{{ $user->classrooms()->count() }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Assignments</div>
                                <div class="profile-widget-item-value">{{ $user->submissions()->count() }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Role</div>
                                <div class="profile-widget-item-value">
                                    @foreach($user->roles as $index => $role)
                                        <div class="badge badge-info mt-1 {{ $index !== 0 ? 'mr-1' : '' }}">{{ ucfirst($role->name) }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ $user->name }}
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> {{ $user->username }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @livewire('profile-information-card')

            @livewire('profile-change-password-card')
        </div>
    </section>
@endsection

@push('scripts')

@endpush
