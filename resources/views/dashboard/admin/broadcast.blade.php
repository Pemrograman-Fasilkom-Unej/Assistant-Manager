@extends('layouts.app')

@section('title', 'Broadcast')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Broadcast Message With Telegram</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                @livewire('broadcast-telegram-card')
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
