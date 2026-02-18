<div class="">
    <table class="table table-bordered table-striped table-hover">
        @if ($thead)
            <thead class="table-dark" >
                {{ $thead }}
            </thead>
        @endif
        @if ($tbody)
            <tbody>
                {{ $tbody }}
            </tbody>
        @endif
    </table>
</div>
