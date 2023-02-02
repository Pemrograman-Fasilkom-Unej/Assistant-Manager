@extends('dashboard.assistant.layouts.app')

@section('title', 'Dashboard')

@section('_css')
@include('components.style-select2')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection

@section('breadcrumb')
<div class="col-md-12">
  <div class="page-header-title">
    <h5 class="m-b-10">Kelas</h5>
  </div>
  <ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('assistant.dashboard') }}"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item"><a href="{{ route('assistant.class.index') }}">Daftar Kelas</a></li>
    <li class="breadcrumb-item"><a href="#!">Tambah Kelas</a></li>
  </ul>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5>Tambahkan Kelas</h5>
      </div>
      <div class="card-body">
        <form class="" method="post" action="{{ route('assistant.class.store') }}">
          @csrf
          <div class="form-group fill">
            <label class="floating-label" for="name">Nama Kelas</label>
            <input type="text" class="form-control" id="name" aria-describedby="Nama Kelas"
              placeholder="Masukan Nama Kelas" name="title" required value="{{ old('title') }}">
          </div>

          <div class="form-group">
            <label for="day">Hari Praktikum</label>
            <select class="js-example-basic-single form-control" id="day-select" name="day" required>
              @foreach($days as $index => $day)
              <option value="{{ $index }}">{{ $day }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="time">Waktu Praktikum</label>
            <input type="text" class="timepicker form-control" name="time">
          </div>

          <div class="form-group">
            <label for="assistants-option">Assisten</label>
            <select multiple="multiple" class="js-example-basic-multiple form-control" id="assistants-option"
              name="assistants[]" required>
              <option value="{{ $current_assistant->id }}" selected>{{ $current_assistant->name }}
              </option>
              @foreach($assistants as $assistant)
              <option value="{{ $assistant->id }}">{{ $assistant->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="assistants-option">Daftar Mahasiswa</label>
            <textarea class="form-control" rows="3" name="students"
              placeholder="List Nim">{{ old('students') }}</textarea>
            <small id="textHelp" class="form-text text-muted">List NIM pada kelas tersebut dipisahkan oleh baris
              baru</small>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@include('components.script-select2')
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
  $(".js-example-basic-single").select2();
        $(".js-example-basic-multiple").select2();

        $('.timepicker').timepicker({
            timeFormat: 'H:mm',
            interval: 5,
            minTime: '7',
            maxTime: '20',
            defaultTime: '7',
            startTime: '7',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
</script>
@endsection