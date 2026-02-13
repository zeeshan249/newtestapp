<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Create Task
        </div>

        <div class="card-body">
            <form method="POST" wire:submit="save">

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" wire:model="name" name="name" class="form-control" placeholder="Enter name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model="email" name="email" class="form-control" placeholder="Enter email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" wire:model="phone" name="phone" class="form-control" placeholder="Enter phone number"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                       @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                       @enderror
                </div>

                <!-- Is Completed -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" wire:model="is_completed" name="is_completed">
                    <label class="form-check-label" for="isCompleted">
                        Is Completed
                    </label>
                </div>

                <!-- Has Multiple (Radio Buttons) -->
                <div class="mb-3">
                    <label class="form-label d-block">Has Multiple</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.boolean="has_multiple" name="has_multiple" id="hasMultipleYes" value="true">
                        <label class="form-check-label" for="hasMultipleYes">Yes</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="has_multiple"  wire:model.boolean="has_multiple" id="hasMultipleNo" value="false" >
                        <label class="form-check-label" for="hasMultipleNo">No</label>
                    </div>
                </div>

                <!-- Notifications Checkboxes -->
                <div class="mb-3" x-show="$wire.has_multiple">
                    <label class="form-label d-block">Notifications</label>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="notifications"  wire:model="notifications" value="videos" id="videos">
                        <label class="form-check-label" for="videos">
                            Videos
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="notifications" wire:model="notifications" value="whatsapp" id="whatsapp">
                        <label class="form-check-label" for="whatsapp">
                            WhatsApp
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="notifications" wire:model="notifications" value="others" id="others">
                        <label class="form-check-label" for="others">
                            Others
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-success" value="Submit"
                  wire:loading.attr="disabled"
                  wire:target="save"
                />
                Save
                <span wire:loading wire:target="save" class="ms-2">
                    <span class="spinner-border spinner-border-sm"></span>
                </span>
                </button>
                    
             

            </form>
        </div>
    </div>
</div>
