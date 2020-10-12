@push('styles')
    <style>
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
@endpush

<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Profile Information</h4>
            </div>
            <div class="card-body">
                <div class="form-group"
                     x-data="{ isUploading: false, progress: 0 }"
                     x-on:livewire-upload-start="isUploading = true"
                     x-on:livewire-upload-finish="isUploading = false"
                     x-on:livewire-upload-error="isUploading = false"
                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label for="name">Avatar</label> <br>
                    <img src="{{ $avatar ? $avatar->temporaryUrl() : $avatar_url }}" alt="" class="rounded-circle profile-widget-picture mb-2"
                         id="avatar-img" style="width: 100px">
                    <br>
                    <label class="custom-file-upload">
                        <input type="file" wire:model="avatar" id="upload-avatar"/>
                        Upload Avatar
                    </label>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="{{ $name }}" id="name" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" value="{{ $username }}" id="username" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="telegram-id">Telegram ID</label>
                    <input type="text" value="{{ $telegram_id }}" id="telegram-id" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" id="name" class="form-control" wire:model="email">
                </div>
                <button class="btn btn-primary float-right" wire:click="save">Save</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {

        });
    </script>
@endpush
