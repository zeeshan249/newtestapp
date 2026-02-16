<div>

    <div class="container mt-5">

   @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Task List</h3>
         
                @if(count($selectedTasks) > 0)
                <button class="btn btn-warning mb-3"
                        wire:click="strikeSelected">
                    Strike Off ({{ count($selectedTasks) }})
                </button>
                    @endif
        <a href="{{ route('create-task') }}" class="btn btn-primary" wire:navigate>
            <i class="bi bi-plus-circle me-1"></i> Create Task
        </a>
    </div>
    <div class="d-flex justify-content-end  mb-4">
        <livewire:total-count />         
    </div>
    <div class="d-flex justify-content-end  mb-4">

        <livewire:select-component />         
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th><input type="checkbox"
                     wire:click="toggleSelectAll"></th>
                    <th>Task Name</th>
                    <th>Task Email</th>
                    <th>Task Phone</th>
                    <th>Task Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>

          <tbody>
         @foreach ( $tasks as $article)
              <tr wire:key="{{ $article->id }}"
                {{-- @class([
                    'text-decoration-line-through bg-light'
                    => in_array($article->id, $selectedTasks)
                ]) --}}
                 @class([
                    'text-decoration-line-through bg-light'
                    => $article->is_completed
                ])
                >
                <td>{{ $counter++ }}</td>
                <td><input type="checkbox"  wire:model.live="selectedTasks" value="{{ $article->id  }}"></td>
                <td>{{ $article->name??'' }}</td>
                <td>{{ $article->email??'' }}</td>
                <td>{{ $article->phone??'' }}</td>
                <td>
                 <span class="badge {{ $article->is_completed ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $article->is_completed ? 'Completed' : 'Pending' }}
                </span>
                </td>
             
                <td>{{ $article->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('edit-task',['task'=>$article->id]) }}" class="text-primary me-3" wire:navigate>
                        <i class="bi bi-pencil-square"></i>
                    </a>
                       <a href="#"
                        class="text-primary me-3"
                        
                        wire:click.prevent="editViewModal({{ $article->id }})"
                        {{-- data-bs-toggle="modal"
                        data-bs-target="#editModal" --}}
                        >
                            <i class="bi bi-gear"></i>
                        </a>
                    <a href="#" class="text-danger"
                           wire:click="delete({{$article->id}})"
                           wire:confirm="Are you sure you want to delete this Task?"
                    >
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
         @endforeach
           


        </tbody>  


        </table>
    


         <div class ="mb-3">
         {{ $tasks->links('vendor.livewire.bootstrap-table',data: ['scrollTo' => false]) }}

        </div>












        <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            

            

            <form wire:submit.prevent="updateModalData">

                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body">

                    <!-- Name -->
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text"
                               class="form-control"
                               wire:model.defer="name">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email"
                               class="form-control"
                               wire:model.defer="email">
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text"
                               class="form-control"
                               wire:model.defer="phone">
                    </div>

                    <!-- Is Completed -->
                    <div class="form-check mb-3">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="is_completed"
                               id="editIsCompleted">

                        <label class="form-check-label"
                               for="editIsCompleted">
                            Is Completed
                        </label>
                    </div>

                    <!-- Has Multiple -->
                    <div class="mb-3">
                        <label class="form-label d-block">Has Multiple</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio"
                                   wire:model.boolean="has_multiple"
                                   value="true"
                                   id="editMultiYes">

                            <label class="form-check-label"
                                   for="editMultiYes">
                                Yes
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio"
                                   wire:model.boolean="has_multiple"
                                   value="false"
                                   id="editMultiNo">

                            <label class="form-check-label"
                                   for="editMultiNo">
                                No
                            </label>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="mb-3" x-show="$wire.has_multiple">
                        <label class="form-label d-block">Notifications</label>

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="notifications"
                                   value="videos"
                                   id="editVideos">
                            <label class="form-check-label" for="editVideos">
                                Videos
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="notifications"
                                   value="whatsapp"
                                   id="editWhatsapp">
                            <label class="form-check-label" for="editWhatsapp">
                                WhatsApp
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="notifications"
                                   value="others"
                                   id="editOthers">
                            <label class="form-check-label" for="editOthers">
                                Others
                            </label>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-primary"
                            wire:loading.attr="disabled"
                            wire:target="updateModalData">
                        Save Changes
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>  <!-- 🔥 THIS CLOSING DIV WAS MISSING -->


           

        </div>
    </div>

    


    
</div>

