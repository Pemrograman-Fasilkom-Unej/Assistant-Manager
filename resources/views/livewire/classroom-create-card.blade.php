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
                    <label class="selectgroup-item">
                        <input type="radio" name="topic" value="HTML" class="selectgroup-input" checked="">
                        <span class="selectgroup-button">Pemrograman Berorientasi Objek 1</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="topic" value="CSS" class="selectgroup-input">
                        <span class="selectgroup-button">Pemrograman Berorientasi Objek 2</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="topic" value="PHP" class="selectgroup-input">
                        <span class="selectgroup-button">Perancangan Web</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="topic" value="JavaScript" class="selectgroup-input">
                        <span class="selectgroup-button">Pemrograman Web</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="topic" value="Ruby" class="selectgroup-input">
                        <span class="selectgroup-button">Pemrograman Framework</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="topic" value="Ruby" class="selectgroup-input">
                        <span class="selectgroup-button">Pemrograman Grafis</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Program</label>
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input type="radio" name="program" value="50" class="selectgroup-input" checked="">
                    <span class="selectgroup-button">Sistem Informasi</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="program" value="100" class="selectgroup-input">
                    <span class="selectgroup-button">Teknologi Informasi</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="program" value="150" class="selectgroup-input">
                    <span class="selectgroup-button">Informatika</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="program" value="200" class="selectgroup-input">
                    <span class="selectgroup-button">Custom</span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Class</label>
            <div class="selectgroup selectgroup-pills">
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon">A</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon">B</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon">C</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon">D</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon">E</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon">F</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon">G</span>
                </label>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Day</label>
                        <select class="form-control">
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Time Picker</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control timepicker">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Assistant</label>
            <select class="form-control select2" multiple="">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                <option>Option 4</option>
                <option>Option 5</option>
                <option>Option 6</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary text-right">Submit</button>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('dist/js/select2.min.js') }}"></script>
@endpush
