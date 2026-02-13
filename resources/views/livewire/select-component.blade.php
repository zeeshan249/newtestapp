<div wire:ignore>
    <select id="statusSelect" class="form-select w-auto">
        <option value="all">All</option>
        <option value="completed">Completed</option>
        <option value="pending">Pending</option>
    </select>
</div>

@script
<script>
    $('#statusSelect').select2();

    $('#statusSelect').on('change', function () {
            $wire.dispatch('statusChanged', $(this).val());
        // $wire.dispatch('statusChanged', {
        //     value: $(this).val()
        // });
    });
</script>
@endscript
