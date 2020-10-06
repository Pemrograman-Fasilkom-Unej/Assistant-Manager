@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
@endpush

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Assistant</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Search</label>
                            <input type="text" wire:model="search" class="form-control" wire:keydown.enter="getStudent">
                        </div>

                        <div class="form-group">
                            <label for="">Search Result</label>
                            @foreach($students as $student)
                                @if(!in_array($student->id, $user_ids))
                                    <div
                                        class="alert alert-{{ $student->hasRole('assistant') ? 'secondary' : 'primary' }} alert-dismissible show fade">
                                        <div class="alert-body">
                                            @if(!$student->hasRole('assistant'))
                                                <button class="close"
                                                        wire:click="addStudent({{ $student->id }}, '{{ $student->username }} - {{ $student->name }}')">
                                                    <span>+</span>
                                                </button>
                                            @endif
                                            {{ $student->username }} - {{ $student->name }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Selected Assistant</label>
                            @foreach($user_ids as $key => $id)
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" wire:click="deleteStudent({{ $key }})">
                                            <span>x</span>
                                        </button>
                                        {{ $user_names[$key] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary text-right" wire:click="submit">Submit</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                tags: true,
                dropdownParent: $("#add-assistant-modal")
            });

            $('#student-select').on('change', function (e) {
                console.log("asu");
            });
        })
    </script>
@endpush
