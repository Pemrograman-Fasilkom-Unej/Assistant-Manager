<div class="card">
    <div class="card-header">
        <h4>Settings</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills" id="menu-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $tab === 'general' ? 'active' : '' }}" id="general-tab" data-toggle="tab"
                   href="#general" role="tab" wire:click="$set('tab', 'general')"
                   aria-controls="general" aria-selected="true">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $tab === 'academic' ? 'active' : '' }}" id="academic-tab" data-toggle="tab"
                   href="#academic" role="tab" wire:click="$set('tab', 'academic')"
                   aria-controls="academic" aria-selected="false">Academic</a>
            </li>
        </ul>
        <div class="tab-content" id="tab-content">
            <hr>
            <div class="tab-pane fade {{ $tab === 'general' ? 'show active' : '' }}" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="form-group">
                    <div class="control-label">Telegram Notification</div>
                    <label class="custom-switch mt-2 p-0">
                        <input type="checkbox" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>

                <div class="form-group">
                    <label for="telegram-key-input">Telegram Key</label>
                    <input type="text" class="form-control" placeholder="Coming Soon..." id="telegram-key-input">
                </div>
            </div>
            <div class="tab-pane fade {{ $tab === 'academic' ? 'show active' : '' }}" id="academic" role="tabpanel" aria-labelledby="academic-tab">
                <div class="form-group">
                    <label for="year-input">Year</label>
                    <input type="number" class="form-control" id="year-input" wire:model="year">
                </div>
                <div class="form-group">
                    <label for="season-select">Season</label>
                    <select id="season-select" class="form-control" wire:model="season">
                        <option value="1">Odd</option>
                        <option value="2">Even</option>
                    </select>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" wire:click="updateAcademic">Update Academic Settings</button>
                </div>
            </div>
        </div>
    </div>
</div>
