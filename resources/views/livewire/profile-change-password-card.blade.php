<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Update Password</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" class="form-control" wire:model="current_password">
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" class="form-control" wire:model="password">
                </div>
                <div class="form-group">
                    <label for="name">New Password (Confirmation)</label>
                    <input type="password" class="form-control" wire:model="password_confirmation">
                </div>
                <button class="btn btn-primary float-right" wire:click="save">Save</button>
            </div>
        </div>
    </div>
</div>
