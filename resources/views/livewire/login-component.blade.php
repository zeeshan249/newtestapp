

<div class="{{ $showLoginForm ? '' : 'hidden' }}">
         
    <form wire:submit.prevent="submitLoginDetails">
    <p>Please login to your account</p>

    <div class="form-outline mb-4">
        <input type="email"
               class="form-control"
               placeholder="Phone number or email address"
               wire:model="username" />

        @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

  <div 
    class="form-outline mb-4 position-relative"
    x-data="{ show: false }"
>

    <input 
        :type="show ? 'text' : 'password'"
        class="form-control pe-5"
        wire:model="password"
    />

    <!-- Eye Icon -->
    <i 
        class="bi position-absolute top-50 end-0 translate-middle-y me-3"
        :class="show ? 'bi-eye-slash' : 'bi-eye'"
        style="cursor: pointer;"
        @click="show = !show"
    ></i>

    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>


    <div class="text-center pt-1 mb-5 pb-1">
     <button
        type="submit"
        wire:loading.attr="disabled"
        wire:target="submitLoginDetails"
        class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">

        Log in

        <span wire:loading wire:target="submitLoginDetails" class="ms-2">
            <span class="spinner-border spinner-border-sm"></span>
        </span>

    </button>

    </div>
</form>

</div>
