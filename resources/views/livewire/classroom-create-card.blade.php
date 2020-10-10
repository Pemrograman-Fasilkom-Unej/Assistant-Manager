@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
@endpush

<div class="card">
    <div class="card-header">
        <h4>Add Classroom</h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <label class="form-label">Topic</label>
                <div class="selectgroup selectgroup-pills">
                    @foreach($topics as $index => $val)
                        <label class="selectgroup-item">
                            <input type="radio" name="topic" value="{{ $val['id'] }}" class="selectgroup-input" wire:model="topic">
                            <span class="selectgroup-button">{{ $val['name'] }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Program</label>
            <div class="selectgroup w-100">
                @foreach($programs as $code => $val)
                    <label class="selectgroup-item">
                        <input type="radio" value="{{ $code }}" wire:model="program"
                               class="selectgroup-input" {{ $code === 'O' ? 'checked' : '' }}>
                        <span class="selectgroup-button">{{ $val }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Class</label>
            <div class="selectgroup selectgroup-pills">
                @foreach($classes as $index => $name)
                    <label class="selectgroup-item">
                        <input type="radio" value="{{ $name }}" wire:model="class"
                               class="selectgroup-input" {{ $index === 0 ? 'checked' : '' }}>
                        <span class="selectgroup-button selectgroup-button-icon">{{ $name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Day</label>
                        <select class="form-control" wire:model="day">
                            @foreach($days as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group" wire:ignore>
                        <label>Time Picker</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control timepicker" id="time-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group" wire:ignore>
            <label>Assistant</label>
            <select class="form-control select2" multiple="" id="assistants-select">
                @foreach($assistants as $assistant)
                    <option value="{{ $assistant['id'] }}">{{ $assistant['name'] }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary text-right" wire:click="submit">Submit</button>
    </div>
</div>

<script>

</script>

@push('scripts')
    <script src="{{ asset('dist/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('dist/js/select2.min.js') }}"></script>
    <script>
        $('#assistants-select').select2();
        $('#assistants-select').change(function(){
            @this.set('selected_assistants', $(this).val());
        });
        $('#time-input').change(function(){
            @this.set('time', $(this).val());
        })

        console.log('{{ $topic }}');
    </script>
@endpush
