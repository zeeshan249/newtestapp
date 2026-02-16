<div class="container mt-4">
    
  <form class="d-flex">
    <input class="form-control me-2" type="search" aria-label="Search"
           wire:model.live.debounce="searchTerm"
           placeholder="{{$placeholder??'Search...'}}"
    >
  </form>
</div>
